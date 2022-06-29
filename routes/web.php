<?php

use Illuminate\Support\Facades\Auth;
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

Route::group(['namespace' => 'App\Http\Controllers'], function()
{
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');

    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');

        /**
         * User Routes
         */
        Route::group(['prefix' => 'users'], function() {
            Route::get('/', 'UsersController@index')->name('users.index');
            Route::get('/create', 'UsersController@create')->name('users.create');
            Route::post('/create', 'UsersController@store')->name('users.store');
            Route::get('/{user}/show', 'UsersController@show')->name('users.show')->where('user','[0-9]+');
            Route::get('/{user}/edit', 'UsersController@edit')->name('users.edit')->where('user','[0-9]+');
            Route::patch('/{user}/update', 'UsersController@update')->name('users.update');
            Route::get('/{user}/delete', 'UsersController@destroy')->name('users.destroy');
            Route::get('/user_show', 'UsersController@showCurrentUser')->name('users.showCurrentUser');
        });

        Route::group(['prefix'=>'posts'],function(){
            Route::get('/', 'DataRowsController@index')->name('posts.index');
        });

        Route::resource('json','JsonController');

    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('allUsers',[App\Http\Controllers\UsersController::class, 'allUsers']);
Route::post('allPosts',[App\Http\Controllers\DataRowsController::class,'allPosts']);


Auth::routes();
