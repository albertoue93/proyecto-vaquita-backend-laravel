<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Finca extends Model
{
    //
    protected $fillable = [
        'nombreFinca'
    ];

    public function apartos()
    {
        return $this->hasOne('App\Aparto');
    }
}
