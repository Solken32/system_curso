<?php

namespace App\Http\Controllers;

use App\Models\questions;
use App\Models\quizzes;
use App\Models\subtemas;
use App\Models\Temas;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Obtener todos los módulos (temas) desde la base de datos
        $modulos = Temas::all(); // Esto obtiene todos los registros de la tabla 'temas'

        // Pasar los módulos a la vista 'home'
        return view('welcome', compact('modulos'));
    }
    
    public function show($id)
    {
        // Encuentra el módulo por ID o lanza una excepción 404
        $info_modulo = Temas::findOrFail($id); 
    
        // Obtiene los subtemas relacionados con el módulo
        $subtemas = $info_modulo->subtemas;
    
        // Retorna la vista con los datos del módulo y sus subtemas
        return view('temas.show', compact('info_modulo', 'subtemas')); 
    }
    
    public function showQuiz($id)
    {
        // Obtener el quiz asociado con el tema
        $quiz = quizzes::where('tema_id', $id)->firstOrFail();
        
        // Obtener el nombre del tema relacionado con el quiz
        $tema = $quiz->tema; // Asumiendo que tienes la relación 'tema' definida en el modelo Quizzes
        
        // Obtener las preguntas y opciones del quiz
        $questions = $quiz->questions()->with('options')->get();
    
        // Obtener el ID de la primera pregunta del quiz
        $firstQuestionId = $quiz->questions()->first()->id; 
    
        // Retornar la vista con el quiz, las preguntas y el ID de la primera pregunta
        return view('quizz.show', compact('quiz', 'questions', 'firstQuestionId'));
    }
    
    public function showQuestion($quizId, $questionId)
    {
        // Obtener el quiz por ID
        $quiz = quizzes::findOrFail($quizId);

        // Obtener todas las preguntas asociadas al quiz en orden
        $questions = $quiz->questions()->orderBy('id')->get();

        // Obtener la pregunta actual
        $question = $quiz->questions()->findOrFail($questionId);

        // Obtener el índice actual de la pregunta en la lista
        $currentIndex = $questions->search(function ($q) use ($question) {
            return $q->id === $question->id;
        }) + 1; // +1 porque queremos un índice basado en 1

        // Total de preguntas
        $totalQuestions = $questions->count();

        // Obtener la siguiente pregunta (si existe)
        $nextQuestion = $questions->get($currentIndex) ?? null; // Si no existe, será null

        // Obtener las opciones de la pregunta actual
        $options = $question->options;

        // Obtener el ID de la primera pregunta en el quiz
        $firstQuestionId = $questions->first()->id;

        // Determinar si la pregunta actual es la primera
        $isFirstQuestion = ($questionId == $firstQuestionId);
    
        // Determinar si es la última pregunta
        $isLastQuestion = ($currentIndex === $totalQuestions);


        // Retornar la vista con los datos necesarios
        return view('quizz.question', compact('quiz', 'question', 'options', 'currentIndex', 'totalQuestions', 'nextQuestion','isFirstQuestion','isLastQuestion'));
    }

    public function search(Request $request)
    {
        $query = $request->get('query');

        // Buscar en la tabla 'temas'
        $temas = Temas::where('titulo', 'like', '%' . $query . '%')
                    ->orWhere('descripcion', 'like', '%' . $query . '%')
                    ->get();

        // Buscar en la tabla 'subtemas'
        $subtemas = subtemas::where('titulo', 'like', '%' . $query . '%')
                        ->orWhere('descripcion', 'like', '%' . $query . '%')
                        ->get();

        // Unir los resultados de temas y subtemas en un solo array
        $resultados = $temas->merge($subtemas);

        return response()->json($resultados);
    }
    

}
