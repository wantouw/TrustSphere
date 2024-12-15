<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CommentController extends Controller
{
    //
    public function get_comments(int $project_id)
    {
        $comments = Comment::where('project_id', $project_id)->get();
        return $comments;
    }
    public function create_comment(Request $request)
    {
        $validated = $request->validate([
            'comment' => 'required|max:200',
            'project_id' => 'required|exists:projects,id'
        ]);

        $response = Http::post('https://trustsphere-ai.fly.dev/predict', [
            'review' => $validated['comment'],
        ]);

        $data = $response->json();
        $prediction = $data['prediction'] ?? '-';

        $existingComment = Comment::where('project_id', $validated['project_id'])
            ->where('sender_id', Auth::id())->first();

        if ($existingComment) {
            DB::table('comments')
                ->where('project_id', $validated['project_id'])
                ->where('sender_id', Auth::id())
                ->update([
                    'comment' => $validated['comment'],
                    'type' => $prediction,
                    'updated_at' => now(),
                ]);
        } else {
            Comment::create([
                'project_id' => $validated['project_id'],
                'sender_id' => Auth::id(),
                'comment' => $validated['comment'],
                'type' => $prediction,
            ]);
        }
        $project = Project::find($validated['project_id']);
        return redirect()->route('project_detail_page', ['project_id' => $request->project_id])
                ->with(compact('project'));
    }

    public function delete_comment(int $project_id)
    {
        $comment = Comment::where('project_id', $project_id)
            ->where('sender_id', Auth::id())
            ->first();

        if (!$comment) {
            abort(403, 'Unauthorized action.');
        }

        Comment::where('project_id', $project_id)
            ->where('sender_id', Auth::id())
            ->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully!');
    }
}
