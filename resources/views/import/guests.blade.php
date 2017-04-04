@extends('layouts.app')

@section('content')
    <file-upload name="guests" action-route="/import/upload-guests" />
@endsection