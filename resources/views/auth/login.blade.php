@extends('layouts.app')

@section('content')
    <login-form action-route="/submit-auth" token="{{csrf_token()}}"></login-form>
@endsection