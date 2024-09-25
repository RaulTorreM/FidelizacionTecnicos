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
            'idTecnico' => 'required|string',
            'password' => 'required|string',
        ]);

        $idTecnico = $request->input('idTecnico');
        $password = $request->input('password');

        $tecnico = DB::table('login_tecnicos')
            ->where('idTecnico', $idTecnico)
            ->first();

        if ($tecnico && Hash::check($password, $tecnico->password)) {
            return response()->json([
                'status' => 'success',
                'message' => 'Login exitoso',
                'idTecnico' => $tecnico->idTecnico
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Credenciales inválidas'
            ], 401);
        }
}

    public function getAllTecnicos()
    {
        $tecnicos = DB::table('login_tecnicos')
            ->select('idTecnico')
            ->get();

        return response()->json($tecnicos);
    }

    public function getCsrfToken()
    {
        return response()->json(['csrf_token' => csrf_token()]);
    }
}