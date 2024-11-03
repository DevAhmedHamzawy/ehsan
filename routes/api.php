<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


// Auth System Using PostMan
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
  
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});


Route::group(['middleware' => 'auth:api'], function () {    

    // Get Categories
    Route::get('get-categories', 'CategoryController@index');

    // Get Competitions By Id
    Route::get('get-competition/{id}', 'CompetitionController@index');

    // Get Question By Id
    Route::get('get-questions/{id}', 'QuestionController@index');

    // Get All Posters
    Route::get('get-posters', 'PosterController@index');

    // Get All Partners
    Route::get('get-partners', 'PartnerController@index');
    
    // Get Settings
    Route::get('get-settings', 'SettingController@index');

    // Get Posters By Competition Id
    Route::get('get-posters/{competition_id}', 'PosterController@index');

    // Save Competition Result
    Route::get('save-result/{competition_id}/{right_answer}/{wrong_answer}', 'ResultController@store');

    // Get To Users In Points
    Route::get('get-top-points', 'ResultController@topPoints');
});