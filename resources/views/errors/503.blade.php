@extends('errors.layout')
@section('title')
    503
@endsection
@section('title-error')
    {{ __("Server Error") }}
@endsection
@section('description')
    {{ __('Looks like the service is unavailable!') }}
@endsection
