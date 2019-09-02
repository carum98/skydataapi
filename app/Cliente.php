<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    const ejecutivos = ['Nathalia', 'Cindy', 'Juan Carlos'];
    const modadlidad = ['Alquiler', 'DEMO', 'Venta'];
    protected $fillable = [
        'nombre',
        'modalidad',
        'ejecutivo'
    ];

    public function Radios()
    {
        return $this->hasMany(Radio::class);
    }

}
