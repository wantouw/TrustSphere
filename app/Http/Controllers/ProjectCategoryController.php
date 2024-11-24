<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ProjectCategoryController extends Controller
{
    //

    public function create_category(Request $request){
        $validated = $request->validate([
            'name' => 'required|unique:categories,name'
        ]);
        $new_category = new Category();
        $new_category->name = $request->name;
        $new_category->save();

        return response()->json([
            'id' => $new_category->id,
            'name' => $new_category->name,
            'message' => 'Category created successfully!',
        ], 201);

    }
}
