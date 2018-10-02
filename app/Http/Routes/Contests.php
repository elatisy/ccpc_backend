<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'contest'
], function (){
    Route::get('cid/{cid}', 'ContestController@getContestByCid');
    Route::get('getcids', 'ContestController@getCids');
    Route::get('year/{year}', 'ContestController@getCidsByYear');

    Route::group([
        'middleware'    => ['admin', 'auth']
    ],function (){
        Route::post('/update/{cid}', 'ContestController@updateContest');
        Route::post('/write', 'ContestController@writeContest');
    });
});
