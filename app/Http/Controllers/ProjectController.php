<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
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
}
