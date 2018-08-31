<?php
/**
 * Created by PhpStorm.
 * User: elati
 * Date: 2018/8/29
 * Time: 16:27
 */

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware'    => 'token'
    ], function () {
        Route::group([
            'prefix'        => 'admin',
            'middleware'    => 'admin'
        ],function (){
            Route::post('/write/{type}', 'ContentController@writeNewContent');
            Route::post('/update', 'ContentController@updateContent');
        });
});

Route::group([
    'prefix'    => 'content'
],function (){
    Route::get('/cid/{cid}', 'ContentController@getContentByCid');
    Route::get('/type/{type}', 'ContentController@getContentByType');
});
