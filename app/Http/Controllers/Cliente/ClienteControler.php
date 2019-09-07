<?php

namespace App\Http\Controllers\Cliente;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Cliente;

class ClienteControler extends ApiController
{

    public function __construct()
    {
        $this->middleware('client.credentials')->only(['index','show']);
        $this->middleware('auth:api')->except(['index','show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::all();
        return $this->showAll($clientes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reglas = [
            'nombre' => 'required',
            'ejecutivo' => 'required',
            'modalidad' => 'required'
        ];
        $this->validate($request, $reglas);

        $campos = $request->all();
        $cliente = Cliente::create($campos);

        return $this->showOne($cliente, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return $this->showOne($cliente);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        if ($request->has('nombre')) {
            $cliente->nombre = $request->nombre;
        }
        if ($request->has('ejecutivo')) {
            $cliente->ejecutivo = $request->ejecutivo;
        }
        if ($request->has('modalidad')) {
            $cliente->modalidad = $request->modalidad;
        }
        if (!$cliente->isDirty()) {
            return $this->errorResponse('Tiene que introducir al menos un campo', 422);
        }

        $cliente->save();
        return $this->showOne($cliente);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return $this->showOne($cliente);
    }   
}
