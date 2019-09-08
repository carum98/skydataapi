<?php

namespace App\Http\Controllers\Radio;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Radio;

class RadioControler extends ApiController
{
    public function __construct()
    {
        $this->middleware('client.credentials')->only(['index','show']);
        $this->middleware('auth:api')->except(['index','show']);
        $this->middleware('scope:create-radios')->only('store');
        // $this->middleware('scope:read-general')->only('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $radios = Radio::all();
        return $this->showAll($radios);
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
        'imei' => 'required',
        'modelo' => 'required',
        'status' => 'required|in:'.Radio::NUEVO.','.Radio::USADO,
        'cliente_id' => 'required'
        ];
        $this->validate($request, $reglas);

        $campos = $request->all();

        $radio = Radio::create($campos);
        return $this->showOne($radio, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Radio $radio)
    {
        return $this->showOne($radio);
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
    public function update(Request $request, Radio $radio)
    {
        if ($request->has('nombre')) {
            $radio->nombre = $request->nombre;
        }
        if ($request->has('imei')) {
            $radio->imei = $request->imei;
        }
        if ($request->has('modelo')) {
            $radio->modelo = $request->modelo;
        }
        if ($request->has('ejecutivo')) {
            $radio->ejecutivo = $request->ejecutivo;
        }
        if ($request->has('cliente_id')) {
            $radio->cliente_id = $request->cliente_id;
        }
        if (!$radio->isDirty()) {
            return $this->errorResponse('Tiene que introducir al menos un campo', 422);
        }
        $radio->save();

        return $this->showOne($radio);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Radio $radio)
    {
        $radio->delete();
        return $this->showOne($radio);
    }
}
