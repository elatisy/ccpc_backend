<?php
/**
 * Created by PhpStorm.
 * User: elatis
 * Date: 2018/10/6
 * Time: 16:53
 */
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'    => 'announcement'
],function (){

    Route::get('aid/{aid}', 'AnnouncementController@get');
    Route::get('all', 'AnnouncementController@getAll');

    Route::group([
        'middleware'    => ['auth', 'admin']
    ], function (){
        Route::post('write', 'AnnouncementController@write');
        Route::post('update/{aid}', 'AnnouncementController@update');
        Route::get('delete/{aid}', 'AnnouncementController@delete');
    });
});