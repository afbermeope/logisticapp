<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarifa extends Model
{
    use HasFactory;

    protected $fillable = ['hora', 'valor', 'cargo_id', 'estado'];

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }

    public function cabeceras()
    {
        return $this->hasMany(Cabecera::class);
    }

}
