<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quizzes extends Model
{
    use HasFactory;
    protected $fillable = ["tema_id","titulo","descripcion"];
    // Definir la relación con las preguntas
    public function questions()
    {
        // Suponiendo que 'questions' tiene una columna 'quiz_id' que referencia a la tabla 'quizzes'
        return $this->hasMany(questions::class, 'quiz_id');
    }
    // Modelo quizzes
public function tema()
{
    return $this->belongsTo(Temas::class, 'tema_id');
}


}
