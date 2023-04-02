@extends('web.layouts.default')

@section('title', 'Login')

@section('content')
    <!-- Banner Area -->
    <section id="common_banner_one">
        <div class="container ">
            <div class="row">
                <div class="col-lg-12">
                    <div class="common_banner_text">
                        <h2>Login</h2>
                        <ul>
                            <li><a href="{{route('home')}}">Home</a></li>
                            <li><i class="fas fa-slash"></i></li>
                            <li class="active">Login</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Login-Area -->
    <section id="login_area" class="ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-12 col-sm-12 col-12">
                    <div class="account_form">
                        <h3>Login</h3>
                        @error('account')
                        <div class="alert alert-danger mt-4">
                            {{ $message }}
                        </div>
                        @enderror
                        <form method="POST" action="{{ route('login.submit') }}">
                            @csrf
                            <div class="default-form-box">
                                <label for="email">Email <span>*</span></label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" required autofocus>
                                @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                @enderror  
                            </div>
                            <div class="default-form-box">
                                <label for="password">Password <span>*</span></label>
                                <input type="password" class="form-control" name="password" id="password" required>
                                @error('password')
                                        <p class="text-danger">{{ $message }}</p>
                                @enderror  
                            </div>
                            <div class="remember_area pt-0">
                                <label class="checkbox-default">
                                    <input type="checkbox" name="remember" id="remember">
                                    <span>Remember me</span>
                                </label>
                            </div>
                            <div class="login_submit my-3">
                                <button class="theme-btn-one btn-black-overlay btn_md" type="submit">login</button>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="{{route('forgot-password')}}">Forgot password?</a>
                                <a href="{{route('register')}}">Create Your Account?</a>
                            </div>                   
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection