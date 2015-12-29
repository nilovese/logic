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
        Auth::login($this->userManager->SaveUserFromCurl($request));
        return redirect(url("profile/all"));
    }


    public function Profiles()
    {
        return view("profile.profiles",["profiles"=>Auth::user()->profiles]);
    }

    public function SaveProfile(Request $request)
    {
        $this->userManager->SaveProfile($request,Auth::user()->access_token);
        return redirect(route("profiles"));
    }

    public function Edit($profile_id)
    {
        $profile = $this->userManager->GetProfile($profile_id);
        //dd($profile);
        return view("profile.edit",["profile" => $profile]);
    }

    public function SaveEditProfile(Request $request)
    {
        $this->userManager->EditProfile($request,Auth::user()->access_token);
        return redirect(route("profiles"));
    }

    public function NewProfile()
    {
        return view("profile.new");
    }
}
