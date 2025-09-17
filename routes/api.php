<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FornecedorController;

Route::apiResource('/fornecedores', FornecedorController::class)->only(['store']);
Route::get('/fornecedores/search', [FornecedorController::class, 'search']);