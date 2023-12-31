<?php

use App\Http\Controllers\Api\FreeApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function(){

    Route::post('/salvar', [FreeApi::class, 'salvar']);
});

Route::get('/teste', [FreeApi::class, 'index']);
Route::post('/login', [FreeApi::class, 'login']);