<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{

public function index(Request $request)
{
    $search = $request->search;

    $subcategories = Subcategory::with('category')
        ->when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhereHas('category', function ($categoryQuery) use ($search) {
                    $categoryQuery->where('name', 'like', "%{$search}%");
                });
        })
        ->latest()
        ->get();

    return view('admin.subcategories.index', compact('subcategories'));
}



    public function create()
    {
        $categories = Category::all();

        return view('admin.subcategories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required',
            'status' => 'required|in:active,inactive',
        ]);

        $subcategory = new Subcategory();

        $subcategory->category_id = $request->category_id;
        $subcategory->name = $request->name;
        $subcategory->status = $request->status;

        $subcategory->save();

        return redirect()->route('admin.subcategories.index')
                         ->with('success', 'Subcategory added successfully!');
    }

    public function show(Subcategory $subcategory)
    {
        return view('admin.subcategories.show', compact('subcategory'));
    }

    public function edit(Subcategory $subcategory)
    {
        $categories = Category::all();

        return view('admin.subcategories.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, Subcategory $subcategory)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required',
            'status' => 'required|in:active,inactive',
        ]);

        $subcategory->category_id = $request->category_id;
        $subcategory->name = $request->name;
        $subcategory->status = $request->status;

        $subcategory->save();

        return redirect()->route('admin.subcategories.index')
                         ->with('success', 'Subcategory updated successfully!');
    }

    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();

        return redirect()->route('admin.subcategories.index')
                         ->with('success', 'Subcategory deleted successfully!');
    }
}