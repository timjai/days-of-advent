@extends('default', ['title' => 'Days of Advent'])

@section('content')
    <p><a href="/">Home</a></p>
    <h1>{{ $title }}</h1>
    <div class="row">
        <div class="col-6">
            @yield('quest')
        </div>
        <div class="col-6">
            @yield('forms')
        </div>
    </div>
@endsection
