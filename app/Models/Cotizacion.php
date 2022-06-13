<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    protected $table = 'cotizacion_cliente';
    protected $dates = ['fecha_transporte'];
    use HasFactory;

    public function requerimiento(){
        return $this->belongsTo(Requerimiento::class,'id_requerimiento');
    }

    public function departamento_origen(){
        return $this->belongsTo(Ubicacion::class,'id_departamento_origen');
    }
    public function departamento_destino(){
        return $this->belongsTo(Ubicacion::class,'id_departamento_destino');
    }

    public function provincia_origen(){
        return $this->belongsTo(Provincia::class,'id_provincia_origen');
    }
    public function provincia_destino(){
        return $this->belongsTo(Provincia::class,'id_provincia_destino');
    }

    public function distrito_origen(){
        return $this->belongsTo(Distrito::class,'id_distrito_origen');
    }
    public function distrito_destino(){
        return $this->belongsTo(Distrito::class,'id_distrito_destino');
    }
}
