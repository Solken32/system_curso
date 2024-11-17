<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temas extends Model
{
    use HasFactory;
    protected $fillable=["titulo","descripcion","imagen"];
    // Relación con Subtema (un tema puede tener varios subtemas)
    public function subtemas()
    {
        return $this->hasMany(subtemas::class,'tema_id');
    }
}

