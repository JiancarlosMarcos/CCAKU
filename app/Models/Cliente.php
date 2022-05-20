<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = "cliente";
    use HasFactory;

    public function requerimiento_cliente()
    {
        return $this->hasMany(Requerimiento::class,'id');
    }

    public function tipo(){
        return $this->belongsTo(Tipo::class,'id_tipo');
    }
}
