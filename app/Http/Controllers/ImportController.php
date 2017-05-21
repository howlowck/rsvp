<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Csv\Reader;
use App\Guest;
use Illuminate\Support\Facades\Log;

class ImportController extends Controller
{
    public function guests() {
        return view('import/guests');
    }

    public function uploadGuests(Request $req) {
        $path = $req->file('guests')->path();
        $reader = Reader::createFromPath($path);
        $keys = ['nickname', 'honorific', 'first_name', 'last_name', 'email', 'guests'];
        $iterator = $reader->fetchAssoc(0);
        foreach ($iterator as $row) {
            if ($row['first_name'] == '') {
                continue;
            }
            $guest = new Guest();
            $guest->nickname = trim($row['nickname']);
            $guest->honorific = trim($row['honorific']);
            $guest->first_name = trim($row['first_name']);
            $guest->last_name = trim($row['last_name']);
            $guest->email = trim($row['email']);
            $guest->addressee_code = uniqid_real();
            $guest->addressee_viewed = false;
            try{
                $guest->save();
            } catch (\Exception $e) {
                $guest->addressee_code = uniqid_real();
                $guest->save();
                Log::error($e->getMessage());
            }

            $invitation = new \App\Invitation();
            $invitation->invite_code = $guest->addressee_code;
            $invitation->total_guests = $row['guests'];
            $invitation->save();
            $guest->invitation()->associate($invitation);
            $guest->save();
        }
        return redirect('/invitations');
    }
}
