<?php
/**
 * Created by PhpStorm.
 * User: elati
 * Date: 2018/8/30
 * Time: 19:46
 */

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'token'
], function (){
    Route::group([
        'prefix'        => 'admin/img',
        'middleware'    => 'admin'
    ],function (){
        Route::post('/upload', 'ImageController@upload');
        Route::post('/update/pid/{pid}', 'ImageController@update');
        Route::get('/delete/pid/{pid}', 'ImageController@delete');
    });
});

Route::group([
    'prefix'    => 'img'
],function (){
    Route::get('/pid/{pid}', 'ImageController@getImageByPid');
    Route::get('/groupid/{group_id}', 'ImageController@getImageByGroupId');
    Route::get('/allgid', 'ImageController@getAllGroupId');
});