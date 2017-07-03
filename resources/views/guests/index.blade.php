@extends('layouts.app')

@section('content')
    <h2>Guests who are coming</h2>
    @foreach($invitations as $invitation)
      <div class="invitation" style="margin: 10px; padding: 10px; border: solid 1px black; display: inline-block;">
        @foreach($invitation->guests as $guest)
          <div class="guest">{{$guest->first_name}} {{$guest->last_name}}</div>
        @endforeach
      </div> 
    @endforeach
@endsection