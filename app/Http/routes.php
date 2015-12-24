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


Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');


Route::get("login",function()
{
    $params["client_id"] = env('clitnt_id');
    $params["redirect_uri"] = env('redirect_uri');
    $params["response_type"] = "code";
    //$params["scope"] = "read,write";
    $params["state"] = time();
    $url_string = ProcessUrlParams($params);
    return redirect(env("api_url")."oauth/authorize?".$url_string, 301);
});


Route::get("register",function()
{
    $params["client_id"] = env('clitnt_id');
    $params["redirect_uri"] = env('redirect_uri');
    $params["response_type"] = "code";
    //$params["scope"] = "read,write";
    $params["state"] = time();
    $url_string = ProcessUrlParams($params);
    return redirect(env("api_base_url")."?".$url_string, 301);
});


Route::get("receiveauthcode",['as' => 'user.info', 'uses' => 'UserController@ProcessAuthCode']);

