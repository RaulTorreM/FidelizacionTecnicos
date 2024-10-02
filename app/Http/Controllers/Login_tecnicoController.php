<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Login_tecnicoController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'celularTecnico' => 'required|string',
            'password' => 'required|string',
        ]);

        $celularTecnico = $request->input('celularTecnico');
        $password = $request->input('password');

        // Buscar el técnico por celularTecnico en la tabla Tecnicos
        $tecnico = DB::table('Tecnicos')
            ->where('celularTecnico', $celularTecnico)
            ->first();

        // Verificar si se encontró el técnico y luego validar la contraseña
        if ($tecnico) {
            $loginTecnico = DB::table('login_tecnicos')
                ->where('idTecnico', $tecnico->idTecnico) // Usar idTecnico del técnico encontrado
                ->first();

            if ($loginTecnico && Hash::check($password, $loginTecnico->password)) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Login exitoso',
                    'celularTecnico' => $tecnico->celularTecnico,
                    'nombreTecnico' => $tecnico->nombreTecnico
                ]);
            }
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Credenciales inválidas'
        ], 401);
    }

    public function getAllTecnicos()
    {
        $tecnicos = DB::table('Tecnicos')
            ->select('celularTecnico')
            ->get();

        return response()->json($tecnicos);
    }

    public function getCsrfToken()
    {
        return response()->json(['csrf_token' => csrf_token()]);
    }
}