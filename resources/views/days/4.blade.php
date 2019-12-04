@extends('day', ['day' => 4, 'title' => 'Day 4:'])

@section('quest')
    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Part 1
                    </button>
                </h2>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    <article class="day-desc"></article>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Part 2
                    </button>
                </h2>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                    <article class="day-desc"></article>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('forms')
    <div class="form-group">
        <p>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#part1default" aria-expanded="false" aria-controls="part1default">
                Default Input
            </button>
        </p>
        <div class="collapse" id="part1default">
            <div class="card card-body">
                {{ $part1 }}
            </div>
        </div>
        <form method="POST">
            @csrf
            <div class="form-group">
                <label for="">Custom Json Input</label>
                <textarea class="form-control" name="customInput" id="" rows="3" placeholder="Replace default input with a custom one here">{{ $customInput }}</textarea>
            </div>

            <div class="form-group">
                <input class="btn btn-primary" type="submit" value="Calculate">
            </div>

            @if (!empty($result1))
                <p>Result Part 1: {{ $result1 }}</p>
            @endif

            @if (!empty($result2))
                <p>Result Part 2: {{ $result2 }}</p>
            @endif

            @if (!empty($failure))
                <div class="alert alert-danger" role="alert">
                    {{ $failure }}
                </div>
            @endif
        </form>
    </div>
@endsection
