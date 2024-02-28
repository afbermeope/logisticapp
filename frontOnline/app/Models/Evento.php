<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'fecha_inicio', 'fecha_fin', 'dias', 'estado'];

    public function zonas()
    {
        return $this->hasMany(Zona::class);
    }

}
