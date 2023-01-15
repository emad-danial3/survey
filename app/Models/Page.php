<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public $table="pages";
    public $timestamps = true;
    protected $fillable = [
        'id','name','from_date','to_date','option_1_percent','option_2_percent','option_3_percent','option_4_percent','option_5_percent','status'
    ];

    public function user_surveys()
    {
        return $this->hasMany('App\Models\UsersSurveys','survey_id','id');
    }

}
