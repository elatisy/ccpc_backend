<?php
/**
 * Created by PhpStorm.
 * User: elatis
 * Date: 2018/10/5
 * Time: 21:28
 */

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'    => 'news'
], function (){
    Route::get('/nid/{nid}', 'NewsController@getNewsByNid');
    Route::get('/allnews', 'NewsController@getAllNews');

    Route::group([
        'middleware' => ['admin', 'auth']
    ],function (){
        Route::post('/write', 'NewsController@writeNews');
        Route::post('/update/{nid}', 'NewsController@updateNews');
        Route::get('/delete/{nid}', 'NewsController@deleteNews');
    });
});