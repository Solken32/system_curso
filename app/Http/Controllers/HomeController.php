<?php

namespace App\Http\Controllers;

use App\Models\Temas;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Obtener todos los módulos (temas) desde la base de datos
        $modulos = Temas::all(); // Esto obtiene todos los registros de la tabla 'temas'

        // Pasar los módulos a la vista 'home'
        return view('welcome', compact('modulos'));
    }
    
    public function show($id)
    {
        // Encuentra el módulo por ID o lanza una excepción 404
        $info_modulo = Temas::findOrFail($id); 
    
        // Obtiene los subtemas relacionados con el módulo
        $subtemas = $info_modulo->subtemas;
    
        // Retorna la vista con los datos del módulo y sus subtemas
        return view('temas.show', compact('info_modulo', 'subtemas')); 
    }
    


}
