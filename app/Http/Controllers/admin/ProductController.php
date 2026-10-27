<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
public function index(Request $request)
{
    $search = $request->search;

    $products = Product::with('subcategory.category')
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%")
                  ->orWhereHas('subcategory', function ($subquery) use ($search) {
                      $subquery->where('name', 'like', "%{$search}%")
                          ->orWhereHas('category', function ($categoryQuery) use ($search) {
                              $categoryQuery->where('name', 'like', "%{$search}%");
                          });
                  });
            });
        })
        ->latest()
        ->get();

    return view('admin.products.index', compact('products'));
}



  public function create()
{
    $categories = Category::all();
    $subcategories = Subcategory::all();

    return view('admin.products.create', compact('categories', 'subcategories'));
}

public function getSubcategories($categoryId)
{
    return Subcategory::where('category_id', $categoryId)->get();
}

    public function store(Request $request)
    {
        $request->validate([
            'subcategory_id' => 'required|exists:subcategories,id',
            'sku' => 'required|unique:products,sku',
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        $product = new Product();

        $product->subcategory_id = $request->subcategory_id;
        $product->sku = $request->sku;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->status = $request->status;

        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->save();

        return redirect()->route('admin.products.index')
                         ->with('success', 'Product added successfully!');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
{
    $categories = Category::all();
    $subcategories = Subcategory::all();

    return view('admin.products.edit', compact('product', 'categories', 'subcategories'));
}

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'subcategory_id' => 'required|exists:subcategories,id',
            'sku' => 'required|unique:products,sku,' . $product->id,
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        $product->subcategory_id = $request->subcategory_id;
        $product->sku = $request->sku;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->status = $request->status;

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->save();

        return redirect()->route('admin.products.index')
                         ->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
                         ->with('success', 'Product deleted successfully!');
    }
}