@extends('layouts.app') 
@section('title', 'Temas')
@section('content')


<section class="mt-1 mx-auto p-8 bg-white shadow-lg rounded-lg max-w-7xl">
  <div class="flex flex-col md:flex-row space-y-6 md:space-y-0 md:space-x-8">
    <!-- Left Side: Title -->
    <div class="md:w-1/3 mt-2">
      <h1 class="text-sm text-indigo-600 font-semibold mt-1">Tema</h1>
      <h2 class="text-2xl font-extrabold text-gray-900 mt-2">{{ $info_modulo->titulo }}</h2>
      <p class="mt-4 text-gray-600 text-justify">{{ $info_modulo->descripcion }}</p>

      <!-- Slider -->
      <div class="max-w-full mx-auto py-8">
        <div class="relative">
          <div class="overflow-x-auto flex space-x-4 pb-4">
            @foreach($subtemas as $subtema)
              <div class="w-80 bg-gradient-to-r from-indigo-500 via-purple-600 to-indigo-700 text-white rounded-lg shadow-lg p-6 mb-6 flex-none">
                <div class="flex items-center mb-4 space-x-4">
                  <!-- Icono -->
                  <svg class="w-14 h-14 text-gray-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-2.67 0-4 1.33-4 4s1.33 4 4 4 4-1.33 4-4-1.33-4-4-4z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-10-10S17.523 2 12 2z" />
                  </svg>
                  <div>
                    <p class="font-semibold text-xl">{{ $subtema->titulo }}</p>
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
        </div>
      </div>
    </div>

    <!-- Right Side: Accordions -->
    <div class="md:w-2/3 p-10  rounded-lg shadow-xl">
      <h3 class="text-black-100 font-semibold pb-6 text-center">Subtemas</h3>
      <div class="space-y-6">
        @foreach($subtemas as $subtema)
          <!-- Accordion Item -->
          <div class="border-b pb-4 mt-6">
            <button
              class="flex justify-between items-center w-full text-left text-gray-800 font-medium hover:bg-indigo-600 hover:text-white p-4 rounded-lg transition duration-200 ease-in-out"
              onclick="toggleAccordion('accordion{{ $loop->iteration }}')"
            >
              <span>{{ $loop->iteration }}. {{ $subtema->titulo }}</span>
              <span class="text-xl text-indigo-600 font-bold hover:text-white">+</span>
            </button>
            <div id="accordion{{ $loop->iteration }}" class="hidden mt-4 text-gray-500 ">
              <p class="text-gray-600 mb-4 text-justify">{{ $subtema->descripcion }}</p>
              <img src="{{ asset('storage/' . $subtema->imagen) }}" alt="Descripción de la imagen" class="w-full h-64 object-contain rounded-lg shadow-md mx-auto mb-6">
            </div>
          </div>
        @endforeach
      </div>

      <div class="flex justify-end pt-6">
        <a href="{{ route('quiz.show', $info_modulo->id) }}" class="text-center bg-purple-800 text-white w-full font-bold text-base  p-3 rounded-lg hover:bg-purple-900 active:scale-95 transition-transform transform">Ir al Quizizz</a>
      </div>
      <div class="flex justify-end pt-3">
        <button class="bg-blue-800 text-white w-full font-bold text-base  p-3 rounded-lg hover:bg-blue-900 active:scale-95 transition-transform transform">Favoritos</button>
      </div>
    </div>
  </div>
</section>


@endsection

<script>
  function toggleAccordion(accordionId) {
  const accordion = document.getElementById(accordionId);
  accordion.classList.toggle('hidden');
}
</script>