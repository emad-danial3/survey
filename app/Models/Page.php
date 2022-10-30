<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public $table="pages";
    public $timestamps = true;
    protected $fillable = [
        'id','name','from_date','to_date','status'
    ];

}
