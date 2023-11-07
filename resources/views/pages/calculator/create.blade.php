@extends('layouts.main')

@section('title', 'Calculator Add')

@section('content')

    <h4>Calculator Chat</h4>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('calculator.store') }}" method="POST">
                @csrf
                {{-- <div class="row">
                    <div class="col-md-5 mb-3">
                        <input type="text" class="form-control" name="num1" id="num1" min="0" placeholder="0"
                            min="0" value="{{ old('num1') }}" required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <select class="form-select" name="operation" id="operation" required>
                            <option selected disabled>Select operator</option>
                            @foreach ($operations as $operation)
                                <option value="{{ $operation->id }}">
                                    <b>{{ $operation->operator }}</b>
                                    {{ $operation->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5 mb-3">
                        <input type="text" class="form-control" name="num2" id="num2" placeholder="0"
                            min="0" value="{{ old('num2') }}" required>
                    </div>
                </div> --}}
                <div class="mb-3">
                    <input type="text" class="form-control" name="chat" id="chat" placeholder="Send a message"
                        required>
                    {{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
