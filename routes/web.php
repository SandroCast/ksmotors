<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\ProductController;

use App\Models\Product;

Route::get('/', [ProductController::class, 'index']);
Route::get('/product/create', [ProductController::class, 'create'])->middleware('auth');
Route::get('/product/favorite', [ProductController::class, 'favoritos'])->middleware('auth');

Route::post('/', [ProductController::class, 'store']);
Route::delete('/product/{id}', [ProductController::class, 'destroy'])->middleware('auth');
Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->middleware('auth');
Route::put('/product/update/{id}', [ProductController::class, 'update'])->middleware('auth');
Route::get('/product/dashboard', [ProductController::class, 'dashboard'])->middleware('auth');


Route::post('/product/join/{id}', [ProductController::class, 'joinProduct'])->middleware('auth');

Route::post('/product/favorite/{id}', [ProductController::class, 'favorito_novo'])->middleware('auth');

Route::delete('/product/favorite/remove/{id}', [ProductController::class, 'favorito_remover'])->middleware('auth');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [ProductController::class, 'index'])->name('dashboard');
