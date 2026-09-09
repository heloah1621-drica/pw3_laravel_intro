<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\UseController;

Route::get('/', function () {
    return view('home');
});

Route::view('/landing', 'landing');

Route::get('/admin',[ UseController::class,'index']);

// Rota para enviar formilário (GET)
Route::get('/usuarios/novo',[UseController::class,'create']);

// Rota para salvar os dados enviados (POST)
Route::post('/usuarios',[UseController::class,'store']);

Route::get('/produtos', [ProdutoController::class, 'index']);
Route::post('/produtos', [ProdutoController::class, 'store']);
Route::get('/livros', [LivroController::class, 'index']);
Route::post('/livros', [LivroController::class, 'store']);
