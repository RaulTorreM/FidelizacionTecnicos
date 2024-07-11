<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaIntermediada extends Model
{
    use HasFactory;

    protected $table = 'VentasIntermediadas';

    protected $primarykey = 'idVentaIntermediada';

    protected $fillable = [
        'idVentaIntermediada',
        'idTecnico',
        'nombreTecnico',
        'tipoCodigoCliente_VentaIntermediada',
        'codigoCliente_VentaIntermediada',
        'nombreCliente_VentaIntermediada',
        'fechaHoraEmision_VentaIntermediada',
        'fechaHoraCargada_VentaIntermediada',
        'montoTotal_VentaIntermediada',
        'puntosGanados_VentaIntermediada',
        'estadoVentaIntermediada',
    ];

    // Relación uno a muchos (inversa)
    public function tecnico() {
        return $this->belongsTo(Tecnico::class, 'idTecnico', 'idTecnico');
    }

     // Relación uno a muchos
    public function canjes()
    {
        return $this->hasMany(Canje::class, 'idVentaIntermediada', 'idVentaIntermediada'); 
    }
}
