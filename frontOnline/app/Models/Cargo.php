<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;
    
    protected $fillable = ['nombre', 'evento_id', 'estado'];

    public function tarifas()
    {
        return $this->hasMany(Tarifa::class);
    }

    public function cabeceras()
    {
        return $this->hasMany(Cabecera::class);
    }

    public function evento(){
        return $this->belongsTo(Evento::class);
    }
    
}
