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
Route::group(['prefix' => 'v1'], function($router){


    /*** TEST ***/
    Route::get('/test', function(){
        return "Hello";
    });

    /*** CLEAR CACHE ***/
    Route::get('/clear-cache', function() {
        Artisan::call('cache:clear');
        Artisan::call('config:cache');
        return "Cache is cleared";
    });

    
    /*** ARTICLES ***/
    Route::group(['prefix' => 'article'], function($router){
        Route::get('/index', 'v1\ArticleController@index');
        Route::post('/create', 'v1\ArticleController@store');
        Route::get('/{id}', 'v1\ArticleController@show');
        Route::delete('/{id}', 'v1\ArticleController@destroy');
    });


});

