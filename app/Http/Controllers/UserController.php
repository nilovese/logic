<?php

namespace App\Http\Controllers;

use App\Logic\UserManager;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
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
        $result = ProcessCurl(env("api_url")."oauth/access_token",
            array("client_secret" => env("clitnt_secret"),
                      "client_id" => env("clitnt_id"),
                   "redirect_uri" => env("redirect_uri"),
                           "code" => $request->code,
                           "state" => time(),
                      "grant_type" => "authorization_code"

                ));

        $response = json_decode($result,TRUE);
        $user = ExecuteGet(env("api_url")."user/info?access_token={$response["access_token"]}");
        $userData = json_decode($user,TRUE);

        $userData["access_token"] = $response["access_token"];
        $this->userManager->SaveUser($userData);

        return $user;
    }
}
