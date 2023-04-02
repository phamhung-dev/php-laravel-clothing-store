@extends('web.layouts.default')

@section('title', 'Checkout')

@section('content')
    <!-- Banner Area -->
    <section id="common_banner_one">
        <div class="container ">
            <div class="row">
                <div class="col-lg-12">
                    <div class="common_banner_text">
                        <h2>Checkout</h2>
                        <ul>
                            <li><a href="{{route('home')}}">Home</a></li>
                            <li><i class="fas fa-slash"></i></li>
                            <li class="active">Checkout</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Checkout-Area -->
    <section id="checkout_one" class="ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                    <form method="post" action="{{route('user.my-cart.checkout')}}">
                        @csrf
                        <div class="order_review box-shadow bg-white">
                            <div class="check-heading">
                                <h3>Billings Information</h3>
                            </div>
                            <div class="check-out-form">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="first_name">First name <span>*</span></label>
                                            <input type="text" class="form-control" value="{{ $user->first_name }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="last_name">Last name <span>*</span></label>
                                            <input type="text" class="form-control" value="{{ $user->last_name }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="email">Email <span>*</span></label>
                                            <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="telephone">Telephone <span>*</span></label>
                                            <input type="text" class="form-control" value="{{ $user->telephone }}" id="telephone" name="telephone" required>
                                            @error('telephone')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror  
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="apartment_number">Apartment number <span>*</span></label>
                                            <input type="text" class="form-control" value="{{ $user->apartment_number }}" id="apartment_number" name="apartment_number" required>
                                            @error('apartment_number')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror  
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="street">Street <span>*</span></label>
                                            <input type="text" class="form-control" value="{{ $user->street }}" id="street" name="street" required>
                                            @error('street')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror  
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="ward">Ward <span>*</span></label>
                                            <input type="text" class="form-control" value="{{ $user->ward }}" id="ward" name="ward" required>
                                            @error('ward')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror  
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="district">District <span>*</span></label>
                                            <input type="text" class="form-control" value="{{ $user->district }}" id="district" name="district" required>
                                            @error('district')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror  
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="city">City <span>*</span></label>
                                            <input type="text" class="form-control" value="{{ $user->city }}" id="city" name="city" required>
                                            @error('city')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror  
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="note">Additional Notes</label>
                                            <textarea rows="5" class="form-control" id="note" name="note" placeholder="Order notes"></textarea>
                                            @error('note')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror 
                                        </div>
                                    </div>
                                    <input id="coupon_id" name="coupon_id" type="text" value="" hidden />        
                                </div>
                            </div>
                        </div>
                        <div class="order_review bg-white">
                            <div class="check-heading">
                                <h3>Payment</h3>
                            </div>
                            <div class="payment_method">
                                <div class="payment_option">
                                    <select name="payment_id" class="customs_sel_box" style="width: 300px; background-position-x: 250px;">
                                        @foreach($payments as $payment)
                                            <option value="{{ $payment->id }}">{{ $payment->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="mt-4">
                                        There are many variations of passages of Lorem Ipsum available, but the
                                        majority
                                        have suffered alteration.
                                    </p>
                                </div>
                            </div> <button type="submit"
                                class="theme-btn-one btn-black-overlay btn_sm">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="order_review  box-shadow bg-white">
                        <div class="check-heading">
                            <h3>Your Orders</h3>
                        </div>
                        <div class="table-responsive order_table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cartItems as $item)
                                        <tr>
                                            <td>{{ $item->productInventory()->first()->product()->first()->name }} - {{ $item->productInventory()->first()->size }} - {{ $item->productInventory()->first()->color }}<span class="product-qty"> x {{ $item->quantity }}</span>
                                            </td>
                                            <td>@money($item->price())</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>SubTotal</th>
                                        <td id="subtotal" class="product-subtotal">@money($subtotal)</td>
                                    </tr>
                                    <tr>
                                        <th>Shipping</th>
                                        <td>Free Shipping</td>
                                    </tr>
                                    <tr>
                                        <th>Discount</th>
                                        <td id="discount" class="product-subtotal">@money($subtotal - $total)</td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td id="total" class="product-subtotal">@money($total)</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        @error('cart_items')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror 
                    </div>
                    <div class="checkout-area-bg bg-white">
                        <div class="check-heading">
                            <h3>Coupon</h3>
                        </div>
                        <div class="check-out-form">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="coupon" id="coupon" placeholder="Your Coupon">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <button onclick="applyCoupon()" class="theme-btn-one btn-black-overlay btn_sm">Apply</button>
                                    </div>
                                </div>
                            </div>
                            <div id="couponMessage">
                                @error('coupon_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer_optional')
<script>
    function applyCoupon(){
        $.ajax({
            url: '/user/my-cart/apply-coupon',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                name: $('#coupon').val()
            },
            dataType: 'json',
            success: function(response) {
                const formatter = new Intl.NumberFormat('en-US', {
                        style: 'currency',
                        currency: 'USD'
                });
                if(response.status == 200){
                    $('#couponMessage').html(`<p class="text-success">${response.message}</p>`);
                }
                else{
                    $('#couponMessage').html(`<p class="text-danger">${response.message}</p>`);
                }
                $('#coupon_id').val(response.data.coupon_id);
                $('#subtotal').html(formatter.format(response.data.subtotal));
                $('#discount').html(formatter.format(response.data.discount));
                $('#total').html(formatter.format(response.data.total));
            }
        });
    }
</script>
@endsection