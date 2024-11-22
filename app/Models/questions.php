<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class questions extends Model
{
    use HasFactory;
    protected $fillable = ["quiz_id","pregunta"];
    public function quiz()
    {
        return $this->belongsTo(quizzes::class, 'quiz_id');
    }
    // Definir la relación con las opciones de respuesta
    public function options()
    {
        // Suponiendo que la tabla 'options' tiene una columna 'question_id' que referencia a la tabla 'questions'
        return $this->hasMany(options::class, 'question_id');
    }
}
