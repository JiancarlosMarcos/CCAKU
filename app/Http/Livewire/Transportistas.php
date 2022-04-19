<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Transportista;

class Transportistas extends Component
{
    public $transportistas;
    public function render()
    {
        $this->transportistas = Transportista::all();
        return view('livewire.transportistas');
    }
}
