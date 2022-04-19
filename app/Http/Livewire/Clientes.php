<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cliente;

class Clientes extends Component
{
    public $clientes;
    public $modal = false;

    public function render()
    {
        $this->clientes = Cliente::all();
        return view('livewire.clientes');
    }

    public function abrirModal()
    {
        $this->modal = true;
    }

    public function cerrarModal()
    {
        $this->modal = false;
    }

    public function editar($id)
    {
        $cliente = Cliente::findOrFail($id);
        $this->id = $id;
        $this->nombre = $cliente->nombre;
        $this->abrirModal();
    }
}
