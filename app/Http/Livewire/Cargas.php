<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Carga;

class Cargas extends Component
{
    public $cargas;
    public function render()
    {
        $this->cargas = Carga::all();
        return view('livewire.cargas');
    }
}
