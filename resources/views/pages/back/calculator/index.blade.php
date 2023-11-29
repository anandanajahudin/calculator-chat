@extends('layouts.main')

@section('title', 'Calculator')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible mb-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Calculator Chat</h5>
            <form action="{{ route('calculator.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="text" class="form-control" name="chat" id="chat" placeholder="Send a message"
                        required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            <hr>

            {{-- <form action="{{ route('generatePlotEquation') }}" method="GET"> --}}
            {{-- <form action="{{ route('generatePlot') }}" method="POST">
                @csrf
                <label for="equation">Equation:</label>
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="equation" id="equation" required>
                        <input type="text" class="form-control" name="xVal" id="xVal" required>
                        <input type="text" class="form-control" name="yVal" id="yVal" required>
                    </div>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-success">Generate Plot</button>
                </div>
            </form> --}}

            {{-- <hr />
            <a href="{{ route('generateGraph') }}" class="btn btn-success">Run Python</a>

            <hr />
            <a href="{{ url('/generate-plot/2.0/0.5') }}" class="btn btn-secondary">Generate Plot</a> --}}
        </div>
    </div>
@endsection
