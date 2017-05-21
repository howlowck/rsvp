<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Invitation;


class InvitationController extends Controller
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
        $guests = \App\Guest::whereNotNull('addressee_code')->with('invitation')->get();
        return view('invitations.index', compact('guests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $guestId = $request->query('guest');
        $guest = \App\Guest::find($guestId);

        if ( is_null($guest) ) {
            return redirect()->back();
        }
        
        if ( $guest->invitation ) {
            return redirect()->back()->withError([]);
        }

        return view('invitations.create', compact('guest'));
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

    public function sendEmail(Request $request)
    {
        $guestId = $request->get('guest');
        $guest = \App\Guest::find($guestId);
        $invitation = $guest->invitation;

        Mail::to($guest->email)->send(new Invitation($guest));

        $invitation->invitation_sent = true;
        $invitation->save();
        return redirect('/invitations');
    }
}
