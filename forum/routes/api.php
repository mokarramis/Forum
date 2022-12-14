<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');
Route::get('index', 'Api\TreadController@index');
Route::post('create-thread', 'Api\TreadController@create')->middleware('auth:api');
Route::get('show-thread/{thread}', 'Api\TreadController@show');
Route::post('remove', 'Api\TreadController@destroy');

Route::get('show', 'Api\ChannelController@show');
Route::get('channel/{channel}', 'Api\ChannelController@thread');

Route::get('{reply}/add-favorite', 'Api\FavoriteController@store');