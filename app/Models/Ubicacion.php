<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $table = "ubicacion";
    use HasFactory;

    public function cotizacion_ubicaciones()
    {
        return $this->hasMany(Cotizacion::class,'id');
    }
}
