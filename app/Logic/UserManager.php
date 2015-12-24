<?php
/**
 * Created by PhpStorm.
 * User: kausersarker
 * Date: 12/24/15
 * Time: 12:45 PM
 */

namespace App\Logic;


use App\User;

class UserManager
{
    public function SaveUser($data)
    {

        return User::create($data);
    }
}