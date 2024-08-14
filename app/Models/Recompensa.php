<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recompensa extends Model
{
    use HasFactory;
    
    protected $table = "Recompensas";

    protected $primaryKey = 'idRecompensa';

    public $incrementing = false;  // Indica que la clave primaria no es auto-incrementable

    protected $keyType = 'string';  // Indica que la clave primaria es de tipo string

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
