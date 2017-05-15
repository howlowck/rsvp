@extends('layouts.app')

@section('content')
    <h2>Mailing Address for {{$guest->nickname}}</h2>
    <form action="/form" method="post">
        {{csrf_field()}}
        <h5>Your Info</h3>
        <label for="phone">Phone</label>
        <br>
        <input type="text" id="phone" name="phone">
        <br>
        <br>
        <h5>Your Address</h3>
        <label for="address_street">Street</label>
        <br>
        <input type="text" id="address_street" name="address_street" placeholder="">
        <br>
        <label for="address_city">City, State</label>
        <br>
        <input type="text" id="address_city" name="address_city" placeholder="City, IL">
        <br>
        <label for="address_zipcode">Zipcode</label>
        <br>
        <input type="text" id="address_zipcode" name="address_zipcode">
        <br>
        <br>
        <label for="addressee_notes">Comments</label>
        <br>
        <textarea cols="40" rows="8" id="addressee_notes" name="addressee_notes"></textarea>
        <br>
        <br>
        <input class="btn btn-primary" type="submit" value="submit">
    </form>
@endsection