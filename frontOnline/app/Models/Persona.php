<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'nombre', 'cedula', 'telefono', 'correo', 'direccion', 'estado'];

    public function cabeceras()
    {
        return $this->hasMany(Cabecera::class);
    }

}
