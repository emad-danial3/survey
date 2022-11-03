<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersSurveys extends Model
{
    //
    public $table="users_surveys";
    public $timestamps = true;
    protected $fillable = [
        'EMAIL_ADDRESS', 'EMPLOYEE_ID','LAST_NAME', 'survey_id','location_id',
    ];

    public function details()
    {
        return $this->hasMany('App\Models\UsersSurveysDetails','users_surveys_id','id');
    }

    public function location()
    {
        return $this->belongsTo('App\Models\Locations','location_id','id');
    }
    public function survey()
    {
        return $this->belongsTo('App\Models\Page','survey_id','id');
    }
}
