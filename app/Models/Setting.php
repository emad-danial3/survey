<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('phone', 'email', 'text', 'image', 'whats_app', 'instagram', 'you_tube', 'twitter', 'facebook', 'option_1', 'option_2', 'option_3','option_5');

}
