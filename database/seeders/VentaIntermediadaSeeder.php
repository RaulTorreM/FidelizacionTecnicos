<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VentaIntermediada;

class VentaIntermediadaSeeder extends Seeder
{
    public function run(): void
    {
        $ventasIntermediadas = [
            [
                'idVentaIntermediada' => 'F001-00000072',
                'idTecnico' => '77043114',
                'nombreTecnico' => 'Josué García Betancourt',
                'tipoCodigoCliente_VentaIntermediada' => 'DNI',
                'codigoCliente_VentaIntermediada' => '12345678',
                'nombreCliente_VentaIntermediada' => 'Nombre1 Apellido1 Apellido11',
                'fechaHoraEmision_VentaIntermediada' => '2024-04-30 08:25:11',
                'fechaHoraCargada_VentaIntermediada' => now(),
                'montoTotal_VentaIntermediada' => 74.5,
                'puntosGanados_VentaIntermediada' => 75,
                'estadoVentaIntermediada' => 'Redimido',
            ],
            [
                'idVentaIntermediada' => 'F001-00000073',
                'idTecnico' => '77043114',
                'nombreTecnico' => 'Josué García Betancourt',
                'tipoCodigoCliente_VentaIntermediada' => 'DNI',
                'codigoCliente_VentaIntermediada' => '12345678',
                'nombreCliente_VentaIntermediada' => 'Nombre2 Apellido2 Apellido22',
                'fechaHoraEmision_VentaIntermediada' => '2024-05-30 08:25:11',
                'fechaHoraCargada_VentaIntermediada' => now(),
                'montoTotal_VentaIntermediada' => 20,
                'puntosGanados_VentaIntermediada' => 20,
                'estadoVentaIntermediada' => 'En espera',
            ],
            [
                'idVentaIntermediada' => 'F001-00000074',
                'idTecnico' => '77665544',
                'nombreTecnico' => 'Manuel Carrasco',
                'tipoCodigoCliente_VentaIntermediada' => 'DNI',
                'codigoCliente_VentaIntermediada' => '87654321',
                'nombreCliente_VentaIntermediada' => 'Nombre3 Apellido3 Apellido33',
                'fechaHoraEmision_VentaIntermediada' => '2024-06-30 08:25:11',
                'fechaHoraCargada_VentaIntermediada' => now(),
                'montoTotal_VentaIntermediada' => 120,
                'puntosGanados_VentaIntermediada' => 120,
                'estadoVentaIntermediada' => 'Tiempo agotado',
            ],
        ];

        foreach ($ventasIntermediadas as $venta) {
            VentaIntermediada::create($venta);
        }
    }
}
