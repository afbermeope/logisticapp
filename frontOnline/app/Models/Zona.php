<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'evento_id', 'estado'];

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }

    public function cabecera()
    {
        return $this->hasMany(Cabecera::class);
    }
}
