@extends('layouts.main')

@section('title', 'Calculator')
@push('scripts')
    <script type="text/javascript">
        var id = $('#a span').text();
        if (id.length > 0) {
            alert(id[0].value);
        }
    </script>
@endpush
@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible mb-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('sigma.store') }}" method="POST">
                @csrf
                <h5 class="card-title fw-semibold mb-4">Sigma Calculator</h5>
                <hr>
                <div class="js"></div>
        </div>

        <script src="{{ asset('assets/js/sigma.js') }}"></script>
        <input type="text" hidden class="form-control" name="hasil" id="hasil" required>

        <div class="mt-3">
            <button type="submit" class="btn btn-success">Save Sigma</button>
        </div>
        </form>
    </div>
@endsection
