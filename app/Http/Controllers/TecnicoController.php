<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tecnico;

class TecnicoController extends Controller
{   
    public function create()
    {
        // Obtener todas las recompensas activas
        $tecnicos = Tecnico::all();
        
        return view('dashboard.tecnicos', compact('tecnicos'));
    }

    function store(Request $request) 
    {
        Tecnico::create($request->all()); // Crear un técnico con todos los campos de la request recepcionada
        // Los datos que no se envian tienen valores por default en la migración   
        return redirect()->route('ventasIntermediadas.create');
    }
}
