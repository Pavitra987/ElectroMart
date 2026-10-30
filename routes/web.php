<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StorefrontController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\CustomerProductController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\Customer\AddressController;


// ==================== PUBLIC STOREFRONT ====================

// Homepage
Route::get('/', [StorefrontController::class, 'index'])
    ->name('storefront.home');

// Product details
Route::get('/product/{id}', [StorefrontController::class, 'show'])
    ->name('storefront.product');

// All products
Route::get('/products', [CustomerProductController::class, 'index'])
    ->name('products.index');

Route::get('/get-subcategories/{categoryId}', [ CustomerProductController::class, 'getSubcategories'])
->name('customer.getSubcategories');    

 // ==================== CUSTOMER CONTACT ====================

Route::get('/contact', [ContactMessageController::class, 'create'])
    ->name('contact.create');

Route::post('/contact', [ContactMessageController::class, 'store'])
    ->name('contact.store');   


// ==================== CART (PUBLIC) ====================

Route::get('/cart', [CartController::class, 'index'])
    ->name('cart.index');

Route::post('/cart/add/{id}', [CartController::class, 'add'])
    ->name('cart.add');

Route::patch('/cart/update/{id}', [CartController::class, 'update'])
    ->name('cart.update');

Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])
    ->name('cart.remove');


// ==================== WISHLIST (PUBLIC) ====================

Route::get('/wishlist', [WishlistController::class, 'index'])
    ->name('wishlist.index');

Route::post('/wishlist/{productId}', [WishlistController::class, 'store'])
    ->name('wishlist.store');

Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])
    ->name('wishlist.destroy');


// ==================== CHECKOUT & ORDERS (LOGIN REQUIRED) ====================

Route::middleware('auth')->group(function () {

    // Checkout page
    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout.index');

    // Place order
    Route::post('/checkout', [CheckoutController::class, 'store'])
        ->name('checkout.store');

    // Order success page
    Route::get('/checkout/success/{id}', [CheckoutController::class, 'success'])
        ->name('checkout.success');

    // Customer order history
    Route::get('/my-orders', [OrderController::class, 'index'])
        ->name('orders.index');

           Route::post('/addresses', [AddressController::class, 'store'])
        ->name('addresses.store');

    Route::delete('/addresses/{address}', [AddressController::class, 'destroy'])
        ->name('addresses.destroy');

    Route::patch('/addresses/{address}/default', [AddressController::class, 'setDefault'])
        ->name('addresses.default');

        


    // ==================== CUSTOMER PROFILE ====================

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});


// Authentication routes
require __DIR__.'/auth.php';


// ==================== ADMIN ROUTES ====================

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminCustomerController;

Route::prefix('admin')->name('admin.')->group(function () {

    // Admin login
    Route::get('/login', [AuthController::class, 'login'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'authenticate'])
        ->name('authenticate');


    // Protected admin routes
    Route::middleware('admin')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('categories', CategoryController::class);

        Route::resource('subcategories', SubcategoryController::class);

        Route::get('/categories/{categoryId}/subcategories',
            [ProductController::class, 'getSubcategories'])
            ->name('categories.subcategories');

        Route::resource('products', ProductController::class);

        Route::post('/logout', [AuthController::class, 'logout'])
            ->name('logout');

        Route::get('/orders', [AdminOrderController::class, 'index'])
            ->name('orders.index');

        Route::get('/orders/{id}', [AdminOrderController::class, 'show'])
            ->name('orders.show');

        Route::patch('/orders/{id}/status',
            [AdminOrderController::class, 'updateStatus'])
            ->name('orders.updateStatus');

        Route::get('/customers', [AdminCustomerController::class, 'index'])
            ->name('customers.index');

            // Customer complaints
Route::get('/complaints', [ContactMessageController::class, 'index'])
    ->name('complaints.index');

Route::patch('/complaints/{id}/toggle-resolved',
    [ContactMessageController::class, 'toggleResolved'])
    ->name('complaints.toggleResolved');

    });

});