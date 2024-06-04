<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AllergyController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductWithAllergy;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [ProductController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Overview Allergies of the selected product
Route::get('/allergies/{id}', [AllergyController::class, 'index'])->name('allergy.index');
Route::get('/deliveries/{id}', [DeliveryController::class, 'index'])->name('delivery.index');

// User routes
Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::get('/users/{user}', [UserController::class, 'show'])->name('user.show');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('user.update');

// Product With Allergies routes
Route::get('/product-allergies', [ProductController::class, 'getProductAlergies'])->name('product-allergies');
Route::get('/product-delivered', [ProductController::class, 'getDeliveredProducts'])->name('product-delivered');
Route::get('/product-delivered-specification/{product}', [ProductController::class, 'getDeliveredProductSpecification'])->name('product-delivered-specification');

    Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
