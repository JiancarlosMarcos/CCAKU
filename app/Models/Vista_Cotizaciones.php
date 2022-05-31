<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vista_Cotizaciones extends Model
{
    protected $table = "vista_cotizaciones";
    protected $dates = ["fecha_transporte"];
    use HasFactory;
}
