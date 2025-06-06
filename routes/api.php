<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MenuController;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']); 
 
Route::get('/list-menu', [MenuController::class, 'listMenu']); 

Route::middleware([
    EnsureFrontendRequestsAreStateful::class,
    'auth:sanctum',
])->group(function () {
    Route::get('/menu/add-to-cart/{id}', [MenuController::class, 'addToCart']);
});
