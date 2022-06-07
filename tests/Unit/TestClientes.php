<?php

namespace Tests\Unit;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Collection;
use PHPUnit\Framework\TestCase;

class TestClientes extends TestCase
{
    public function test_example(){
        $test_clientes = new Cliente();
        $this->assertInstanceOf(Collection::class, $test_clientes);
    }
}
