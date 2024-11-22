@extends('layouts.quizz')

@section('title', 'quizz')

@section('content-quizz')

    <!-- Contenedor Principal con dos divs (texto y contenido de imagen) -->
    <div class="flex flex-col sm:flex-row items-center justify-between w-full max-w-6xl px-8 py-12 space-y-8 sm:space-y-0 sm:space-x-8">

        <!-- Contenido de Imagen (lado izquierdo) -->
        <div class="w-full sm:w-1/2">
            <img src="https://static.vecteezy.com/system/resources/previews/027/765/346/non_2x/quiz-sign-mark-free-free-png.png" 
                 alt="Imagen de Reto" class="rounded-lg shadow-lg transform transition-transform hover:scale-105 animate__animated animate__fadeIn">
        </div>

        <!-- Contenido de Texto y Botón (lado derecho) -->
        <div class="text-white text-center sm:text-left space-y-6 w-full sm:w-1/2">
            <p class="text-xl text-gray-200 animate__animated animate__fadeIn animate__delay-1s">
                <strong>Bienvenido al Quizz</strong>
            </p>
            <h1 class="text-Gelion text-4xl sm:text-6xl font-bold text-white mb-4 animate__animated animate__fadeIn animate__delay-1s">
                {{ $quiz->titulo }}
            </h1>

            <p class="text-xl text-gray-200 animate__animated animate__fadeIn animate__delay-2s">
                Tema: <strong>{{ $quiz->tema->titulo }}</strong>
            </p>

            <!-- Botón de Comenzar -->
            <div class="mt-8">
                <a href="{{ route('question.show', ['quizId' => $quiz->id, 'questionId' => $firstQuestionId]) }}" class="bg-[#41E5ED] hover:bg-[#32c3cb] text-black px-6 py-3 rounded-lg text-lg font-semibold transform transition duration-300 ease-in-out hover:scale-105 animate__animated animate__fadeIn animate__delay-3s">
                    Comenzar Quiz
                </a>
            </div>
        </div>
        
    </div>

@endsection
