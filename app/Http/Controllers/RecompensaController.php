<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recompensa;
use Illuminate\Auth\Recaller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class RecompensaController extends Controller
{   
    public function generarIdRecompensa()
    {
        // Obtener el último ID de recompensa ordenado de forma descendente
        //$ultimaRecompensa = DB::table('recompensas')->orderBy('idRecompensa', 'desc')->first();
        $ultimaRecompensaID = Recompensa::max('idRecompensa');

        // Si la tabla está vacía, comenzar desde "RECOM-001"
        if (!$ultimaRecompensaID) {
            Log::info('Generando ID inicial RECOM-001');
            return 'RECOM-001';
        }

        // Extraer el número de la cadena del último ID de recompensa
        $strNumRecompensa = substr($ultimaRecompensaID, -3); // Obtiene los últimos 3 caracteres

        // Convertir la parte numérica a entero
        $intNumRecompensa = intval($strNumRecompensa);

        // Incrementar el número para generar el siguiente idRecompensa
        $nuevoNumero = $intNumRecompensa + 1;

        // Formatear el nuevo número con ceros a la izquierda
        $nuevoIdRecompensa = 'RECOM-'. str_pad($nuevoNumero, 3, '0', STR_PAD_LEFT);
        
        Log::info('Nuevo ID: '. $nuevoIdRecompensa);

        return $nuevoIdRecompensa;
    }

    function create() {
        // Obtener la última recompensa
        $ultimaRecompensa = Recompensa::latest('idRecompensa')->first();

        $recompensas = Recompensa::all();   
        
        return view('dashboard.recompensas', compact('recompensas', 'ultimaRecompensa'));
    }

    function store(Request $request) 
    {
        Recompensa::create($request->all()); // Crear un técnico con todos los campos de la request recepcionada
        // Los datos que no se envian tienen valores por default en la migración   
        return redirect()->route('recompensas');
    }
}
