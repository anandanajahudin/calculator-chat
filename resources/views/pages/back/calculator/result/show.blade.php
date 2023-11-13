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
                @php
                    $operator = $calculator->operator;
                    $first_number = $calculator->first_number;
                    $last_number = $calculator->last_number;
                    $result = $calculator->result;
                @endphp

                <div class="col-lg-3">The solve about this math is : </div>
                <div class="col-lg-9">
                    <p>

                        @if ($operator != '*' && $operator != '/' && $operator != '+' && $operator != '-' && $operator != '%')
                            @if ($operator == '!')
                                {{ $first_number . '' . $operator . ' = ' . $result }}
                            @elseif ($operator == null)
                                @if ($first_number != null && $last_number != null)
                                    x = {{ $first_number }} | y = {{ $last_number }}
                                @elseif ($first_number != null)
                                    x = {{ $result }}
                                @else
                                    y = {{ $result }}
                                @endif
                            @else
                                {{ $operator . '(' . $first_number . ')' . ' = ' . $result }}
                            @endif
                        @else
                            {{ $first_number . ' ' . $operator . ' ' . $last_number . ' = ' . $result }}
                        @endif
                    </p>
                </div>

                <div class="col-lg-12">
                    <p><b>result = {{ $result }}</b></p>
                </div>

                @if ($operator == null)
                    <div class="col-lg-12">
                        @if ($first_number != null && $last_number == null)
                            <canvas id="myChart2"></canvas>
                        @elseif ($first_number == null && $last_number != null)
                            <canvas id="myChart3"></canvas>
                        @else
                            <canvas id="myChart1"></canvas>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>

    <script type="text/javascript">
        var x = new Chart(document.getElementById("myChart1"), {
            type: 'scatter',
            data: {
                datasets: [{
                    label: "Test",
                    data: [{
                            x: 0,
                            y: 0
                        },
                        {
                            x: {{ $first_number }},
                            y: {{ $last_number }}
                        }
                    ],
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>

    {{-- Persamaan linier 1 variabel x --}}
    <script type="text/javascript">
        var grafik = new Chart(document.getElementById("myChart2"), {
            type: 'scatter',
            data: {
                datasets: [{
                    label: "Test",
                    data: [{
                            x: {{ $first_number }},
                            y: 0
                        },
                        {
                            x: {{ $first_number }},
                            y: 1
                        }
                    ],
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>

    {{-- Persamaan linier 1 variabel y --}}
    <script type="text/javascript">
        var grafik = new Chart(document.getElementById("myChart3"), {
            type: 'scatter',
            data: {
                datasets: [{
                    label: "Test",
                    data: [{
                            x: 0,
                            y: {{ $last_number }}
                        },
                        {
                            x: 1,
                            y: {{ $last_number }}
                        }
                    ],
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
@endpush
