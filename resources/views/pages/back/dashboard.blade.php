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
            <form action="{{ route('calculator.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="text" class="form-control" name="chat" id="chat" placeholder="Send a message"
                        required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            <canvas id="myChart"></canvas>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/libs/Chart.js/2.6.0/Chart.min.js') }}"></script>

    <script type="text/javascript">
        const xValues = [];
        const yValues = [];
        generateData("x * 2 + 7", 0, 10, 0.5);

        new Chart("myChart", {
            type: "line",
            data: {
                labels: xValues,
                datasets: [{
                    fill: false,
                    pointRadius: 1,
                    borderColor: "rgba(255,0,0,0.5)",
                    data: yValues
                }]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: "y = x * 2 + 7",
                    fontSize: 16
                }
            }
        });

        function generateData(value, i1, i2, step = 1) {
            for (let x = i1; x <= i2; x += step) {
                yValues.push(eval(value));
                xValues.push(x);
            }
        }
    </script>
@endpush
