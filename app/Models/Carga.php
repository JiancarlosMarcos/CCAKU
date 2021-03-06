<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carga extends Model
{
    protected $table = "carga_cliente";
    use HasFactory;

    public function requerimiento_carga()
    {
        return $this->hasMany(Requerimiento::class,'id');
    }
}
