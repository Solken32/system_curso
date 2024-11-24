<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index']);

Route::get('/temas/{id}', [HomeController::class, 'show'])->name('tema.show'); // Página de cada módulo

Route::get('/quizz/{id}', [HomeController::class, 'showQuiz'])->name('quiz.show'); // Página de cada módulo

Route::get('/quiz/{quizId}/pregunta/{questionId}', [HomeController::class, 'showQuestion'])->name('question.show');

Route::get('/quizzes/{quizId}/questions/{questionId}', [HomeController::class, 'showQuestion'])->name('quizz.question');

Route::get('/search-temas', [HomeController::class, 'search'])->name('search.temas');

Route::get('/inicio', function () {
    return view('inicio'); 
});





Route::get('/temas', function () {
    return view('temas.tema');
});
