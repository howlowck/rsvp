@extends('layouts.app')

@section('content')
    <h2>Edit Guest: {{$guest->nickname}}</h2>
    <form action="/guests/{{$guest->id}}" method="post">
        {{ method_field('put') }}
        {{ csrf_field() }}
        {{-- <label for="nickname">nickname</label>
        <input type="text" id="nickname" name="nickname" value="{{$guest->nickname}}"/>
        <br> --}}
        <label for="first_name">first_name</label>
        <input type="text" id="first_name" name="first_name" value="{{$guest->first_name}}"/>
        <br>
        <label for="last_name">last_name</label>
        <input type="text" id="last_name" name="last_name" value="{{$guest->last_name}}"/>
        <br>
        <label for="email">email</label>
        <input type="text" id="email" name="email" value="{{$guest->email}}"/>
        <br>
        <label for="phone">phone</label>
        <input type="text" id="phone" name="phone" value="{{$guest->phone}}"/>
        <br>
        <input type="submit" value="Save">
    </form>
@endsection