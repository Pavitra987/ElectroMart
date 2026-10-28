<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;

class CustomerDashboardController extends Controller
{
    public function index()
    {
       $products = Product::with('subcategory.category')->latest()->get();
        $categories = Category::where('status', 'active')
            ->get();

        return view('customer.dashboard', compact('products', 'categories'));
    }
}