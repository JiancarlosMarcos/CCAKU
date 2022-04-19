<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Vehiculo;

class Vehiculos extends Component
{
    public $vehiculos;
    public function render()
    {
        $this->vehiculos = Vehiculo::all();
        return view('livewire.vehiculos');
    }
}
