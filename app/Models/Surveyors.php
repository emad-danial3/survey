<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surveyors extends Model
{
    //

    public $table="surveyors";
    public $timestamps = true;
    protected $fillable = [
        'id','email','name'
    ];

}
