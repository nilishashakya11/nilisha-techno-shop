<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // READ: Show all categories
    public function index() {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // CREATE: Save a new category
    public function store(Request $request) {
        $request->validate(['name' => 'required|unique:categories|max:255']);
        Category::create($request->all());
        return back()->with('success', 'Category Created!');
    }

    // UPDATE: Update category name
    public function update(Request $request, Category $category) {
        $request->validate(['name' => 'required|max:255']);
        $category->update($request->all());
        return back()->with('success', 'Category Updated!');
    }

    // DELETE: Remove category
    public function destroy(Category $category) {
        $category->delete();
        return back()->with('success', 'Category Deleted!');
    }
}