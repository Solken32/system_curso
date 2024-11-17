<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index']);

Route::get('/temas/tema/{id}', [HomeController::class, 'show'])->name('tema.show'); // Página de cada módulo



Route::get('/temas', function () {
    return view('temas.tema');
});
