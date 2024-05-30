@extends('nurse::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('nurse.name') !!}</p>
@endsection
