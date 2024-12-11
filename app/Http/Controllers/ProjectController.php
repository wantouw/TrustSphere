<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Project;
use App\Models\ProjectView;
use App\Models\User;
use App\Models\UserLike;
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

    public function explore_project_page(Request $request)
    {
        $selectedCategories = $request->get('categories', []);
        $searchQuery = $request->get('search', '');
        $isSafe = $request->get('is_safe', null);

        if (is_string($selectedCategories)) {
            $selectedCategories = explode(',', $selectedCategories);
        }

        $projects = Project::when(!empty($selectedCategories), function ($query) use ($selectedCategories) {
            $query->whereHas('categories', function ($q) use ($selectedCategories) {
                $q->whereIn('categories.id', $selectedCategories);
            });
        })
            ->when($searchQuery, function ($query) use ($searchQuery) {
                $query->where('title', 'like', '%' . $searchQuery . '%')
                    ->orWhere('description', 'like', '%' . $searchQuery . '%');
            })
            ->get();

        if ($isSafe !== null) {
            $isSafeBool = $isSafe === 'true';
            $projects = $projects->filter(function ($project) use ($isSafeBool) {
                return $project->is_safe === $isSafeBool;
            });
        }

        $categories = Category::all();

        return view('explore-project-page', compact('projects', 'categories', 'selectedCategories', 'searchQuery'));
    }
    public function liked_projects_page()
    {
        $trending_categories = Category::withCount(['projects' => function ($query) {
            $query->where('projects.created_at', '>=', now()->subMonth());
        }])
            ->orderBy('projects_count', 'desc')
            ->take(10)
            ->get();
        $currentUserId = Auth::id();
        $suggested_users = User::whereNotIn('id', function ($query) use ($currentUserId) {
            $query->select('friend_id')
                ->from('friends')
                ->where('user_id', $currentUserId);
        })
            ->whereNotIn('role_id', function ($query) {
                $query->select('id')
                    ->from('roles')
                    ->where('name', '=', 'admin');
            })
            ->where('id', '!=', $currentUserId)
            ->get();
        $projects = Auth::user()->liked_projects;
        return view('liked-projects-page', compact('projects', 'suggested_users', 'trending_categories'));
    }
    public function  my_projects_page()
    {
        $trending_categories = Category::withCount(['projects' => function ($query) {
            $query->where('projects.created_at', '>=', now()->subMonth());
        }])
            ->orderBy('projects_count', 'desc')
            ->take(10)
            ->get();
        $currentUserId = Auth::id();
        $suggested_users = User::whereNotIn('id', function ($query) use ($currentUserId) {
            $query->select('friend_id')
                ->from('friends')
                ->where('user_id', $currentUserId);
        })
            ->whereNotIn('role_id', function ($query) {
                $query->select('id')
                    ->from('roles')
                    ->where('name', '=', 'admin');
            })
            ->where('id', '!=', $currentUserId)
            ->get();
        $projects = Project::where('user_id', Auth::id())->with('comments')->paginate(3);
        return view('my-projects-page', compact('projects', 'trending_categories', 'suggested_users'));
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
        $negative_comments = Comment::where('project_id', $project_id)->where('type', 'negative')->count();
        $positive_comments = Comment::where('project_id', $project_id)->where('type', 'positive')->count();
        $is_liked = UserLike::where('project_id', $project_id)->where('user_id', Auth::id())->exists();
        $reliable = ($negative_comments < $positive_comments) || ($negative_comments == 0 && $positive_comments == 0);

        return view('project-detail-page', compact('project', 'reliable', 'is_liked'));
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
        $projects = Project::where('title', 'like', '%' . $search_query . '%')->get();
        return view('search-page', compact('projects', 'search_query'));
    }

    public function delete_project(int $project_id)
    {
        Project::where('id', $project_id)->delete();
        return redirect()->route('home_page');
    }
}
