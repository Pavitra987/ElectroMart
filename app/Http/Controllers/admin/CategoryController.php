<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
public function index(Request $request)
{
    $search = $request->search;

    $categories = Category::when($search, function ($query) use ($search) {
        $query->where('name', 'like', "%{$search}%");
    })
    ->latest()
    ->get();

    return view('admin.categories.index', compact('categories'));
}



    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        $category = new Category();

        $category->name = $request->name;
        $category->description = $request->description;
        $category->status = $request->status;

        if ($request->hasFile('image')) {
            $category->image = $request->file('image')
                ->store('categories', 'public');
        }

        $category->save();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category added successfully!');
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        $category->name = $request->name;
        $category->description = $request->description;
        $category->status = $request->status;

        if ($request->hasFile('image')) {

            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }

            $category->image = $request->file('image')
                ->store('categories', 'public');
        }

        $category->save();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully!');
    }

    public function destroy(Category $category)
    {
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully!');
    }
}