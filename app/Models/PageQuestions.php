<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageQuestions extends Model
{
    //
    public $table="page_details";
    public $timestamps = true;
    protected $fillable = [
        'page_id','location_id','category_id'
    ];

    public function page()
    {
        return $this->belongsTo('App\Models\Page','page_id','id');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category','category_id','id');
    }
    public function location()
    {
        return $this->belongsTo('App\Models\Locations','location_id','id');
    }
    public function users()
    {
        return $this->hasMany('App\Models\PageQuestionUsers','page_detail_id','id');
    }



}
