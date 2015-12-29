<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['name', 'phone', 'country',"city","dob","user_id"];

    public function User()
    {
        return $this->belongsTo("App\User");
    }
}
