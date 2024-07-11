<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Canje;

class CanjeController extends Controller
{
    public function generarIdCanje()
    {
        // Obtener el último valor de idCanje
        $ultimoCanje = Canje::orderByDesc('idCanje')->first();

        // Extraer el número del último idCanje
        $ultimoNumero = $ultimoCanje ? intval(substr($ultimoCanje->idCanje, 5)) : 0;

        // Incrementar el número para generar el siguiente idCanje
        $nuevoNumero = $ultimoNumero + 1;

        // Formatear el nuevo número con ceros a la izquierda
        $nuevoIdCanje = 'CANJ-' . str_pad($nuevoNumero, 5, '0', STR_PAD_LEFT);

        return $nuevoIdCanje;
    }

    public function generarRutaPDFCanje()
    {
        // Reutilizar la lógica de generar el ID de canje
        $nuevoIdCanje = $this->generarIdCanje();

        // Generar la ruta del PDF utilizando el ID de canje generado
        $rutaPDFCanje = "public/PDFCanjes/{$nuevoIdCanje}.pdf";

        return $rutaPDFCanje;
    }
}
