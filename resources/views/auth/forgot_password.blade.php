@extends('web.layouts.default')

@section('title', 'Forgot Password')

@section('content')
    <!-- Banner Area -->
    <section id="common_banner_one">
        <div class="container ">
            <div class="row">
                <div class="col-lg-12">
                    <div class="common_banner_text">
                        <h2>Forgot Password</h2>
                        <ul>
                            <li><a href="{{route('home')}}">Home</a></li>
                            <li><i class="fas fa-slash"></i></li>
                            <li class="active">Forgot Password</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Forgot-Password-Area -->
    <section id="forgot_password" class="ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="order_tracking_wrapper">
                        <h4>Forgot Password</h4>
                        <p>To re-issue a new password please enter your email in the box below and press the "Submit"
                            button.
                        </p>
                        @if(session('success'))
                            <div class="alert alert-success mt-4">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{route('forgot-password.submit')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control"
                                    placeholder="Enter your email address" required>
                                    @error('email')
                                        <p class="mt-4 text-danger">{{ $message }}</p>
                                    @enderror  
                            </div>
                            <div class="order_track_button">
                                <button type="submit" class="theme-btn-one btn-black-overlay btn_md">Submit</button>
                            </div>
                        </form>
                        <div class="text-end">
                            <a href="{{route('login')}}" class="text-decoration-none"><i class="fa fa-arrow-left"></i> Back to login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection