<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    public $table="category_questions";
    public $timestamps = true;
    protected $fillable = [
        'category_id', 'title','type','required'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category','category_id','id');
    }

}
