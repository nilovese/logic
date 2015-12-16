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

    if(\Cookie::get("identifier") != "")
    {

        $user = \App\User::where(["identifier"=>\Cookie::get("identifier")])->first();
        \Auth::login($user);
        //return $next($request);
    }
    
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