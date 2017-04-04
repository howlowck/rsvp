@extends('layouts.app')

@section('content')
  @if (\Auth::check())
    <p>Hello {{ \Auth::user()->name }}</p>
    <a class="btn btn-secondary" href="/logout" role="button" >Logout</a>
  @else
    <p>Not logged in</p>
    <a class="btn btn-secondary" href="/login" role="button" >Login</a>

  @endif
  
@endsection