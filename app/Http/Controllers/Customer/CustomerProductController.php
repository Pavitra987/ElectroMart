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
        // Get the selected category from the URL
        $categoryId = $request->query('category', $request->query('category_id'));

        // Fetch all categories
        $categories = Category::all();

        // Fetch subcategories belonging to the selected category
        $subcategories = Subcategory::when($categoryId, function ($query) use ($categoryId) {
            $query->where('category_id', $categoryId);
        })->get();

        // Fetch and filter products
        $products = Product::with('subcategory.category')
            ->where('status', 'active')

            // Filter by category
            ->when($categoryId, function ($query) use ($categoryId) {
                $query->whereHas('subcategory', function ($q) use ($categoryId) {
                    $q->where('category_id', $categoryId);
                });
            })

            // Filter by subcategory
            ->when($request->subcategory_id, function ($query) use ($request) {
                $query->where('subcategory_id', $request->subcategory_id);
            })

            // Search by product name
            ->when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })

            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('customer.product-view', compact(
            'products',
            'categories',
            'subcategories',
            'categoryId'
        ));
    }
}
