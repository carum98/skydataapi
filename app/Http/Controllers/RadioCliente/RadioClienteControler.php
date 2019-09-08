<?php

namespace App\Http\Controllers\RadioCliente;

use App\Cliente;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class RadioClienteControler extends ApiController
{
    public function __construct()
    {
        $this->middleware('client.credentials')->only('cliente');
        // $this->middleware('auth:api')->except(['index','show']);
        // $this->middleware('scope:create-radios')->only('store');
        // // $this->middleware('scope:read-general')->only('index');
    }

    public function cliente(Cliente $cliente)
    {
        $radios = $cliente->radios;
        return $this->showAll($radios);
    }
}
