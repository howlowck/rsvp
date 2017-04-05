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

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function () {
     $data = [
        'logoImageUrl' => '',
        'headerColor' => 'red',
        'title' => '',
        'mainBodyColor' => 'green',
        'mainMessage' => '',
        'heroPictureUrl' => '',
        'heroPictureAltText' => '',
        'actionText' => '',
        'ctaTitle' => '',
        'ctaMessage' => '',
        'actionUrl' => '',
        'actionText' => ''];
    return view('layouts.heroEmail', $data);
});

Route::get('login', 'AuthController@login');

Route::post('submit-auth', 'AuthController@attempt');

Route::get('logout', 'AuthController@logout');

Route::get('import/guests', 'ImportController@guests');

Route::post('import/upload-guests', 'ImportController@uploadGuests');