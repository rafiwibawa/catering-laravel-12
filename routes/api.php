<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\CartController; 
use App\Http\Controllers\Api\TransactionController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']); 
 
Route::get('/list-menu', [MenuController::class, 'listMenu']); 
Route::get('/list-categories', [MenuController::class, 'listCategories']); 

Route::middleware('auth:sanctum')->group(function () {  
    Route::get('/menu/add-to-cart/{id}', [MenuController::class, 'addToCart']); 

    Route::get('/list-carts', [CartController::class, 'ListCart']); 
    Route::get('/cart-count', [CartController::class, 'cartCount']); 

    Route::get('/history', [TransactionController::class, 'HistoryCart']); 
    Route::get('/invoice/{order_code}', [TransactionController::class, 'invoice']);

    Route::get('/profile', [AuthController::class, 'profile']);
    Route::get('/logout', [AuthController::class, 'logout']);
}); 