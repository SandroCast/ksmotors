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
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Mail;

use App\Models\Product;

Route::get('/', [ProductController::class, 'index']);
Route::get('/product/create', [ProductController::class, 'create'])->middleware('auth');

Route::get('/favorito', [ProductController::class, 'favorito'])->middleware('auth');

Route::post('/', [ProductController::class, 'store']);
Route::delete('/product/{id}', [ProductController::class, 'destroy'])->middleware('auth');
Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->middleware('auth');
Route::put('/product/update/{id}', [ProductController::class, 'update'])->middleware('auth');
Route::get('/produtos', [ProductController::class, 'dashboard'])->middleware('auth');


Route::get('/product/join/{id}', [ProductController::class, 'joinProduct'])->middleware('auth');

Route::get('/product/favorite/{id}', [ProductController::class, 'favorito_novo'])->middleware('auth');

Route::delete('/product/favorite/remove/{id}', [ProductController::class, 'favorito_remover'])->middleware('auth');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [ProductController::class, 'index'])->name('dashboard');

Route::get('/usuarios', [ProductController::class, 'usuarios'])->middleware('auth');

Route::post('/usuarios/promover/{id}', [ProductController::class, 'usuario_acao_promover'])->middleware('auth');
Route::post('/usuarios/rebaixar/{id}', [ProductController::class, 'usuario_acao_rebaixar'])->middleware('auth');

Route::get('/remove/foto/perfil/{id}', [ProductController::class, 'removeFotoPerfil'])->middleware('auth');

Route::get('/time/{id}', [ProductController::class, 'time']);

Route::get('/cancela/cadastro', [ProductController::class, 'cancela_cadastro'])->middleware('auth');

Route::get('/produto/{id}', [ProductController::class, 'show'])->middleware('auth');




Route::get('/chat/home', [MessageController::class, 'home']);

Route::get('/chat', [MessageController::class, 'index']);
Route::get('/chat/{id}', [MessageController::class, 'conversas']);
Route::get('/chat/novo/{id}', [MessageController::class, 'nova_conversa']);
Route::get('/load', [MessageController::class, 'load']);
Route::get('/conversa/{id}', [MessageController::class, 'load_conversas']);
Route::post('/enviar/{id}', [MessageController::class, 'update']);



Route::get('/api/mensagens', [MessageController::class, 'apiMensagens']);
Route::get('/api/carrega/mensagem/{id}', [MessageController::class, 'apiCarregaMensagens']);



Route::get('/teste/api', [MessageController::class, 'apiMensagens']);