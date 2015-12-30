<?php
/**
 * Created by PhpStorm.
 * User: kausersarker
 * Date: 12/24/15
 * Time: 12:45 PM
 */

namespace App\Logic;
use App\Profile;
use App\User;

class UserManager
{
    protected $curlManager;
    protected $request;

    public function __construct(CurlManager $curlManager)
    {
        $this->curlManager = $curlManager;
    }

    public function SaveUserFromCurl($request)
    {
        
        $this->request = $request;
        $this->curlManager->SetCurlUrl(env("api_url")."oauth/access_token");
        $this->curlManager->SetCurlData(
            [
                "client_secret" => env("clitnt_secret"),
                "client_id" => env("clitnt_id"),
                "redirect_uri" => env("redirect_uri"),
                "code" => $this->request->code,
                "state" => time(),
                "grant_type" => "authorization_code"
            ]
        );
        $response = $this->curlManager->ProcessCurl();
        $response_decode = json_decode($response,TRUE);
        $access_token = $response_decode["access_token"];
        $user = $this->curlManager->ExecuteGet(env("api_url")."user/info?access_token=".$access_token);
        $userData = json_decode($user,TRUE);
        $userData["access_token"] = $response_decode["access_token"];
        $userData["root_id"] = $userData["id"];
        return $this->SaveUser($userData);
    }


    public function SaveUser($data)
    {
        $user = User::where(["root_id"=>$data["id"]])->first();
        unset($data["id"]);
        if($user)
        {
            $user->update($data);
            return $user;
        }
        return User::create($data);
    }


    public function SaveProfile($request,$token)
    {
        $this->request = $request->all();
        $this->request["access_token"] = $token;
        $this->request["client_id"] = env("clitnt_id");
        $this->curlManager->SetCurlUrl(env("api_url")."profile/save");
        $this->curlManager->SetCurlData($this->request);
        $response = $this->curlManager->ProcessCurl();
        $response = json_decode($response,TRUE);
        return Profile::create($response);
    }

    public function EditProfile($request,$token)
    {
        $this->request = $request->all();
        $this->request["access_token"] = $token;
        $this->request["client_id"] = env("clitnt_id");
        $this->curlManager->SetCurlUrl(env("api_url")."profile/edit");
        $this->curlManager->SetCurlData($this->request);
        $response = $this->curlManager->ProcessCurl();
        $response = json_decode($response,TRUE);
        $profile = Profile::find($response["id"]);
        $profile->update($response);
        return $profile;
    }


    public function Profiles($user_id)
    {
        return Profile::where(["user_id"=>$user_id])->get();
    }


    public function GetProfile($profile_id)
    {
        return Profile::find($profile_id);
    }

}