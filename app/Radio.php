<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Radio extends Model
{
    use SoftDeletes;

    const NUEVO = 'nuevo';
    const USADO = 'usado';
    // const DANADO = 'danado';
    protected $dates = ['deleted_at'];

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
