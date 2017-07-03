@extends('layouts.app')

@section('content')
    @foreach($invitations as $invitation)
        @if ( !! $invitation->favorite_song)
        <ul class="song">
            <?php $addressee = $invitation->getAddressee(); ?>
            <li> {{$invitation->favorite_song}} - {{$addressee->first_name}} {{$addressee->last_name}} </li>
        </ul>
        @endif
    @endforeach
@endsection