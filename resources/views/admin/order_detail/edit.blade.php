@extends('admin.layouts.default')

@section('title', 'Order info')

@section('header_optional')
<!-- No Extra plugin used -->
<link href="{{asset('admin/plugins/data-tables/datatables.bootstrap5.min.css')}}" rel="stylesheet">
<link href="{{asset('admin/plugins/data-tables/responsive.datatables.min.css')}}" rel="stylesheet">
@endsection

@section('content')

<!-- CONTENT WRAPPER -->
<div class="ec-content-wrapper">
    <div class="content">
        <div class="breadcrumb-wrapper">
            <div>
                <h1>Order details</h1>
                <p class="breadcrumbs"><span><a href="index.html">Home</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>Order info
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="ec-odr-dtl card card-default">
                    <div class="card-header card-header-border-bottom d-flex justify-content-between">
                        <h2 class="ec-odr">Order info</h2>
                    </div>
                    <div class="card-body">
                        @if (session('error'))
                        <div class="alert alert-danger text-center">{{ session('error') }}</div>
                        @endif
                        <div class="row">
                            <div class="col-xl-3 col-lg-6">
                                <address class="info-grid">
                                    <div class="info-content">
                                        <h5 class="title_infos"> <span class="mdi mdi-account-circle">
                                            </span>
                                            Customer info</h5>
                                        <ul>
                                            <li>Name: {{ $orderDetail->user->first_name.' '.$orderDetail->user->last_name}}<span>
                                                </span></li>
                                            <li>Email: <span>{{$orderDetail->User->email}}</span> </li>
                                            <li>Phone: <span>{{$orderDetail->User->telephone}} </span></li>
                                        </ul>
                                        <a href="">View
                                            profile</a>
                                    </div>
                                </address>
                            </div>
                            <div class="col-xl-3 col-lg-6">
                                <address class="info-grid">
                                    <div class="info-content">
                                        <h5 class="title_infos"> <span class="mdi mdi-ship-wheel"></span>
                                            Shipping info</h5>
                                        <ul>
                                            <li>Name: <span>
                                                    {{ $orderDetail->user->first_name.' '.$orderDetail->user->last_name}}
                                                </span></li>
                                            <li>Address: <span>
                                                    {{$orderDetail->ship_address()}}
                                                </span> </li>
                                            <li>Phone: <span></span>{{$orderDetail->telephone}}</li>
                                        </ul>
                                    </div>
                                </address>
                            </div>
                            <div class="col-xl-3 col-lg-6">
                                <address class="info-grid">
                                    <div class="info-content">
                                        <h5 class="title_infos"> <span class="mdi mdi-ship-wheel"></span>
                                            Status</h5>
                                        @if($orderDetail->status == 1)
                                        <form method="post" action="/admin/order-detail/update-status">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$orderDetail->id}}" />
                                            <select name="status" class="form-select">
                                                <option value="1" checked>Shipping</option>
                                                <option value="2">Completed</option>
                                                <option value="0">Cancel</option>
                                            </select>
                                            <div class="col-md-12 mt-3">
                                                <div class="product_add_cancel_button">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                        @elseif($orderDetail->status == 2)
                                        <span class="badge badge-success">Completed</span>
                                        @else
                                        <span class="badge badge-secondary">Canceled</span>
                                        @endif
                                    </div>
                                </address>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ec-odr-dtl card card-default mt-5">
                    <div class="card-header card-header-border-bottom d-flex justify-content-between">
                        <h2 class="ec-odr">Product summary</h2>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped o-tbl">
                                        <thead>
                                            <tr class="line">
                                                <td><strong>ID</strong></td>
                                                <td><strong>Photo</strong></td>
                                                <td><strong>Product name</strong></td>
                                                <td><strong>Unit</strong></td>
                                                <td><strong>Price</strong></td>
                                                <td><strong>Sub total</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orderItems as $orderItem)
                                            <tr>
                                                <td></td>
                                                <td><img class="product-img" src="data:image/png;base64, {{$orderItem->ProductInventory->Product->image}}" alt="img"></td>
                                                <td>
                                                    {{ $orderItem->ProductInventory->Product->name.' - '.$orderItem->ProductInventory->size.' - '.$orderItem->ProductInventory->color }}
                                                </td>
                                                <td>{{ $orderItem->quantity }}</td>
                                                <td>@money($orderItem->price )</td>
                                                <td>
                                                    @money($orderItem->quantity * $orderItem->price * (1 - $orderItem->discount_percent / 100.0))
                                                </td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="4">
                                                </td>
                                                <td class="text-right"><strong>Total:</strong></td>
                                                <td class="text-right"><strong>@money( $orderDetail->subtotal )</strong></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">
                                                </td>
                                                <td class="text-right"><strong>Discount:</strong></td>
                                                <td class="text-right">
                                                    @if($orderDetail->coupon_id == null)
                                                    <strong>0</strong>
                                                    @else
                                                    <strong>
                                                        {{$orderDetail->subtotal * $orderDetail->Coupon->discount_percent/100.0}} %
                                                    </strong>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">
                                                </td>
                                                <td class="text-right"><strong>Grand total:</strong></td>
                                                <td class="text-right"><strong>@money($orderDetail->total)</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tracking Detail -->
                <div class="card ec-odr-dtl card card-default mt-4 trk-order">
                    <div class="card-header card-header-border-bottom order_tracking_title">
                        <h3>Order tracking id: <span>#JK54736OM</span></h3>
                    </div>
                    <div class="d-flex flex-wrap flex-sm-nowrap justify-content-between py-3 px-2 bg-custom">
                        <div class="order_details_shipment w-100 py-1 px-2">
                            <h3>Shipped via: <span>DHL courier service int.</span></h3>
                        </div>
                        <div class="order_details_shipment w-100 py-1 px-2">
                            <h3>Status:
                                @if($orderDetail->status == 0)
                                <span>Canceled</span>
                                @elseif($orderDetail->status == 1)
                                <span>Shipping</span>
                                @else
                                <span>Completed</span>
                                @endif
                            </h3>
                        </div>
                        <div class="order_details_shipment w-100 py-1 px-2">
                            <h3>Delivery date: <span>31 Mar 2022</span></h3>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($orderDetail->status == 0)
                        <div class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">
                            <div class="step completed">
                                <div class="step-icon-wrap">
                                    <div class="step-icon"><i class="mdi mdi-cart-plus"></i></div>
                                </div>
                                <h4 class="step-title">Canceled</h4>
                            </div>
                        </div>
                        @elseif($orderDetail->status == 1)
                        <div class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">
                            <div class="step completed">
                                <div class="step-icon-wrap">
                                    <div class="step-icon"><i class="mdi mdi-cart-plus"></i></div>
                                </div>
                                <h4 class="step-title">Confirmed Order</h4>
                            </div>
                            <div class="step">
                                <div class="step-icon-wrap">
                                    <div class="step-icon"><i class="mdi mdi-truck-fast"></i></div>
                                </div>
                                <h4 class="step-title">On Shipping</h4>
                            </div>
                        </div>
                        @else
                        <div class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">
                            <div class="step completed">
                                <div class="step-icon-wrap">
                                    <div class="step-icon"><i class="mdi mdi-cart-plus"></i></div>
                                </div>
                                <h4 class="step-title">Confirmed Order</h4>
                            </div>
                            <div class="step">
                                <div class="step-icon-wrap">
                                    <div class="step-icon"><i class="mdi mdi-truck-fast"></i></div>
                                </div>
                                <h4 class="step-title">On Delivery</h4>
                            </div>
                            <div class="step">
                                <div class="step-icon-wrap">
                                    <div class="step-icon"><i class="mdi mdi-shopping"></i></div>
                                </div>
                                <h4 class="step-title">Product Delivered</h4>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Content -->
</div> <!-- End Content Wrapper -->

@endsection


@section('footer_optional')
<!-- Datatables -->
<script src="{{asset('admin/plugins/data-tables/jquery.datatables.min.js')}}"></script>
<script src="{{asset('admin/plugins/data-tables/datatables.bootstrap5.min.js')}}"></script>
<script src="{{asset('admin/plugins/data-tables/datatables.responsive.min.js')}}"></script>
<!-- Option Switcher -->
<script src="{{asset('admin/plugins/options-sidebar/optionswitcher.js')}}"></script>
@endsection