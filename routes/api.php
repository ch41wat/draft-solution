<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test/{id}', function($id){
	return '....'.$id;
	
});

Route::get('/test1', 'WelcomeController@index');

Route::get('/chklogin', 'HomeController@checkuser');

//Route::get('/chklogin/{id}', ['uses' =>'HomeController@checkuser', 'user'=>'test']);
