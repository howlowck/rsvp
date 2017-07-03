@extends('layouts.app')

@section('content')
    @foreach($songs as $song)
        <ul class="song">
            <li> {{$song}} </li>
        </ul>
    @endforeach
@endsection