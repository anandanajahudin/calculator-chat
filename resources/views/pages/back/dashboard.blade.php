@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @elseif($message = Session::get('error'))
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @else
        <div class="alert alert-success">
            You are logged in!
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Calculator Chat</h5>
            @include('layouts.components.back.tools')
            <form action="{{ route('calculator.store') }}" method="POST">
                @csrf
                <div class="input-group">
                    <input type="text" class="form-control" name="chat" id="chat" required placeholder="Enter Queries" aria-label="Queries">
                    <a href="javascript:showhide('uniquename')" id="button" type="button"  class="btn btn-warning" >
                    <i class="fa-solid fa-keyboard"></i></a>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>

            </form>
        </div>
    </div>
@endsection
