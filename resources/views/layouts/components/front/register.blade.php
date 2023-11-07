@extends('layouts.front')

@section('title', 'Register')

@section('content')
    <section class="site-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 mb-5">
                    <form action="{{ route('signup') }}" method="POST" class="p-5 bg-white">
                        @csrf
                        <h2 class="h4 mb-5">Register</h2>

                        <div class="row form-group">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label class="text-black" for="fname">First Name</label>
                                <input type="text" name="fname" id="fname" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="text-black" for="lname">Last Name</label>
                                <input type="text" name="lname" id="lname" class="form-control" required>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class="text-black" for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class="text-black" for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <input type="submit" value="Sign Up" class="btn btn-primary btn-md text-white">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
