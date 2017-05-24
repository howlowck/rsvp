@extends('layouts.app')

@section('content')
    <h2>Edit Invitation</h2>
    <form action="/invitations/{{$invitation->id}}" method="post">
        {{ method_field('put') }}
        {{ csrf_field() }}
        <label for="total_guests">total_guests</label>
        <input type="text" id="total_guests" name="total_guests" value="{{$invitation->total_guests}}"/>
        <br>
        <label for="invitation_sent">invitation_sent</label>
        <input type="text" id="invitation_sent" name="invitation_sent" value="{{$invitation->invitation_sent}}"/>
        <br>
        <input type="submit" value="Save">
    </form>

@endsection