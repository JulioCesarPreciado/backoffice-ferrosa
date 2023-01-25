@extends('errors.layout')
@section('title')
    429
@endsection
@section('title-error')
    {{ __("Too Many Requests") }}
@endsection
@section('description')
    {{ __('Looks like your did too many requests!') }}
@endsection
