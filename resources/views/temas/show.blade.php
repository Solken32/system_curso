@extends('layouts.app') 
@section('title', 'Temas')
@section('content')
<div class="flex flex-col md:flex-row items-start gap-8 p-1">
    
    <!-- Left Section (Cards) -->
    <div class="flex flex-col gap-6 w-full md:w-1/2 max-h-screen overflow-y-auto scrollbar-none">
        <!-- Título fijo "Videos complementarios" -->
        <h2 class="font-semibold text-xl sm:text-2xl sticky top-0 bg-gray-100 dark:bg-gray-800 z-10 py-2">
            Videos complementarios
        </h2>
        <!-- Itera sobre los subtemas -->
        @foreach($subtemas as $subtema)
            <div class="bg-gradient-to-br from-gray-700 to-gray-800 text-white rounded-lg shadow-lg p-4 mb-6">
                <div class="flex items-center mb-4 space-x-4">
                    <!-- Icono -->
                    <svg class="w-14 h-14 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-2.67 0-4 1.33-4 4s1.33 4 4 4 4-1.33 4-4-1.33-4-4-4z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-10-10S17.523 2 12 2z" />
                    </svg>
                    <div>
                        <!-- Título y descripción del subtema -->
                        <p class="font-semibold text-xl sm:text-2xl">{{ $subtema->titulo }}</p>
                    </div>
                </div>

                <!-- Video de YouTube -->
                <div class="relative w-full" style="padding-top: 56.25%;">
                    <?php 
                        // Reemplazar la URL estándar por la URL de incrustado
                        $video_url = str_replace('https://www.youtube.com/watch?v=', 'https://www.youtube.com/embed/', $subtema->video);
                    ?>
                    <iframe class="absolute inset-0 w-full h-full rounded-lg" src="{{ $video_url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>

            </div>
        @endforeach
    </div>


    <!-- Right Section (Text and Image) -->
    <!-- Card Container -->
    <div class="w-full md:w-3/3 max-h-screen overflow-y-auto bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-purple-700 font-bold text-lg mb-4">Tema</h2>
        <h1 class="text-3xl font-bold mb-6">{{ $info_modulo->titulo }}</h1>
        <p class="text-gray-600 mb-4">{{ $info_modulo->descripcion }}</p>

        @foreach($subtemas as $subtema)
            <div class="p-4 mb-6 shadow-md">
                <h2 class="text-2xl font-semibold mb-4">{{ $loop->iteration }}. {{ $subtema->titulo }}</h2>
                <p class="text-gray-600 mb-4 text-justify mb-2">{{ $subtema->descripcion }}</p>
                <img src="{{ asset('storage/' . $subtema->imagen) }}" alt="Descripción de la imagen" class="w-full h-64 object-contain rounded-lg shadow-md mx-auto mb-6">
            </div>
        @endforeach

    </div>
</div>


@endsection
<!-- Botón Flotante -->
<div class="fixed bottom-4 right-4 z-20">
    <!-- Botón principal flotante -->
    <button id="floatingBtn" class="bg-purple-600 text-white rounded-full p-4 shadow-lg hover:bg-purple-700 focus:outline-none">
        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <!-- Menú de opciones flotante -->
    <div id="floatingMenu" class="hidden absolute bottom-16 right-0 bg-white rounded-lg shadow-lg p-4 flex flex-col gap-4 w-40">
        <!-- Opción 1: Ir al Quiz -->
        <button title="Ir al Quiz" class="flex justify-center items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12l2 2 4-4m-6 6l2-2 4 4M20 4v16M4 20h16M4 4v16M4 4h16" />
            </svg>
        </button>

        <!-- Opción 2: Guardar en Favoritos -->
        <button title="Guardar en Favoritos" class="flex justify-center items-center gap-2 bg-gray-800 hover:bg-gray-900 text-white font-semibold py-2 px-4 rounded-lg shadow-md">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 20l7-5 7 5V6a2 2 0 00-2-2H7a2 2 0 00-2 2v14z" />
            </svg>
        </button>

        <!-- Opción 3: Compartir -->
        <button id="shareBtn" title="Compartir" class="flex justify-center items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 8a3 3 0 11-6 0 3 3 0 016 0zM12 16c-4.418 0-8 1.79-8 4v1h16v-1c0-2.21-3.582-4-8-4z" />
            </svg>
        </button>
    </div>
</div>

<!-- Modal de Compartir -->
<div id="shareModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg p-6 w-1/3">
        <h3 class="text-lg font-semibold mb-4">Compartir en redes sociales</h3>
        <div class="flex justify-around gap-4">
            <button class="text-blue-500 hover:text-blue-700">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l-5 6 5 6zm10-12h-6v12h6V7z" />
                </svg>
                Facebook
            </button>
            <button class="text-blue-400 hover:text-blue-600">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8a3 3 0 10-6 0 3 3 0 006 0zm-6 8c-2.21 0-4-1.79-4-4h8c0 2.21-1.79 4-4 4z" />
                </svg>
                Twitter
            </button>
            <button class="text-pink-500 hover:text-pink-700">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                Instagram
            </button>
        </div>
        <button id="closeModal" class="mt-4 bg-red-600 text-white py-2 px-4 rounded-lg w-full">Cerrar</button>
    </div>
</div>

<!-- Script para manejar la visualización del menú flotante y el modal -->
<script>
    document.getElementById('floatingBtn').addEventListener('click', function() {
        const menu = document.getElementById('floatingMenu');
        menu.classList.toggle('hidden');
    });

    document.getElementById('shareBtn').addEventListener('click', function() {
        const modal = document.getElementById('shareModal');
        modal.classList.remove('hidden');
    });

    document.getElementById('closeModal').addEventListener('click', function() {
        const modal = document.getElementById('shareModal');
        modal.classList.add('hidden');
    });
</script>

