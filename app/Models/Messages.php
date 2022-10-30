<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    public $table="messages";
    public $timestamps = true;
    protected $fillable = [
        'user_id','to_user_id','chat_rooms_id','status','type','message','lat','lon',
    ];

}
