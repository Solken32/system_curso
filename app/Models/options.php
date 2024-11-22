<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class options extends Model
{
    use HasFactory;
    protected $fillable = ["question_id","opcion","correcta"];
     // Relación inversa, una opción pertenece a una pregunta
     public function question()
     {
        return $this->belongsTo(questions::class, 'question_id');
     }

     


}
