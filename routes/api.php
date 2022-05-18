<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

Route::post('login', [ApiController::class, 'authenticate']);
Route::post('register', [ApiController::class, 'register']);

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('produtos', [ProdutoController::class, 'index']);
    Route::get('produtos/{id}', [ProdutoController::class, 'show']);
    Route::post('produtos', [ProdutoController::class, 'store']);
    Route::put('produtos/{id}', [ProdutoController::class, 'update']);
    Route::delete('produtos/{id}', [ProdutoController::class, 'delete']);

    Route::get('categorias', [CategoriaController::class, 'index']);
    Route::get('categorias/{id}', [CategoriaController::class, 'show']);
    Route::post('categorias', [CategoriaController::class, 'store']);
    Route::put('categorias/{id}', [CategoriaController::class, 'update']);
    Route::delete('categorias/{id}', [CategoriaController::class, 'delete']);
});
