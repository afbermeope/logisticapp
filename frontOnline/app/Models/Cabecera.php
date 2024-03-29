<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabecera extends Model
{
    use HasFactory;

    protected $fillable = ['horario','evento_id', 'zona_id', 'persona_id', 'cantidad_horas', 'cargo_id', 'tarifa_id', 'estado'];

    public function zona()
    {
        return $this->belongsTo(Zona::class);
    }

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function tarifa()
    {
        return $this->belongsTo(Tarifa::class);
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }

    public function detalleTurnos()
    {
        return $this->hasMany(DetalleTurno::class);
    }
}
