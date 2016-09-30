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

Route::get('/', 'HomeController@index');

Route::auth();
// Socialite auth for facebook
Route::get('auth/facebook', 'Auth\AuthController@loginFacebook');
Route::get('login_facebook', 'Auth\AuthController@loginFacebook');
// Socialite auth for twitter
Route::get('auth/twitter', 'Auth\AuthController@loginTwitter');
Route::get('login_twitter', 'Auth\AuthController@loginTwitter');
// register auth routes
Route::get('register', ['as' => 'register', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('register', ['as' => 'register', 'uses' => 'Auth\AuthController@postRegister']);
// onboarding welcome page
Route::get('/welcome', 'HomeController@welcome');
// Settings
Route::get('/settings', 'SettingsController@show');
// Profile Contact Information...
Route::put('/settings/profile', 'SettingsController@updateProfile');
Route::post('/settings/photo', 'SettingsController@updatePhoto');
// User
Route::get('/@{username}', ['as' => 'profile_path', 'uses' => 'UserController@profile']);
Route::get('/users/{user_id}/shelves', 'UserController@allShelves');
Route::get('/@{username}/bookshelves', ['as' => 'bookshelves_path', 'uses' => 'UserController@profile']);
Route::get('/@{username}/shelves/{shelf_slug}', ['as' => 'shelf_path', 'uses' => 'UserController@shelf']);
Route::post('/user/welcome', 'UserController@welcome');
Route::get('/user/current', 'UserController@current');
Route::get('/user/shelves', 'UserController@shelves');
// Search
Route::get('/books/search', 'BookController@search');
Route::get('/shelves/search', 'ShelfController@search');
// Shelves
Route::post('/shelves', 'ShelfController@store');
Route::get('/shelves/{shelf_id}', 'ShelfController@show');
Route::put('/shelves/{shelf_id}', 'ShelfController@update');
Route::delete('/shelves/{shelf_id}', 'ShelfController@destroy');
Route::get('/shelves/{shelf_id}/books', 'ShelfController@getBooks');
Route::post('/shelves/{shelf_id}/books', 'ShelfController@storeBook');
Route::delete('/shelves/{shelf_id}/books', 'ShelfController@removeBook');

// Customer Support...
//Route::post('/support/email', 'SupportController@sendEmail');
