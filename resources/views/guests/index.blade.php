@extends('layouts.app')

@section('content')
    <h2>Addressees</h2>
    <table class=".table">
      <thead>
        {{-- <th>ID</th> --}}
        {{-- <th>Honorific</th> --}}
        {{-- <th>First Name</th> --}}
        {{-- <th>Last Name</th> --}}
        <th>Nick Name</th>
        <th>Email</th>
        <th>Note</th>
        <th>Viewed</th>
        <th>Actions</th>
      </thead>
      <tbody>
        @foreach($guests as $guest)
        <tr>
            {{-- <td class='id'>{{$guest->id}}</td>  --}}
            {{-- <td class="Honorific">{{$guest->honorific}}</td> --}}
            {{-- <td class="first-name">{{$guest->first_name}}</td> --}}
            {{-- <td class="last-name">{{$guest->last_name}}</td> --}}
            <td class="nickname">{{$guest->nickname}}</td>
            <td class="email">{{$guest->email}}</td>
            <td class="note">{{$guest->addressee_notes}}</td>
            <td class="addressee-viewed">{{$guest->addressee_viewed}}</td>
            <td class="actions">
               <a href="{{'/invitations/create?guest=' . $guest->id}}">Create an Invitation</a>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
@endsection