<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elemento extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'cantidad', 'movimiento_id', 'estado'];

    public function movimiento()
    {
        return $this->belongsTo(Movimiento::class);
    }
}
