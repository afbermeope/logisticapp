<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alimento extends Model
{
    use HasFactory;

    protected $fillable = ['descripcion', 'movimiento_id', 'estado'];

    public function movimiento()
    {
        return $this->belongsTo(Movimiento::class);
    }
}
