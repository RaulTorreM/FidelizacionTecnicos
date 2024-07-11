<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tecnico extends Model
{
    use HasFactory;

    protected $table = "Tecnicos";
    
    protected $primaryKey = 'idTecnico';

    protected $fillable = [
        'idTecnico',
        'nombreTecnico',
        'celularTecnico',
        'oficioTecnico',
        'fechaNacimiento_Tecnico',
        'totalPuntosActuales_Tecnico',
        'historicoPuntos_Tecnico',
        'rangoTecnico',
    ];

    public function ventasIntermediadas() {
        return $this->hasMany(VentaIntermediada::class, 'idTecnico', 'idTecnico');
    }
}
