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
        'logoImageUrl' => asset('imgs/email-logo.jpg'),
        'headerColor' => '#262E30',
        'title' => '',
        'mainBodyColor' => '#262E30',
        'mainMessage' => '',
        'heroPictureUrl' => asset('imgs/invitation.jpg'),
        'heroPictureAltText' => 'hao and mia',
        'ctaTitle' => "Hello $guest->honorific $guest->first_name $guest->last_name,",
        'ctaTextColor' => '#F7ECB4',
        'ctaMessage' => "We are so excited to invite you to our wedding on July 8th at Prairie Productions! Please let us know if you can make it by following your personalized link below.",
        'actionUrl' => 'http://localhost:1313/#rsvp?code=' . $guest->addressee_code,
        'actionText' => 'RSVP Now',
        'actionBackgroundColor' => '#F7ECB4',
        'actionTextColor' => '#262E30',
        'postMessage' => '<br> Here are the details for the wedding again: <br><br> July 8, 2017 at 4pm <br> Prairie Productions 1314 W Randolph St. Chicago, IL'];
    return view('layouts.heroEmail', $data);
});

Route::get('login', 'AuthController@login')->name('login');

Route::post('submit-auth', 'AuthController@attempt');

Route::get('logout', 'AuthController@logout');

Route::get('import/guests', 'ImportController@guests')->middleware('auth');

Route::post('import/upload-guests', 'ImportController@uploadGuests')->middleware('auth');

Route::resource('guests', 'GuestController');

Route::resource('invitations', 'InvitationController');

Route::post('invitations/send-email', 'InvitationController@sendEmail')->middleware('auth');

Route::get('form', 'GuestController@addresseeForm');
Route::post('form', 'GuestController@postAddresseeForm');