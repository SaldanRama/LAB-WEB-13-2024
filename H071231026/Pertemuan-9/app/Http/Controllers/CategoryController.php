<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:categories,name',
                'description' => 'required|string'
            ], [
                'name.required' => 'Category name is required',
                'name.max' => 'Category name cannot exceed 255 characters',
                'name.unique' => 'Category name already exists, please use another name',
                'description.required' => 'Description is required'
            ]);

            Category::create($request->all());
            return redirect()->route('categories.index')
                ->with('success', 'Category created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create category. Please try again.');
        }
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:categories,name,'.$category->id,
                'description' => 'required|string'
            ], [
                'name.required' => 'Category name is required',
                'name.max' => 'Category name cannot exceed 255 characters',
                'name.unique' => 'Category name already exists, please use another name',
                'description.required' => 'Description is required'
            ]);

            $category->update($request->all());
            return redirect()->route('categories.index')
                ->with('success', 'Category updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update category. Please try again.');
        }
    }

    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return redirect()->route('categories.index')
                ->with('success', 'Category successfully deleted.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete category. Please try again.');
        }
    }
}