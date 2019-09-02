<?php

namespace App\Http\Controllers\Cliente;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cliente;

class ClienteControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::all();
        return response()->json(['data'=>$clientes], 200);
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
        $ejecutivos = Cliente::ejecutivos;
        $modalidad = Cliente::modadlidad;
        $reglas = [
            'nombre' => 'required',
            'ejecutivo' => 'required',
            'modalidad' => 'required'
        ];
        $this->validate($request, $reglas);

        $campos = $request->all();
        $cliente = Cliente::create($campos);

        return response()->json(['data'=>$cliente],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);
        return response()->json(['data'=>$cliente], 200);
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
    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);

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
            return response()->json(['error' => 'Tiene que introducir al menos un campo', 'code'=>422], 422);
        }

        $cliente->save();
        return response()->json(['data'=> $cliente]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        return response()->json(['data'=>$cliente],200);
    }
}
