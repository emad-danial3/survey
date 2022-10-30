<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tokens extends Model
{
    public $table="tokens";
    public $timestamps = true;
    protected $fillable = [
        'user_id', 'token','type','lang_code','login','notifications'
    ];
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}
