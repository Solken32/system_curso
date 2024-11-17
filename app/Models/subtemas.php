<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subtemas extends Model
{
    use HasFactory;
    protected $fillable = ['tema_id', 'titulo', 'descripcion', 'imagen', 'video'];

    // Relación inversa con Tema (cada subtema pertenece a un tema)
    public function tema()
    {
        return $this->belongsTo(Temas::class,'tema_id');
    }
}
