@extends('layouts.app')

@section('content')
    <h2>Invitations</h2>
    <div class="summary">
      <p>Total Guests Confirmed: {{$totalGuestsComing}}</p>
    </div>
    <table class="table">
      <thead>
        {{-- <th>ID</th> --}}
        {{-- <th>Honorific</th> --}}
        {{-- <th>First Name</th> --}}
        {{-- <th>Last Name</th> --}}
        <th>Name</th>
        {{-- <th>Last Name</th> --}}
        {{-- <th>Email</th> --}}
        <th>Notes</th>
        <th>Email</th>
        <th>Viewed</th>
        <th>Coming</th>
        <th>Actions</th>
      </thead>
      <tbody>
        @foreach($guests as $guest)
        <tr>
            {{-- <td class='id'>{{$guest->id}}</td>  --}}
            {{-- <td class="Honorific">{{$guest->honorific}}</td> --}}
            {{-- <td class="first-name">{{$guest->first_name}}</td> --}}
            <td class="name">{{$guest->first_name}}
            @if ($guest->first_name !== $guest->nickname)
            ({{$guest->nickname}})
            @endif
            &nbsp;{{$guest->last_name}}
            </td>
            {{-- <td class="last-name"></td> --}}
            {{-- <td class="email">{{$guest->email}}</td> --}}
            <td class="notes">{{$guest->invitation->notes}}</td>
            
            <td class="email">
               {{$guest->email}}<br>
               @if ( ! $guest->invitation->invitation_sent)
               <form action="invitations/send-email" method="post">
                 {{csrf_field()}}
                 <input name="guest" value="{{$guest->id}}" type="hidden" />
                 <button class="btn btn-primary" type="submit">Send Invitation Email</button>
               </form>
               @else
               Invitation Sent
               @endif
            </td>
            <td class="invitation-viewed">
                @if($guest->invitation->invitation_viewed)
                    <i class="fa fa-check-circle" style="color: green;"></i>
                @endif
            </td>
            <td class="coming">
                @if($guest->invitation->will_come)
                    <i class="fa fa-check-circle" style="color: green;"></i>
                @elseif(is_null($guest->invitation->will_come))
                    
                @else
                    <i class="fa fa-times-circle" style="color: red;"></i>
                @endif
            </td>
            <td>
                <a href="/invitations/{{$guest->invitation->id}}" class="btn btn-success"><i class="fa fa-eye" style="color: white"></a>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
@endsection