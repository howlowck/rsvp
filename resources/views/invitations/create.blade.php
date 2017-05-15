@extends('layouts.app')

@section('content')
    <h2>Invitation for {{$guest->nickname}}</h2>
    <form action="/invitations" method="post">
        {{csrf_field()}}
        <label for="address_street">Street</label>
        <input type="text" id="address_street" name="address_street" placeholder="123 Random st.">
        <br>
        <label for="address_city">City, State</label>
        <input type="text" id="address_city" name="address_city" placeholder="Chicago, IL">
        <br>
        <label for="address_zipcode">Zipcode</label>
        <input type="text" id="address_zipcode" name="address_zipcode">
    </form>
@endsection