<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requerimiento extends Model
{
    protected $table = "requerimiento";
    protected $dates = ["fecha"];
    use HasFactory;

    public function cotizaciones_requerimiento(){
        return $this->hasMany(Cotizacion::class, "id");
     }

    public function contacto(){
        return $this->belongsTo(ContactoCliente::class,'id_contacto');
    }

    public function carga(){
        return $this->belongsTo(Carga::class,'id_carga_cliente');
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class,'id_cliente');
    }

}
