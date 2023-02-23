<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atr_policy extends Model
{
    public    $table      = "atr_policies";
    public    $timestamps = false;
    protected $fillable   = [
        "departments_id",
        "policy_name",
        "policy_content",
        "policy_page",
        "policy_path",
        
    ];


    public function Departments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Department::class,'id','departments_id');
    }

}
