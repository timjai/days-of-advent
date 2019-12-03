@extends('default', ['title' => 'Days of Advent'])

@section('content')
    <h1 class="text-center">
        Days of Advent
    </h1>
    <br>
    <div class="links">
        <div class="row">
            @for($i = 1; $i < 26; $i++)
                <div class="col-3">
                    <a href="{{ route('day', $i) }}">Day {{ $i }}</a>
                </div>
            @endfor
        </div>
    </div>
@endsection
