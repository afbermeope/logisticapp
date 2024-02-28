<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleTurno extends Model
{
    use HasFactory;

    protected $fillable = ['cabecera_id', 'numero_dia', 'estado'];

    public function cabecera()
    {
        return $this->belongsTo(Cabecera::class);
    }

    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }
}
