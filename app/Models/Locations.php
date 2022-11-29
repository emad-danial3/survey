<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    //
    public $table="locations";
    public $timestamps = true;
    protected $fillable = [
        'id','name','status','location_type','area'
    ];
    public function location_pages()
    {
        return $this->hasMany('App\Models\Page','location_id','id');
    }
    public function user_surveys()
    {
        return $this->hasMany('App\Models\UsersSurveys','location_id','id');
    }

}
