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
        $keys = ['nickname', 'honorific', 'first_name', 'last_name', 'email'];
        $iterator = $reader->fetchAssoc(0);
        foreach ($iterator as $row) {
            $guest = new Guest();
            $guest->nickname = $row['nickname'];
            $guest->honorific = $row['honorific'];
            $guest->first_name = $row['first_name'];
            $guest->last_name = $row['last_name'];
            $guest->email = $row['email'];
            $guest->addressee_code = uniqid_real();
            $guest->addressee_viewed = false;
            try{
                $guest->save();
            } catch (\Exception $e) {
                $guest->addressee_code = uniqid_real();
                $guest->save();
                Log::error($e->getMessage());
            }
        }
        return redirect('/guests');
    }
}
