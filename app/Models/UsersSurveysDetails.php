<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersSurveysDetails extends Model
{
    //
    public $table="users_surveys_details";
    public $timestamps = true;
    protected $fillable = [
        'users_surveys_id', 'question_id','user_id','chose_option','answer'
    ];

}
