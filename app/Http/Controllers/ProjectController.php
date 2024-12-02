<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Project;
use App\Models\ProjectView;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    //
    public function create_project_page()
    {
        $categories = Category::all();
        return view('create-project-page', compact('categories'));
    }

    public function get_project(int $project_id)
    {
        $project = Project::find($project_id);
        return $project;
    }
    public function project_detail_page(int $project_id)
    {
        if (Auth::check()) {
            $exists = ProjectView::where('user_id', Auth::id())
                ->where('project_id', $project_id)
                ->exists();

            if (!$exists) {
                ProjectView::create([
                    'project_id' => $project_id,
                    'user_id' => Auth::id()
                ]);
            }
        }
        $project = $this->get_project($project_id);
        return view('project-detail-page', compact('project'));
    }

    public function create_project(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'categories' => 'required|array',
            'categories.*' => 'integer|exists:categories,id',
            'images' => 'nullable|array',
            'images.*' => 'file|image|max:2048',
        ]);
        $project = Project::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'user_id' => Auth::id(),
        ]);
        if ($request->hasFile('images')) {
            $i = 1;
            foreach ($request->file('images') as $file) {
                $customName = $project->id . '_' . $i . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('images/projects', $customName, 'public');
                $project->image_urls()->create([
                    'image_url' => $filePath,
                    'project_id' => $project->id
                ]);
                $i++;
            }
        }

        $project->categories()->sync($validated['categories']);
        return response()->json([
            'project' => $project->toArray()
        ], 201)->header('Content-Type', 'application/json');
    }

    public function search_project_page(Request $request)
    {
        $validated = $request->validate([
            'search_query' => 'required'
        ]);
        $search_query = $validated['search_query'];
        $projects = Project::where('title', 'like', '%'. $search_query. '%')->get();
        return view('search-page', compact('projects', 'search_query'));

    }
}
