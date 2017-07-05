<?php

use Illuminate\Http\Request;
use App\Invitation;
use App\Guest;

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

    return response()->json(['result' => [
        'addressee' => [
            'honorific' => $addressee->honorific,
            'first_name' => $addressee->first_name,
            'last_name' => $addressee->last_name,
            'phone' => $addressee->phone,
        ],
        'invitation' => $invitation->toArray()
    ]]);
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

    $addressee->phone = $request->get('phone');
    $addressee->save();

    if ($invitation->confirmed) {
        $plusOnes = $guests->filter(function ($guest) {
            return ! $guest->addressee_code;
        });

        $plusOnes->each(function ($plusOne) {
            $plusOne->delete();
        });
    }

    if ($request->has('guests')) {
         foreach($request->get('guests') as $newGuestInfo) {
            $newGuest = new Guest();
            $newGuest->first_name = $newGuestInfo['first_name'];
            $newGuest->last_name = $newGuestInfo['last_name'];
            $newGuest->invitation()->associate($invitation);
            $newGuest->save();
        }
    }
   
    $invitation->confirmed = true;
    
    if ($request->get('attending') === 'will-attend') {
        $invitation->will_come = true;
        $invitation->cannot_come = false;
    } else {
        $invitation->will_come = false;
        $invitation->cannot_come = true;
    }

    $invitation->favorite_song = $request->get('songs');
    $invitation->notes = $request->get('notes');

    $invitation->save();
    return response()->json(["result" => 'processed']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/assign', function (Request $request) {
    if ($request->query('table') and $request->query('invitation')) {
        $tableId = $request->query('table');
        $invitationId = $request->query('invitation');
        $table = \App\Table::find($tableId);
        $invitation = \App\Invitation::find($invitationId);
        $invitation->table()->associate($table);
        $invitation->save();
        return ['result' => 'good'];
    }
    return ["result" => 'did nothing'];
});
