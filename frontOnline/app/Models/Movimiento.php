<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    use HasFactory;
    
    protected $fillable = ['descripcion', 'detalle_turno_id', 'estado'];

    public function alimentos()
    {
        return $this->hasMany(Alimento::class);
    }

    public function elementos()
    {
        return $this->hasMany(Elemento::class);
    }
    
    public function detalleTurno()
    {
        return $this->belongsTo(DetalleTurno::class);
    }
}
