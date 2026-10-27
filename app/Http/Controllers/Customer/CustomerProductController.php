<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class CustomerProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $subcategories = Subcategory::when($request->category_id, function ($query) use ($request) {
            $query->where('category_id', $request->category_id);
        })->get();

        $products = Product::with('subcategory.category')
            ->where('status', 'active')

            ->when($request->category_id, function ($query) use ($request) {
                $query->whereHas('subcategory', function ($q) use ($request) {
                    $q->where('category_id', $request->category_id);
                });
            })

            ->when($request->subcategory_id, function ($query) use ($request) {
                $query->where('subcategory_id', $request->subcategory_id);
            })

            ->when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })

            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('customer.product-view', compact(
            'products',
            'categories',
            'subcategories'
        ));
    }
}