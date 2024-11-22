
@extends('layouts.quizz')

@section('title', 'Quizz')

@section('content-quizz')

<!-- Botón para salir del quiz -->
<button id="exit-button" class="absolute top-8 left-11 text-white text-xl cursor-pointer">
    <span class="material-icons">close</span> <!-- Icono X -->
</button>

    <!-- Contenedor principal, dividido en dos columnas en pantallas grandes, apilado en pantallas pequeñas -->
    <div id="quiz-container" class="w-full h-full max-w-7xl bg-[#181b43] p-6 rounded-xl shadow-lg flex flex-col lg:flex-row" data-first-question="{{ $isFirstQuestion ? 'true' : 'false' }}">    
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
                    Puntuación : <span id="score"> 0</span> / {{ $totalQuestions * 20 }}    
                </div>
            </div>

            <!-- Pregunta -->
            <div class="text-center text-white text-3xl font-bold mb-6">
                <p>{{ $question->pregunta }}</p>
            </div>

            <!-- Opciones -->
            <div class="space-y-4 flex-1 flex flex-col justify-center">
                @foreach($options as $option)
                    <button 
                        class="option-button w-full py-4 bg-white text-black rounded-lg shadow-lg hover:bg-gray-300 transition duration-300"
                        data-correct="{{ $option->correcta }}">
                        {{ $option->opcion }}
                    </button>
                @endforeach
            </div>
            
            <!-- Botón siguiente pregunta, inicialmente oculto -->
            <a href="{{ $nextQuestion ? route('quizz.question', ['quizId' => $quiz->id, 'questionId' => $nextQuestion->id]) : '#' }}" 
                id="next-button"
                class="w-full py-4 bg-green-500 text-white rounded-lg shadow-lg hover:bg-green-600 transition duration-300 text-center block mt-4 hidden">
                {{ $isLastQuestion ? 'Culminar Quiz' : 'Siguiente pregunta' }}
            </a>
            <p id="feedback" class="text-center text-white mt-4 hidden"></p>
        </div>

        <!-- Contenedor de la imagen (lado derecho) -->
        <div class="w-full lg:w-1/2 flex justify-center items-center">
            <img src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/b2001a68-c2ef-41c2-9e5c-78407b5224cf/dg994t1-bca8f715-2e99-4ced-baf4-5833d5859ea2.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcL2IyMDAxYTY4LWMyZWYtNDFjMi05ZTVjLTc4NDA3YjUyMjRjZlwvZGc5OTR0MS1iY2E4ZjcxNS0yZTk5LTRjZWQtYmFmNC01ODMzZDU4NTllYTIucG5nIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.jstGpslfU5OiwDnph1T1-1Bqu6ViP0FMGe84XNdxNQc" alt="Imagen de Quiz" class="w-180 h-400 rounded-lg shadow-xl">
        </div>
        
    </div> 

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const buttons = document.querySelectorAll('.option-button');
            const feedback = document.getElementById('feedback');
            const nextButton = document.getElementById('next-button');
            const scoreElement = document.getElementById('score');
            // Restablecer puntaje si es la primera pregunta
            const isFirstQuestion = document.getElementById('quiz-container').getAttribute('data-first-question') === 'true';

            if (isFirstQuestion) {
                resetScore();
            }
            // Recuperar el puntaje acumulado desde localStorage (o iniciar en 0 si no existe)
            let score = parseInt(localStorage.getItem('quizScore')) || 0;
            scoreElement.textContent = score; // Mostrar el puntaje actual

            buttons.forEach(button => {
                button.addEventListener('click', function () {
                    // Verificar si la respuesta es correcta
                    const isCorrect = this.getAttribute('data-correct') === '1';

                      // Pintar la opción seleccionada
                    this.classList.add(isCorrect ? 'bg-blue-500' : 'bg-red-500');
                    this.classList.remove('bg-white');
                    this.classList.add('text-white');

                    // Deshabilitar todos los botones
                    buttons.forEach(btn => btn.disabled = true);

                    // Mostrar retroalimentación
                    feedback.textContent = isCorrect ? '¡Correcto!' : 'Incorrecto';
                    feedback.classList.remove('hidden');
                    feedback.classList.add(isCorrect ? 'text-green-500' : 'text-red-500');

                    // Incrementar la puntuación si es correcto
                    if (isCorrect) {
                        score += 20; // Incrementar por 20 puntos
                        localStorage.setItem('quizScore', score); // Guardar el puntaje en localStorage
                        scoreElement.textContent = score; // Actualizar visualmente la puntuación
                    }

                    // Habilitar el botón de siguiente pregunta
                    nextButton.classList.remove('hidden');
                });
            });
            // Función para restablecer el puntaje
            function resetScore() {
                localStorage.removeItem('quizScore');
            }
        });

        document.addEventListener('DOMContentLoaded', () => {
            const exitButton = document.getElementById('exit-button');

            // Mostrar SweetAlert2 cuando el usuario haga clic en el botón de salida
            exitButton.addEventListener('click', () => {
                Swal.fire({
                    title: '¿Estás seguro de salir?',
                    text: 'Si sales del quiz, perderás el progreso.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Salir',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Si el usuario confirma, redirigir al tema anterior
                        window.location.href = "/"; // Cambia esto con la URL del tema anterior
                    }
                });
            });
        });


        

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
