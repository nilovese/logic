<?php

namespace App\Http\Controllers;

use App\Logic\UserManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userManager;

    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    public function ProcessAuthCode(Request $request)
    {
        return $this->userManager->SaveUserFromCurl($request);
    }


    public function Profiles()
    {

    }

    public function NewProfile()
    {
        
    }
}
