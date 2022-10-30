<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageQuestionUsers extends Model
{
    //
    public $table="page_details_users";
    public $timestamps = true;
    protected $fillable = [
        'page_detail_id','user_id'
    ];

    public function pageQuestion()
    {
        return $this->belongsTo('App\Models\PageQuestions','page_detail_id','id');
    }
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }



}
