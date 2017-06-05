@extends('layouts.app')

@section('content')
  @if (\Auth::check())
    <p>Hello {{ \Auth::user()->name }}</p>
    <a class="btn btn-primary" href="/import/guests" role="button" >Import CSV</a>
    <a class="btn btn-secondary" href="/logout" role="button" >Logout</a>
    <a class="btn btn-success" href="/invitations" role="button"> View Invitations </a>
  @else
    <p>Not logged in</p>
    <a class="btn btn-secondary" href="/login" role="button" >Login</a>

  @endif
  
@endsection