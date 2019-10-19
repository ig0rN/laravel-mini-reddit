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

Route::post('/register', 'Auth\RegisterController@register');

Route::middleware('auth:api')->group(function(){

    Route::get('/threads', 'ThreadController@index');
    Route::post('/threads', 'ThreadController@store');
    Route::get('/threads/{thread}', 'ThreadController@show');
    Route::post('/threads/{thread}', 'ThreadController@reply');
    Route::put('/threads/{thread}', 'ThreadController@update');
    Route::delete('/threads/{thread}', 'ThreadController@destroy');

    Route::get('/comments/{comment}', 'CommentController@show');
    Route::post('/comments/{comment}', 'CommentController@reply');
    Route::delete('/comments/{comment}', 'CommentController@destroy');

});
