<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactoCliente extends Model
{
    protected $table = "contacto_cliente";
    use HasFactory;

    public function requerimiento_contacto()
    {
        return $this->hasMany(Requerimiento::class,'id');
    }
}
