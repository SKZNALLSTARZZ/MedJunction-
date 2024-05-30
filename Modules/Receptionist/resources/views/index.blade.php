@extends('receptionist::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('receptionist.name') !!}</p>
@endsection
