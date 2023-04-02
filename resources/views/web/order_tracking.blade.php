@extends('web.layouts.default')

@section('title', 'Order Tracking')

@section('content')
    <!-- Banner Area -->
    <section id="common_banner_one">
        <div class="container ">
            <div class="row">
                <div class="col-lg-12">
                    <div class="common_banner_text">
                        <h2>Order Tracking</h2>
                        <ul>
                            <li><a href="{{route('home')}}">Home</a></li>
                            <li><i class="fas fa-slash"></i></li>
                            <li class="active">Order Tracking</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Order-Tracking-Area -->
    <section id="order_tracking" class="ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="order_tracking_wrapper">
                        <h4>Order Tracking</h4>
                        <p>To track your order please enter your Order ID in the box below and press the "Track" button.
                        </p>
                        @error('error')
                            <div class="alert alert-danger mt-4">
                                {{ $message }}
                            </div>
                        @enderror
                        <form action="{{route('order-tracking.order-detail')}}" method="GET">
                            @csrf
                            <div class="form-group">
                                <label for="id">Order ID</label>
                                <input type="text" id="order_id" name="order_id" class="form-control" placeholder="Found in your order" required>
                                @error('order_id')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror  
                            </div>
                            <div class="form-group">
                                <label for="email">Billing Email</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email address" required>
                                @error('email')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror  
                            </div>
                            <div class="order_track_button">
                                <button type="submit" class="theme-btn-one btn-black-overlay btn_md">Track</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection