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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::post('/findtasker', 'TaskerController@index');

Route::post('/sendtaskrequest', 'TaskerController@sendtaskrequest');

Route::post('/submittaskorder', 'TaskerController@submittaskorder');

Route::get('/showcatusers/{cat_id}',['uses'=>'TaskerController@findworkers']);

Route::get('/canceltask/{id}',['uses'=>'TaskerController@canceltask']);

Route::group(['prefix'=>'/admin'],function (){

    Route::get('/workerprofile',['uses'=>'AdminController@workers']);

    Route::get('/categories',['uses'=>'AdminController@categories']);

    Route::get('/EditCat/{id}',['uses'=>'AdminController@EditCat']);

    Route::post('/saveeditcat',['uses'=>'AdminController@saveeditcat']);

    Route::post('/workerprofilestatus',['uses'=>'AdminController@workerprofilestatus']);

    Route::get('/broadcast',['uses'=>'AdminController@broadcast']);

    Route::get('/getallbroadcast',['uses'=>'AdminController@getallbroadcast']);

});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

