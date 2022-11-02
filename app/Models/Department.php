<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    public $table="departments";
    public $timestamps = true;
    protected $fillable = [
        'id','name','status'
    ];
}
