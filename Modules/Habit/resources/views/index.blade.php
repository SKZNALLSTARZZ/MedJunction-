@extends('habit::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('habit.name') !!}</p>
@endsection
