<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
class AdminCustomerController extends Controller
{
    public function index(Request $request)
{
    $customers = User::whereNotIn('email', [
            'admin@electromart.com',
            'admin@gmail.com'
        ])
        ->when($request->search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        })
        ->latest()
        ->get();

    return view('admin.customers.index', compact('customers'));
}
}