<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public $table="categories";
    public $timestamps = true;
    protected $fillable = [
        'img', 'name','status',
    ];


    public function posts()
    {
        return $this->hasMany('App\Models\Posts','category_id','id');
    }
    public function questions()
    {
        return $this->hasMany('App\Models\Question','category_id','id');
    }
}
