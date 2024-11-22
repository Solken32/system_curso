<?php

namespace App\Http\Controllers;

use App\Models\quizzes;
use App\Models\questions;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function showQuestion($quizId, $questionId)
    {
        // Obtener el quiz por ID
        $quiz = quizzes::findOrFail($quizId);
        
        // Obtener la pregunta por ID
        $question = questions::findOrFail($questionId);

        // Obtener las opciones de la pregunta
        $options = $question->options;

        // Buscar la siguiente pregunta si existe
        $nextQuestion = questions::where('id', '>', $questionId)->first();

        // Retornar la vista con el quiz, la pregunta y las opciones
        return view('quiz.question', compact('quiz', 'question', 'options', 'nextQuestion'));
    }
}
