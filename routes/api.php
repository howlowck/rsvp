<?php

use Illuminate\Http\Request;
use App\Invitation;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/invitations/guest', function (Request $request) {
    $invitation = Invitation::where('invite_code', $request->get('code'))->first();
    if ( is_null($invitation)) {
        return response()->json(["result" => null]);
    }

    $guests = $invitation->guests;
    $addressee = $guests->filter(function ($guest) {
        return !! $guest->addressee_code;
    })->first();

    $invitation->invitation_viewed = true;
    $invitation->save();

    return response()->json([
        'addressee' => [
            'honorific' => $addressee->honorific,
            'first_name' => $addressee->first_name,
            'last_name' => $addressee->last_name
        ],
        'invitation' => $invitation->toArray()
    ]);
    // return json({result: })
});

Route::post('/invitations/rsvp', function (Request $request) {
    $invitation = Invitation::where('invite_code', $request->get('code'))->first();
    if ( is_null($invitation)) {
        return response()->json(["result" => null]);
    }

    $guests = $invitation->guests;
    $addressee = $guests->filter(function ($guest) {
        return !! $guest->addressee_code;
    })->first();

    $invitation->invitation_viewed = true;
    $invitation->save();

    return response()->json([
        'addressee' => [
            'honorific' => $addressee->honorific,
            'first_name' => $addressee->first_name,
            'last_name' => $addressee->last_name
        ],
        'invitation' => $invitation->toArray()
    ]);
    // return json({result: })
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

