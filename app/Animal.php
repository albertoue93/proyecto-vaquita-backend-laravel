<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    //
    protected $table = "animales";

    protected $fillable = [
        'numeroAnimal','raza','peso','edad','foto','finca_id','estado' 
    ];
}
