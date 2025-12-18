<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\AdminController;

use App\Http\Controllers\Customer\AuthController;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\MenuController;
use App\Http\Controllers\Customer\AboutController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\TransactionController;
use App\Http\Controllers\Customer\ProfileController;
use App\Http\Controllers\Customer\PaymentController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/store-register', [AuthController::class, 'storeRegister']);

    Route::prefix('/admin')->group(function () { 
        Route::get('/login', [AdminAuthController::class, 'index']);
        Route::post('/login', [AdminAuthController::class, 'login']);
    });
});
 
Route::middleware(['auth', 'role:admin'])->group(function () {  
    Route::prefix('/admin')->group(function () { 
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/logout', [AdminAuthController::class, 'logout']); 

        Route::get('/order', [OrderController::class, 'index']);
        Route::get('/order/dt', [OrderController::class, 'dt']); 

        Route::resource('menus', AdminMenuController::class);
        Route::post('/menus/dt', [AdminMenuController::class, 'dt'])->name('menus.dt');

        Route::resource('categories', CategoryController::class);
        Route::post('/categories/dt', [CategoryController::class, 'dt'])->name('categories.dt');
        Route::get('/categories/list/all', [CategoryController::class, 'list'])->name('categories.list');

        Route::resource('customers', CustomerController::class);
        Route::post('/customers/dt', [CustomerController::class, 'dt'])->name('customers.dt');

        Route::resource('users', AdminController::class);
        Route::post('/users/dt', [AdminController::class, 'dt'])->name('admin.dt');
    });
});

Route::redirect('/', '/home');
Route::get('/home', [HomeController::class, 'index']);
Route::get('/menu', [MenuController::class, 'index'])->name('customer.menu');
 
Route::middleware(['auth', 'role:customer'])->group(function () { 
    Route::get('/about', [AboutController::class, 'index']);
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    Route::get('/cart', [CartController::class, 'index']);
    Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::delete('/cart/remove-item/{id}', [CartController::class, 'removeItem']);
    Route::post('/cart/plus/{id}', [CartController::class, 'plusItem'])->name('cart.plus');
    Route::post('/cart/minus/{id}', [CartController::class, 'minusItem'])->name('cart.minus');
    

    Route::post('/menu/add-to-cart/{id}', [MenuController::class, 'addToCart']); 
    Route::get('/menu/search', [MenuController::class, 'search'])->name('customer.menu.search');

    Route::get('/transaction', [TransactionController::class, 'index']); 
    Route::get('/transaction/data', [TransactionController::class, 'data']);
    Route::get('/transaction/invoice/{id}', [TransactionController::class, 'invoice'])->name('transaction.invoice');

    Route::post('/duitku/callback', [PaymentController::class, 'callback'])->name('duitku.callback');
    Route::get('/duitku/return', [PaymentController::class, 'return'])->name('duitku.return');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
