<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Radio extends Model
{
    const NUEVO = 'nuevo';
    const USADO = 'usado';
    // const DANADO = 'danado';

    protected $fillable = [
        'nombre',
        'imei',
        'modelo',
        'status',
        'cliente_id'
    ];

    public function status()
    {
        return $this->status == Radio::USADO;
    }

    public function Cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
