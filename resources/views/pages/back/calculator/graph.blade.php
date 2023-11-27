@extends('layouts.main')

@section('title', 'Calculator')
@push('scripts')
<script src="{{ asset('assets/js/calculator.js') }}"></script>
    <script>
        var elt = document.getElementById('calculator');
        var calculator = Desmos.GraphingCalculator(elt);
      </script>
@endpush
@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible mb-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div id="calculator" style="width: 1000px; height: 700px;"></div>

@endsection
