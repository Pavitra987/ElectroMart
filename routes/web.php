<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StorefrontController;
use App\Http\Controllers\Customer\CustomerDashboardController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\CustomerProductController;

Route::get('/', [StorefrontController::class, 'index'])
    ->name('storefront.home');
Route::get('/product/{id}', [StorefrontController::class, 'show'])->name('storefront.product');


Route::get('/dashboard', [CustomerDashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');

    Route::post('/cart/add/{id}', [CartController::class, 'add'])
        ->name('cart.add');

    Route::patch('/cart/update/{id}', [CartController::class, 'update'])
        ->name('cart.update');

    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])
        ->name('cart.remove');

        Route::get('/checkout', [CheckoutController::class, 'index'])
    ->name('checkout.index');

    Route::post('/checkout', [CheckoutController::class, 'store'])
    ->name('checkout.store');

    Route::get('/checkout/success/{id}', [CheckoutController::class, 'success'])
    ->name('checkout.success');

    Route::get('/my-orders', [OrderController::class, 'index'])->name('orders.index');

    Route::get('/products', [CustomerProductController::class, 'index'])
    ->name('products.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminCustomerController;


Route::prefix('admin')->name('admin.')->group(function () {

    // Admin Login
    Route::get('/login', [AuthController::class, 'login'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'authenticate'])
        ->name('authenticate');

    // Protected Admin Routes
    Route::middleware('admin')->group(function () {

        // Dashboard
       Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

        Route::resource('categories', CategoryController::class);

        Route::resource('subcategories', SubcategoryController::class);
        
        Route::get('/categories/{categoryId}/subcategories', [ProductController::class, 'getSubcategories'])
    ->name('categories.subcategories');

        Route::resource('products', ProductController::class);


        // Logout
        Route::post('/logout', [AuthController::class, 'logout'])
            ->name('logout');

            Route::get('/orders', [AdminOrderController::class, 'index'])
    ->name('orders.index');

    Route::get('/orders/{id}', [AdminOrderController::class, 'show'])
    ->name('orders.show');

    Route::patch('/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])
    ->name('orders.updateStatus');

    
        // Customers
Route::get('/customers', [AdminCustomerController::class, 'index'])
    ->name('customers.index');



    });

});



