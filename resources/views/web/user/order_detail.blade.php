@extends('web.layouts.default')

@section('title', 'Order Detail')

@section('header_optional')
    <!-- No Extra plugin used -->
    <link src="{{asset('admin/plugins/data-tables/datatables.bootstrap5.min.css')}}" rel="stylesheet">
    <link src="{{asset('admin/plugins/data-tables/responsive.datatables.min.css')}}" rel="stylesheet">
    <link id="style.css" href="{{asset('admin/css/style.css')}}" rel="stylesheet">
@endsection

@section('content')
    <!-- Banner Area -->
    <section id="common_banner_one">
        <div class="container ">
            <div class="row">
                <div class="col-lg-12">
                    <div class="common_banner_text">
                        <h2>Order Detail</h2>
                        <ul>
                            <li><a href="{{route('home')}}">Home</a></li>
                            <li><i class="fas fa-slash"></i></li>
                            <li><a href="{{route('user.my-account')}}">My Account</a></li>
                            <li><i class="fas fa-slash"></i></li>
                            <li class="active">Order Detail</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="order_detail" class="ptb-100">
        <div class="container">
            <div class="card card-default">
                    @if($errors->has('order_detail'))
                        <div class="card-body">
                            <h3 class="text-center text-danger">{{ $errors->first('order_detail') }}</h3>
                            <div class="row text-right mt-5">
                                <a href="{{ route('order-tracking') }}" class="theme-btn-one"><i class="fa fa-arrow-left"></i> Back to order tracking</a>
                            </div>
                        </div>
                    @else
                    <div class="card-body">
                        <h2 class="text-center mb-5">Order detail</h2>
                        <hr>
                        <div class="row">
                            <div class="col-6"><label>Ship address: <span class="text-muted">{{ $orderDetail->ship_address() }}</span></label></div>
                            <div class="col-6"><label>Telephone: <span class="text-muted">{{ $orderDetail->telephone }}</span></label></div>
                            <div class="col-6"><label>Subtotal: <span class="text-muted">@money($orderDetail->subtotal)</span></label></div>
                            <div class="col-6"><label>Order date: <span class="text-muted">{{ $orderDetail->created_at }}</span></label></div>
                            <div class="col-6"><label>Discount: <span class="text-muted">@money($orderDetail->discountTotal())</span></label></div>
                            <div class="col-6"><label>Payment: <span class="text-muted">{{ $orderDetail->payment()->first()->name }}</span></label></div>
                            <div class="col-6"><label>Total: <span class="text-muted">@money($orderDetail->total)</span></label></div>
                            <div class="col-6"><label>Status: <span class="text-muted">{{ $orderDetail->status() }}</span></label></div>
                            <div class="col-12"><label>Note: <span class="text-muted">{{ $orderDetail->note }}</span></label></div>
                        </div>
                        <hr>
                        <div>
                            <div id="responsive-data-table_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                <table id="responsive-data-table" class="table dataTable no-footer" style="width: 100%;"
                                    aria-describedby="responsive-data-table_info">
                                    <thead>
                                        <tr>
                                            <th class="sorting sorting_asc" tabindex="0"
                                                aria-controls="responsive-data-table" aria-sort="ascending"
                                                aria-label="Product: activate to sort column descending">Product
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="responsive-data-table"
                                                aria-label="Image: activate to sort column ascending">
                                                Image</th>
                                            <th class="sorting" tabindex="0" aria-controls="responsive-data-table"
                                                aria-label="Size: activate to sort column ascending">
                                                Size</th>
                                            <th class="sorting" tabindex="0" aria-controls="responsive-data-table"
                                                aria-label="Color: activate to sort column ascending">
                                                Color</th>
                                            <th class="sorting" tabindex="0" aria-controls="responsive-data-table"
                                                aria-label="Price: activate to sort column ascending">
                                                Price</th>
                                            <th class="sorting" tabindex="0" aria-controls="responsive-data-table"
                                                aria-label="Discount Percent: activate to sort column ascending">
                                                Discout Percent</th>
                                            <th class="sorting" tabindex="0" aria-controls="responsive-data-table"
                                                aria-label="Quantity: activate to sort column ascending">
                                                Quantity</th>
                                            <th class="sorting" tabindex="0" aria-controls="responsive-data-table"
                                                aria-label="Total: activate to sort column ascending">
                                                Total</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse($orderItems as $orderItem)
                                            <tr class="odd">
                                                <td class="sorting_1">{{$orderItem->productInventory()->first()->product()->first()->name}}</td>
                                                <td><img class="img-60" src="data:image/png;base64, {{ $orderItem->productInventory()->first()->product()->first()->image }}" alt=""></td>
                                                <td>{{ $orderItem->productInventory()->first()->size }}</td>
                                                <td>{{ $orderItem->productInventory()->first()->color }}</td>
                                                <td>@money($orderItem->price)</td>
                                                <td>{{ $orderItem->discount_percent }}</td>
                                                <td>{{ $orderItem->quantity }}</td>
                                                <td>@money($orderItem->discountPrice())</td>
                                            </tr>
                                        @empty
                                            <p class="text-center my-5">No products</p>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="row text-right mt-5">
                                    <a href="{{route('user.my-account')}}" class="theme-btn-one"><i class="fa fa-arrow-left"></i> Back to order tracking</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

@section('footer_optional')
    <!-- Datatables -->
    <script src="{{asset('admin/plugins/data-tables/jquery.datatables.min.js')}}"></script>
    <script src="{{asset('admin/plugins/data-tables/datatables.bootstrap5.min.js')}}"></script>
    <script src="{{asset('admin/plugins/data-tables/datatables.responsive.min.js')}}"></script>
    <script src="{{asset('admin/js/custom.js')}}"></script>
@endsection