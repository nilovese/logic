<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {

    
    return view('home.home');
});

Route::get('dashboard', ['middleware' => ['auth'], function () {

     return view('home.dashboard');
}]);

Route::get('authcheck', ['middleware' => ['auth'], function () {

    return \Auth::user();
}]);





Route::get("login",function()
{
    $params["client_id"] = env('clitnt_id');
    $params["redirect_uri"] = env('redirect_uri');
    $params["response_type"] = "code";
    $params["state"] = time();
    $url_string = ProcessUrlParams($params);
    return redirect(env("api_url")."oauth/authorize?".$url_string, 301);
});


Route::get("logout",function()
{
    \Auth::logout();
    $params["client_id"] = env('clitnt_id');
    $params["redirect_uri"] = url("/");
    $params["response_type"] = "code";
    $params["state"] = time();
    $url_string = ProcessUrlParams($params);
    return redirect(env("api_logout_url")."?".$url_string, 301);
});


Route::get("register",function()
{
    $params["client_id"] = env('clitnt_id');
    $params["redirect_uri"] = env('redirect_uri');
    $params["response_type"] = "code";
    $params["state"] = time();
    $url_string = ProcessUrlParams($params);
    return redirect(env("api_base_url")."?".$url_string, 301);
});


Route::get("receiveauthcode",['as' => 'user.info', 'uses' => 'UserController@ProcessAuthCode']);


Route::group(['prefix' => 'profile', 'middleware' => 'auth'], function()
{
    Route::post("save",["as"=>"saveprofile" ,"uses"=>"UserController@SaveProfile"]);
    Route::get("edit/{profileid}",["uses"=>"UserController@Edit","as"=>"editview"]);
    Route::post("edit","UserController@SaveEditProfile");
    Route::get("create","UserController@NewProfile");
    Route::get("all",["as"=>"profiles","uses"=>"UserController@Profiles"]);
});


Route::group(['prefix' => 'sync'], function()
{
    Route::post("profile",["as"=>"syncprofile" ,"uses"=>"UserController@SaveProfile"]);
});




