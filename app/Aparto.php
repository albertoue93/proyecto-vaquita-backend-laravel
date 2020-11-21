<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aparto extends Model
{
    //
    protected $table = "apartos";

    protected $fillable = [
        'numeroAparto','mts2','finca_id' 
    ];

    public function fincas()
    {
        return $this->hasOne('App\Finca','finca_id','id');
    }
}
