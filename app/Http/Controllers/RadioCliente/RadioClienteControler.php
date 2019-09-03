<?php

namespace App\Http\Controllers\RadioCliente;

use App\Cliente;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class RadioClienteControler extends ApiController
{
    public function cliente(Cliente $cliente)
    {
        $radios = $cliente->radios;
        return $this->showAll($radios);
    }
}
