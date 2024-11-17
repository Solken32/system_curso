
@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Título del Curso -->
    <div class="text-center">
        <h1 class="text-4xl md:text-4xl font-extrabold">FUNDAMENTOS DE LA INGENIERÍA DE SOFTWARE</h1>
    </div>

    <!-- Slider --->
    <section class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-9">
        @foreach ($modulos as $modulo)
            <div class="bg-black text-white rounded-lg p-6 shadow-lg transform transition-transform duration-300 hover:scale-110"  style="background-image: url('{{ asset('storage/' . $modulo->imagen) }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                <!-- Superposición de color oscuro para mejorar el contraste del texto -->
                <div class="absolute inset-0 bg-black opacity-70 rounded-lg"></div>
                <div class="relative z-10">
                    <!-- Texto pequeño en la parte superior -->
                    <p class="text-sm mb-8 mt-6">Módulo {{ $loop->iteration }}</p>

                    <!-- Título de la Imagen -->
                    <h2 class="text-4xl font-semibold mb-10">{{ $modulo->titulo }}</h2>
                    
                    <!-- Descripción -->
                    <p class="text-lm mb-10">
                        {{ \Str::words($modulo->descripcion, 20) }}
                    </p>
                    <!-- Botón -->
                    <!-- Botón -->
            <a href="{{ route('tema.show', $modulo->id) }}" class="mt-20 inline-block text-white border border-white px-7 py-4 rounded-md font-semibold mt-4 hover:bg-white hover:text-black">
                Ver Más
            </a>
                </div>
            </div>
        @endforeach
    </section>

    <!-- Información adicional -->
    <section class="mt-12 bg-white p-6 rounded-lg shadow-lg">
    </section>

@endsection
