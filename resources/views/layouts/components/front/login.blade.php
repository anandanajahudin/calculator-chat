@extends('layouts.front')

@section('title', 'Login')

@section('content')
    <section class="site-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 mb-5">

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            {{ $message }}
                        </div>
                    @endif

                    <form action="{{ route('signIn') }}" method="POST" class="p-5 bg-white">
                        @csrf

                        <h2 class="h4 mb-5">Login</h2>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class="text-black" for="email">Email</label>
                                <input type="email" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror" required>
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class="text-black" for="password">Password</label>
                                <input type="password" name="password" id="password"
                                    class="form-control @error('password') is-invalid @enderror" required>
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <input type="submit" value="Sign In" class="btn btn-primary btn-md text-white">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <a href="{{ route('register') }}">I don't have account</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
