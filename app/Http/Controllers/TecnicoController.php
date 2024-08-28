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
        Tecnico::create($request->all()); 
        $messageStore = 'Tecnico guardado correctamente';
        return redirect()->route('tecnicos.create')->with('successTecnicoStore', $messageStore);
    }

    function update(Request $request) 
    {
        $tecnicoSolicitado = Tecnico::find($request->idTecnico);
        // Actualizar los campos
        $tecnicoSolicitado->update([
            'celularTecnico' => $request->celularTecnico,
            'oficioTecnico' => $request->oficioTecnico
        ]);
        $messageUpdate = 'Técnico actualizado correctamente';
        return redirect()->route('tecnicos.create')->with('successTecnicoUpdate', $messageUpdate);
    }

    public function delete(Request $request) 
    {
        // Encuentra la recompensa usando el idRecompensa
        $tecnico = Tecnico::where("idTecnico", $request->idTecnico)->first();
    
        // Verifica si se encontró la recompensa
        if ($tecnico) {
            // Aplica soft delete
            $tecnico->delete();
    
            $messageDelete = 'Técnico eliminado correctamente';
        } else {
            $messageDelete = 'Técnico no encontrado';
        }
    
        return redirect()->route('tecnicos.create')->with('successTecnicoDelete', $messageDelete);
    }
}
