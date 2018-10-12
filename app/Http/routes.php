<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Route;

include 'Routes/Contests.php';
include 'Routes/User.php';
include 'Routes/News.php';
include 'Routes/Announcement.php';
include 'Routes/HomePage.php';


Route::get('/', function () {
    return 'QAQ';
});
