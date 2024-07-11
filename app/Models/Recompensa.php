<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recompensa extends Model
{
    use HasFactory;
    
    protected $table = "Recompensas";

    protected $primaryKey = 'idRecompensa';

    protected $fillable = [
        'idRecompensa',
        'tipoRecompensa',
        'descripcionRecompensa',
        'costoPuntos_Recompensa',
    ];

    public function canjes() {
        return $this->hasMany(Canje::class, 'idRecompensa', 'idRecompensa');
    }
}
