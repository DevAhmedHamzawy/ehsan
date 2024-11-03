<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth','checkauth']],function(){

// Home Page If Authenticated :- Redirect To Dashboard
Route::get('/home', function () {  return redirect()->to('/dashboard'); });
Route::get('/dashboard', 'admin\DashboardController@index')->name('home');

// Users
Route::resource('users', 'admin\UserController')->except(['delete','show']);
Route::get('users/{user}', 'admin\UserController@destroy')->name('users.delete');

// Admins
Route::resource('admins', 'admin\AdminController')->only(['index','create','store']);
Route::get('admins/{user}/edit', 'admin\AdminController@edit')->name('admins.edit');
Route::put('admins/{user}', 'admin\AdminController@update')->name('admins.update');
Route::get('admins/{user}', 'admin\AdminController@destroy')->name('admins.delete');

// Partners
Route::resource('partners', 'admin\PartnerController');
Route::get('partners/{partner}', 'admin\PartnerController@destroy')->name('partners.delete');

// Questions
Route::resource('questions', 'admin\QuestionController')->except(['delete','show']);
Route::get('questions/{question}', 'admin\QuestionController@destroy')->name('questions.delete');
Route::post('excelquestions', 'admin\QuestionController@excel')->name('excel');

// Competitions
Route::resource('competitions', 'admin\CompetitionController')->except(['delete','show']);
Route::get('competitions/{competition}', 'admin\CompetitionController@destroy')->name('competitions.delete');

// Categories
Route::resource('categories', 'admin\CategoryController')->except(['delete','show']);
Route::get('categories/{category}', 'admin\CategoryController@destroy')->name('categories.delete');

// Posters
Route::resource('posters', 'admin\PosterController')->except(['delete','show']);
Route::get('posters/{poster}', 'admin\PosterController@destroy')->name('posters.delete');

// Get The Scales For Posters
Route::resource('scales/{id}/{type}/{request}', 'admin\ScaleController')->only(['index']);

// Get Competition Posters
Route::get('competition/posters/{id}', 'admin\CompetitionPosterController@index')->name('competitionposters.index');

// Get Competition Results
Route::get('results/{competition_id}', 'admin\ResultController@index')->name('results.index');

// Search Competitions
Route::post('searchcompetitions', 'admin\CompetitionController@search')->name('competitions.search');

// Get Competition contributors
Route::get('contributors/{competition_id}', 'admin\ContributorController@index')->name('contributors.index');

// SpinWheels 
Route::resource('spinwheels', 'admin\SpinwheelController')->only(['index', 'create']);
Route::get('getspinwheels', 'admin\SpinwheelController@get')->name('spinwheels.get');

// Settings
Route::resource('settings', 'admin\SettingController')->only(['edit','update']);

//Get All Areas (Countries And Cities)
Route::resource('areas/{id}', 'admin\AreaController')->only(['index']);

});