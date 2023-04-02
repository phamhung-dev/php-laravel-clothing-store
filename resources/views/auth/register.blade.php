@extends('web.layouts.default')

@section('title', 'Register')

@section('content')
    <!-- Banner Area -->
    <section id="common_banner_one">
        <div class="container ">
            <div class="row">
                <div class="col-lg-12">
                    <div class="common_banner_text">
                        <h2>Register</h2>
                        <ul>
                            <li><a href="{{route('home')}}">Home</a></li>
                            <li><i class="fas fa-slash"></i></li>
                            <li class="active">Register</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Register-Area -->
    <section id="register_area" class="ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 col-md-12 col-sm-12 col-12">
                    <div class="account_form">
                        <h3>Register</h3>
                        <form method="POST" action="{{route('register.submit')}}">
                            @csrf
                            <div class="row">
                                <div class="default-form-box col-lg-6">
                                    <label for="first_name">First name <span>*</span></label>
                                    <input type="text" class="form-control" value="{{ old('first_name') }}" id="first_name" name="first_name" required autofocus>
                                    @error('first_name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror                                   
                                </div>
                                <div class="default-form-box col-lg-6">
                                    <label for="last_name">Last name <span>*</span></label>
                                    <input type="text" class="form-control" value="{{ old('last_name') }}" id="last_name" name="last_name" required>
                                    @error('last_name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror  
                                </div>
                            </div>
                            <div class="default-form-box">
                                <label for="telephone">Telephone <span>*</span></label>
                                <input type="text" class="form-control" value="{{ old('telephone') }}" id="telephone" name="telephone" required>
                                @error('telephone')
                                        <p class="text-danger">{{ $message }}</p>
                                @enderror  
                            </div>
                            <div class="default-form-box">
                                <label for="apartmapartment_numberentNumber">Apartment number <span>*</span></label>
                                <input type="text" class="form-control" value="{{ old('apartment_number') }}" id="apartment_number" name="apartment_number" required>
                                @error('apartment_number')
                                        <p class="text-danger">{{ $message }}</p>
                                @enderror  
                            </div>
                            <div class="row">
                                <div class="default-form-box col-lg-6">
                                    <label for="street">Street <span>*</span></label>
                                    <input type="text" class="form-control" value="{{ old('street') }}" id="street" name="street" required>
                                    @error('street')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror  
                                </div>
                                <div class="default-form-box col-lg-6">
                                    <label for="ward">Ward <span>*</span></label>
                                    <input type="text" class="form-control" value="{{ old('ward') }}" id="ward" name="ward" required>
                                    @error('ward')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror  
                                </div>
                            </div>
                            <div class="row">
                                <div class="default-form-box col-lg-6">
                                    <label for="district">District <span>*</span></label>
                                    <input type="text" class="form-control" value="{{ old('district') }}" id="district" name="district" required>
                                    @error('district')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror  
                                </div>
                                <div class="default-form-box col-lg-6">
                                    <label for="city">City <span>*</span></label>
                                    <input type="text" class="form-control" value="{{ old('city') }}" id="city" name="city" required>
                                    @error('city')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror  
                                </div>
                            </div>
                            <div class="default-form-box">
                                <label for="email">Email <span>*</span></label>
                                <input type="email" class="form-control" value="{{ old('email') }}" id="email" name="email" required>
                                @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                @enderror  
                            </div>
                            <div class="row">
                                <div class="default-form-box col-lg-6">
                                    <label for="password">Password <span>*</span></label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    @error('password')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror  
                                </div>
                                <div class="default-form-box col-lg-6">
                                    <label for="retype_password">Retype password <span>*</span></label>
                                    <input type="password" class="form-control" id="retype_password" name="retype_password" required>
                                    @error('retype_password')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror  
                                </div>
                            </div>
                            <div class="remember_area">
                                <label class="checkbox-default">
                                    <input type="checkbox" @checked(old('receive_newsletter')) id="receive_newsletter" name="receive_newsletter">
                                    <span>Sign up for our newsletter</span>
                                </label>
                                @error('receive_newsletter')
                                        <p class="text-danger">{{ $message }}</p>
                                @enderror  
                            </div>
                            <div class="remember_area">
                                <label class="checkbox-default">
                                    <input type="checkbox" @checked(old('receive_offers')) id="receive_offers" name="receive_offers">
                                    <span>Receive offers from our partners</span>
                                </label>
                                @error('receive_offers')
                                        <p class="text-danger">{{ $message }}</p>
                                @enderror  
                            </div>
                            <div class="login_submit mb-4">
                                <button class="theme-btn-one btn-black-overlay btn_md" type="submit">register</button>
                            </div>
                            <div class="text-center">
                                Have an account? <a href="{{route('login')}}">Back to login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection