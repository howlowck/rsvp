<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guest;

class GuestController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guests = Guest::with('invitation')->get();
        return view('guests.index', compact('guests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addresseeForm(Request $request)
    {
        $addresseeCode = $request->query('code');
        if (is_null($addresseeCode)) {
            return 'There is no code';
        }
        $guest = \App\Guest::where('addressee_code', $addresseeCode)->first();
        if (is_null($guest)) {
            return 'There is no guest with that code';
        }
        
        // create invite if not created already
        return view('guests.addressee', compact(['guest']));
    }

    public function postAddresseeForm(Request $request)
    {
        $addresseeCode = $request->get('addressee_code');

        if (is_null($addresseeCode)) {
            return 'There is no code';
        }

        $guest = \App\Guest::where('addressee_code', $addresseeCode)->first();

        if (is_null($guest)) {
            return 'There is no guest with that code';
        }

        $invitation = $guest->invitation;
        $invitationFields = ['address_street', 'address_city', 'address_zipcode'];

        if (is_null($invitation)) {
            $invitation = new \App\Invitation();
            $invitation->invite_code = $guest->addressee_code;
            foreach($invitationFields as $field) {
                $invitation->$field = $request->get($field);
            }
            $invitation->save();
            $guest->invitation()->associate($invitation);
            return view('guests.thank_you');
        }
        
        $invitation->save();

    }
}

