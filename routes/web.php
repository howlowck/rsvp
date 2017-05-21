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

// Route::get('test', function () {
//     $guest = \App\Guest::find(1);
//      $data = [
//         'logoImageUrl' => asset('imgs/email-logo.jpg'),
//         'logoImageAltText' => 'Our Families Would Like to Invite You to...',
//         'headerColor' => '#262E30',
//         'title' => '',
//         'mainBodyColor' => '#262E30',
//         'mainMessage' => '',
//         'heroPictureUrl' => asset('imgs/invitation.jpg'),
//         'heroPictureAltText' => 'Come Join Us For The Wedding of Mia and Hao - July 8th 2017 at 4PM - Prairie Productions 1314 W Randolph St Chicago IL - Dinner and Dancing to Follow',
//         'ctaTitle' => "Hello $guest->honorific $guest->first_name $guest->last_name,",
//         'ctaTextColor' => '#F7ECB4',
//         'ctaMessage' => "We are so excited to invite you to our wedding on July 8th at Prairie Productions! Please let us know if you can make it by following your personalized link below.",
//         'actionUrl' => 'http://localhost:1313/#rsvp?code=' . $guest->addressee_code,
//         'actionText' => 'RSVP Now',
//         'actionBackgroundColor' => '#F7ECB4',
//         'actionTextColor' => '#262E30',
//         'postMessage' => "<br> Your invite code is <code>$guest->addressee_code</code> (but it should populate automatically when you click the button)<br><br> Feel free to check out our website for more information: <a styles='color: #F7ECB4 !important;' href='https://haoandmia.com'><strong style='font-weight:normal;'>haoandmia.com</strong></a>"];
//     return view('layouts.heroEmail', $data);
// });

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