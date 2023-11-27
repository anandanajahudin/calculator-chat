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


                @if (
                    $calculator->chat == 'graph log x' ||
                        $calculator->chat == 'graph log y' ||
                        $calculator->chat == 'graph sin x' ||
                        $calculator->chat == 'graph sin y' ||
                        $calculator->chat == 'graph cos x' ||
                        $calculator->chat == 'graph cos y')
                @else
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
                                @elseif ($operator == 'probability')
                                    <b>n(A)</b> = {{ $first_number }} <br>
                                    <b>n(S)</b> = {{ $last_number }}
                                @else
                                    {{ $operator . '(' . $first_number . ')' . ' = ' . $result }}
                                @endif
                            @else
                                {{ $first_number . ' ' . $operator . ' ' . $last_number . ' = ' . $result }}
                            @endif
                        </p>
                    </div>
                @endif

                <div class="col-lg-12">
                    <p><b>result = {{ $result }}</b></p>
                </div>

                @if ($operator == null)
                    <div class="col-lg-12">
                        @if ($calculator->chat == 'graph log x')
                            <canvas id="myChart5"></canvas>
                        @elseif ($calculator->chat == 'graph log y')
                            <canvas id="myChart6"></canvas>
                        @elseif ($calculator->chat == 'graph sin x')
                            <canvas id="myChart7"></canvas>
                        @elseif ($calculator->chat == 'graph cos x')
                            <canvas id="myChart8"></canvas>
                        @else
                            @if ($first_number != null && $last_number == null)
                                <canvas id="myChart2"></canvas>
                            @elseif ($first_number == null && $last_number != null)
                                <canvas id="myChart3"></canvas>
                            @elseif ($first_number != null && $last_number != null && $result == null)
                                <canvas id="myChart4"></canvas>
                            @else
                                <canvas id="myChart1"></canvas>
                            @endif
                        @endif

                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/libs/Chart.js/2.6.0/Chart.min.js') }}"></script>

    <script type="text/javascript">
        var x = new Chart(document.getElementById("myChart1"), {
            type: 'scatter',
            data: {
                datasets: [{
                    label: "Graph",
                    fill: false,
                    pointRadius: 1,
                    borderColor: "rgba(255,0,0,0.5)",
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
                    label: "Graph",
                    fill: false,
                    pointRadius: 1,
                    borderColor: "rgba(255,0,0,0.5)",
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
                    label: "Graph",
                    fill: false,
                    pointRadius: 1,
                    borderColor: "rgba(255,0,0,0.5)",
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

    {{-- Persamaan linear 2 variabel x dan y, contoh: 2x + 3y = 7 --}}
    <script type="text/javascript">
        var x = new Chart(document.getElementById("myChart4"), {
            type: 'scatter',
            data: {
                datasets: [{
                    label: "Graph",
                    fill: false,
                    pointRadius: 1,
                    borderColor: "rgba(255,0,0,0.5)",
                    data: [{
                            x: 0,
                            y: {{ $last_number }}
                        },
                        {
                            x: {{ $first_number }},
                            y: 0
                        }
                    ],
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>

    {{-- Grafik log x --}}
    <script type="text/javascript">
        var x = new Chart(document.getElementById("myChart5"), {
            type: 'scatter',
            data: {
                datasets: [{
                    label: "Graph",
                    fill: false,
                    pointRadius: 1,
                    borderColor: "rgba(255,0,0,0.5)",
                    data: [{
                            x: 1,
                            y: 0
                        },
                        {
                            x: 2,
                            y: 0.301
                        },
                        {
                            x: 10,
                            y: 1
                        },
                    ],
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>

    {{-- Grafik log y --}}
    <script type="text/javascript">
        var x = new Chart(document.getElementById("myChart6"), {
            type: 'scatter',
            data: {
                datasets: [{
                    label: "Graph",
                    fill: false,
                    pointRadius: 1,
                    borderColor: "rgba(255,0,0,0.5)",
                    data: [{
                            x: 1,
                            y: 10
                        },
                        {
                            x: 2,
                            y: 100
                        },
                        {
                            x: 3,
                            y: 1000
                        },
                    ],
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>

    {{-- Grafik sin x --}}
    <script type="text/javascript">
        var x = new Chart(document.getElementById("myChart7"), {
            type: 'scatter',
            data: {
                datasets: [{
                    label: "Graph",
                    fill: false,
                    pointRadius: 1,
                    borderColor: "rgba(255,0,0,0.5)",
                    data: [{
                            x: 0,
                            y: 0
                        },
                        {
                            x: {{ pi() / 2 }},
                            y: 1
                        },
                        {
                            x: {{ pi() }},
                            y: 0
                        },
                        {
                            x: {{ (3 * pi()) / 2 }},
                            y: -1
                        },
                        {
                            x: {{ 2 * pi() }},
                            y: 0
                        },
                    ],
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>

    {{-- Grafik cos x --}}
    <script type="text/javascript">
        var x = new Chart(document.getElementById("myChart8"), {
            type: 'scatter',
            data: {
                datasets: [{
                    label: "Graph",
                    fill: false,
                    pointRadius: 1,
                    borderColor: "rgba(255,0,0,0.5)",
                    data: [{
                            x: 0,
                            y: 1
                        },
                        {
                            x: {{ pi() / 2 }},
                            y: 0
                        },
                        {
                            x: {{ pi() }},
                            y: -1
                        },
                        {
                            x: {{ (3 * pi()) / 2 }},
                            y: 0
                        },
                        {
                            x: {{ 2 * pi() }},
                            y: 1
                        },
                    ],
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>

    <script type="text/javascript">
        // const xValues = [];
        // const yValues = [];
        // generateData("x * 2 + 7", 0, 10, 0.5);

        // new Chart("myChart", {
        //     type: "line",
        //     data: {
        //         labels: xValues,
        //         datasets: [{
        //             fill: false,
        //             pointRadius: 1,
        //             borderColor: "rgba(255,0,0,0.5)",
        //             data: yValues
        //         }]
        //     },
        //     options: {
        //         legend: {
        //             display: false
        //         },
        //         title: {
        //             display: true,
        //             text: "y = x * 2 + 7",
        //             fontSize: 16
        //         }
        //     }
        // });

        // function generateData(value, i1, i2, step = 1) {
        //     for (let x = i1; x <= i2; x += step) {
        //         yValues.push(eval(value));
        //         xValues.push(x);
        //     }
        // }
    </script>
@endpush
