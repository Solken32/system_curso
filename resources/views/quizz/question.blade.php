
@extends('layouts.quizz')

@section('title', 'Quizz')

@section('content-quizz')

    <!-- Contenedor principal, dividido en dos columnas en pantallas grandes, apilado en pantallas pequeñas -->
    <div class="w-full h-full max-w-7xl bg-[#181b43] p-6 rounded-xl shadow-lg flex flex-col lg:flex-row">
        
        <!-- Contenedor de la pregunta y opciones (lado izquierdo) -->
        <div class="w-full lg:w-1/2 flex flex-col justify-between text-white mb-6 lg:mb-0">
            
            <!-- Temporizador y puntuación -->
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center space-x-2">
                    <span class="text-xl">⏱️</span>
                    <span id="timer" class="text-lg">2:14</span>
                </div>
                <div class="text-lg">
                    <span >Pregunta {{ $currentIndex }} de {{ $totalQuestions }}</span>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="text-xl">❤️</span>
                    <span class="text-xl">❤️</span>
                    <span class="text-xl">❤️</span>
                </div>
            </div>

            <!-- Pregunta -->
            <div class="text-center text-white text-3xl font-bold mb-6">
                <p>{{ $question->pregunta }}</p>
            </div>

            <!-- Opciones -->
            <div class="space-y-4 flex-1 flex flex-col justify-center">
                @foreach($options as $option)
                    <button class="w-full py-4 bg-white text-black rounded-lg shadow-lg hover:bg-gray-300 transition duration-300">
                        {{ $option->opcion }}
                    </button>
                @endforeach
                
            </div>
        
            @if($nextQuestion)
                <a href="{{ route('quizz.question', ['quizId' => $quiz->id, 'questionId' => $nextQuestion->id]) }}" 
                    class="w-full py-4 bg-green-500 text-white rounded-lg shadow-lg hover:bg-green-600 transition duration-300 text-center block">
                    Siguiente pregunta
                </a>
            @else
                <p class="text-center text-white mt-4">¡Has completado el quiz!</p>
            @endif
        </div>

        <!-- Contenedor de la imagen (lado derecho) -->
        <div class="w-full lg:w-1/2 flex justify-center items-center">
            <img src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/b2001a68-c2ef-41c2-9e5c-78407b5224cf/dg994t1-bca8f715-2e99-4ced-baf4-5833d5859ea2.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcL2IyMDAxYTY4LWMyZWYtNDFjMi05ZTVjLTc4NDA3YjUyMjRjZlwvZGc5OTR0MS1iY2E4ZjcxNS0yZTk5LTRjZWQtYmFmNC01ODMzZDU4NTllYTIucG5nIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.jstGpslfU5OiwDnph1T1-1Bqu6ViP0FMGe84XNdxNQc" alt="Imagen de Quiz" class="w-180 h-400 rounded-lg shadow-xl">
        </div>
        
    </div> 

    <script>
        // Temporizador
        let timeLeft = 2 * 60 + 14; // 2:14 en segundos
        const timerElement = document.getElementById("timer");

        function updateTimer() {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            timerElement.textContent = `${minutes}:${seconds < 10 ? "0" : ""}${seconds}`;
            if (timeLeft > 0) {
                timeLeft--;
            }
        }

        setInterval(updateTimer, 1000);
    </script>
@endsection
