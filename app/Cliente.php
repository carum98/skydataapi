<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;
    const ejecutivos = ['Nathalia', 'Cindy', 'Juan Carlos'];
    const modadlidad = ['Alquiler', 'DEMO', 'Venta'];

    protected $dates = ['deleted_at'];
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
