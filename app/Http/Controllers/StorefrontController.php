<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class StorefrontController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 'active')->get();

       $products = Product::with('subcategory.category')
    ->where('status', 'active')
    ->when(request('search'), function ($query, $search) {
        $query->where('name', 'like', '%' . $search . '%');
    })
    ->latest()
    ->take(8)
    ->get();

        return view('storefront.home', compact('categories', 'products'));
    }
    public function show($id)
{
    $product = Product::with('subcategory.category')->findOrFail($id);

    return view('storefront.product-details', compact('product'));
}
}