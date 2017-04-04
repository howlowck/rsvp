<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function guests() {
        return view('import/guests');
    }

    public function uploadGuests() {

    }
}
