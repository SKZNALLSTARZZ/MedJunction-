@extends('patient::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('patient.name') !!}</p>
@endsection
