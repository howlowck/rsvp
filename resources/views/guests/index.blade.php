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
               @if ( ! $guest->invitation->invitation_sent)
               <form action="invitations/send-email" method="post">
                 <input name="guest" value="{{$guest->id}}" type="hidden" />
                 <button class="btn btn-primary" type="submit">Send Invitation Email</button>
               </form>
               @else
               <p>Invite Sent</p>
               @endif
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
@endsection