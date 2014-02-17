<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
	// return "text nesto";
});

Route::get('/audit', function(){
	// return Audit::pozdrav();
	// $sess = new Session_record();
	// $sess->subject_id = 6;
	// $sess->subject_type = 'user';
	// $sess->subject_address =  $_SERVER['REMOTE_ADDR'];
	// $sess->started_at = date('Y-m-d H:i:s');
	// $sess->save();
	// $nextWeek = time() + (7*24*60*60);
	// $sess->ended_at = date('Y-m-d H:i:s');
	// $sess->save();
	Audit::createSessionRecord(18, 'Petar');
	return "successfyllyyshh;";
});
