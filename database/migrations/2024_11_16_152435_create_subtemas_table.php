<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subtemas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tema_id')->constrained()->onDelete('cascade');  // Relación con la tabla de temas
            $table->text('titulo');         // Título del subtema
            $table->text('descripcion');   // Descripción del subtema
            $table->text('imagen')->nullable();  // Imagen del subtema
            $table->text('video')->nullable();   // Video del subtema
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subtemas');
    }
};
