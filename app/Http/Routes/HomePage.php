<?php
/**
 * Created by PhpStorm.
 * User: elatis
 * Date: 2018/10/6
 * Time: 17:10
 */

Route::group([
    'prefix'    => 'homepage'
],function (){
    Route::post('update', 'HomePageController@update')->middleware(['auth', 'admin']);
    Route::get('get', 'HomePageController@get');
});