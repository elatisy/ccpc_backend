<?php
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'    => 'user'
],function (){
    Route::post('login','UserController@login')->middleware('user.login');

    Route::group([
        'middleware'    => 'auth'
    ],function (){
        Route::post('alterpassword', 'UserController@alterPassword');
    });
});