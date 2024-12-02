<?php

namespace App\Http\Controllers;

use App\Models\ProjectVote;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProjectVoteController extends Controller
{
    //
    public function vote(Request $request)
    {
        if (!Auth::check()) return redirect()->back()->with('error', 'You need to be logged in to vote.');
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'vote' => 'required|in:positive,negative',
        ]);

        try {
            $vote = ProjectVote::where('project_id', $request->project_id)
                ->where('user_id', Auth::id())->first();

            if (!$vote) {
                ProjectVote::create([
                    'project_id' => $request->project_id,
                    'user_id' => Auth::id(),
                    'type' => $request->vote,
                ]);
            } else {
                if ($vote->type == $request->vote) {
                    ProjectVote::where('project_id', $request->project_id)
                        ->where('user_id', Auth::id())->delete();
                    return redirect()->back()->with('success', 'Your vote was deleted!');
                }
                ProjectVote::where('project_id', $request->project_id)
                    ->where('user_id', Auth::id())
                    ->update(['type' => $request->vote]);
            }

            return redirect()->back()->with('success', 'Your vote was recorded!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while processing your vote. Please try again.');
        }
    }
}
