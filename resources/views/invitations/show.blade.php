@extends('layouts.app')

@section('content')
    <h2>Invitation</h2>

    <h3>Total Guests Allowed</h3>
    <p>{{$invitation->total_guests}}</p>

    <h3>Confirmed</h3>
    @if($invitation->invitation_viewed)
        <i class="fa fa-check-circle" style="color: green;"></i>
    @endif

    <h3>Coming</h3>
    @if($invitation->will_come)
        <i class="fa fa-check-circle" style="color: green;"></i>
    @elseif(is_null($guest->invitation->will_come))
        
    @else
        <i class="fa fa-times-circle" style="color: red;"></i>
    @endif

    
    @if ($invitation->notes)
    <h3>Notes</h3>
    <p>{{$invitation->notes}}</p>
    @endif

    <h3>Guests</h3>
    <ul>
    @foreach($invitation->guests as $guest)
    <li>{{$guest->first_name}} {{$guest->last_name}} ({{$guest->email}})</li>
    @endforeach
    </ul>

@endsection