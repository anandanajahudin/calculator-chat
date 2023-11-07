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
                <div class="col-lg-9">{{ $calculator->chat }}</div>
            </div>
            <div class="row">
                <div class="col-lg-3">The result is : </div>
                <div class="col-lg-9">
                    <p>Try the following commands!</p>
                    <ul>
                        <li>
                            <b>About</b> – Shows you what the service is about and what the company does
                        </li>
                        <li>
                            <b>Solve</b> – Input a math equation to solve for right after it and watch what happens!
                        </li>
                        <li>
                            <b>Graph</b> – Output a graph of a function
                        </li>
                        <li>
                            <b>Exit</b> – Logs you out
                        </li>
                        <li>
                            <b>Library</b> – Shows you what you can do
                        </li>
                        <li>
                            <b>Profile</b> – Shows your profile information
                        </li>
                        <li>
                            <b>History</b> – Shows the calculations you did
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
