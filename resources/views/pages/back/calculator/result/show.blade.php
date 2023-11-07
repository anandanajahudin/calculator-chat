@extends('layouts.main')

@section('title', 'Calculator Add')

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
        </div>
    </div>

    <h4>Result</h4>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3">Your command line is : </div>
                <div class="col-lg-9">
                    <p>{{ $calculator->chat }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">The solve about this math is : </div>
                <div class="col-lg-9">
                    <p>
                        @php
                            $operator = $calculator->operator;
                            $first_number = $calculator->first_number;
                            $last_number = $calculator->last_number;
                            $result = $calculator->result;
                        @endphp

                        @if ($operator != '*' && $operator != '/' && $operator != '+' && $operator != '-' && $operator != '%')
                            @if ($operator == '!')
                                {{ $first_number . '' . $operator . ' = ' . $result }}
                            @else
                                {{ $operator . '(' . $first_number . ')' . ' = ' . $result }}
                            @endif
                        @else
                            {{ $first_number . ' ' . $operator . ' ' . $last_number . ' = ' . $result }}
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
