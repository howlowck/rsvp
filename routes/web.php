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
    $guest = \App\Guest::find(1);
     $data = [
        'logoImageUrl' => asset('imgs/email-logo.png'),
        'headerColor' => 'white',
        'title' => '',
        'mainBodyColor' => '#fefefe',
        'mainMessage' => '',
        'heroPictureUrl' => asset('imgs/hero-picture.jpg'),
        'heroPictureAltText' => 'hao and mia',
        'ctaTitle' => "Hello $guest->nickname!",
        'ctaMessage' => 'We are so excited to invite you to our wedding! <br><br> Before we can send out the invitation, we would like to make sure that we have your most up-dated address.  Please follow the link below to fill out your information.',
        'actionUrl' => url('form?code=' . $guest->addressee_code),
        'actionText' => 'Fill out the Form'];
    return view('layouts.heroEmail', $data);
});

Route::get('login', 'AuthController@login');

Route::post('submit-auth', 'AuthController@attempt');

Route::get('logout', 'AuthController@logout');

Route::get('import/guests', 'ImportController@guests');

Route::post('import/upload-guests', 'ImportController@uploadGuests');

Route::resource('guests', 'GuestController');

Route::resource('invitations', 'InvitationController');

Route::get('form', 'GuestController@addresseeForm');
Route::post('form', 'GuestController@postAddresseeForm');