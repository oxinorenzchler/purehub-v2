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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

//Index
Route::view('/','index');
//Home
Route::view('/home','auth.home');

###############
# AJAX Routes #
###############

//Add post
Route::post('/add_post','PostController@store')->name('add.post');

//Delete post
Route::delete('/delete_post', 'PostController@delete')->name('delete.post');