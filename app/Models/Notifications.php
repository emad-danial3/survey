<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    public $table="notifications";
    public $timestamps = true;
    protected $fillable = [
        'receive_user_id', 'send_user_id','title','body','status','order_id','notification_type'
    ];

}
