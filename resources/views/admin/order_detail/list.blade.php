@extends('admin.layouts.default')

@section('title', 'Order list')

@section('header_optional')
<!-- No Extra plugin used -->
<link href="{{asset('admin/plugins/data-tables/datatables.bootstrap5.min.css')}}" rel="stylesheet">
<link href="{{asset('admin/plugins/data-tables/responsive.datatables.min.css')}}" rel="stylesheet">
@endsection

@section('content')
<!-- CONTENT WRAPPER -->
<div class="ec-content-wrapper">
    <div class="content">
        <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
            <div>
                <h1>All order</h1>
                <p class="breadcrumbs"><span><a href="index.html">Home</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>Order Details
                </p>
            </div>
            <div>
                <a href="/admin/coupon/add" class="btn btn-primary"> Add new</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-body">
                        <div class="">
                            <div id="responsive-data-table_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">

                                <table id="responsive-data-table" class="table dataTable no-footer" style="width:100%" aria-describedby="responsive-data-table_info">
                                    <thead>
                                        <tr>
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="responsive-data-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="ID: activate to sort column descending" style="width: 39.6875px;">ID</th>
                                            <th class="sorting" tabindex="0" aria-controls="responsive-data-table" rowspan="1" colspan="1" aria-label="User name: activate to sort column ascending" style="width: 180.0977px;">User name</th>
                                            <th class="sorting" tabindex="0" aria-controls="responsive-data-table" rowspan="1" colspan="1" aria-label="Total: activate to sort column ascending" style="width: 99.062px;">Total</th>
                                            <th class="sorting" tabindex="0" aria-controls="responsive-data-table" rowspan="1" colspan="1" aria-label="Coupon: activate to sort column ascending" style="width: 118.672px;">Coupon</th>
                                            <th class="sorting" tabindex="0" aria-controls="responsive-data-table" rowspan="1" colspan="1" aria-label="Payment: activate to sort column ascending" style="width: 118.672px;">Payment</th>
                                            <th class="sorting" tabindex="0" aria-controls="responsive-data-table" rowspan="1" colspan="1" aria-label="Telephone: activate to sort column ascending" style="width: 118.672px;">Telephone</th>
                                            <th class="sorting" tabindex="0" aria-controls="responsive-data-table" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 118.672px;">Status</th>
                                            <th class="sorting" tabindex="0" aria-controls="responsive-data-table" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 107.109px;">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($orderDetails as $orderDetail)
                                        <tr class="odd">
                                            <td class="sorting_1">{{$orderDetail->id}}</td>
                                            <td>{{$orderDetail->User->first_name.' '.$orderDetail->User->last_name}}</td>
                                            <td>${{number_format($orderDetail->total)}}</td>
                                            <td>{{$orderDetail->Coupon->discount_percent}}%</td>
                                            <td>{{$orderDetail->Payment->name}}</td>
                                            <td>{{$orderDetail->telephone}}</td>
                                            <td>
                                                @if($orderDetail->status == 0)
                                                <span class="badge badge-danger">Canceled</span>
                                                @elseif($orderDetail->status == 1)
                                                <span class="badge badge-warning">Shipping</span>
                                                @else
                                                <span class="badge badge-success">Completed</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group mb-1">
                                                    <a href="#" class="btn btn-outline-success">Info</a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Content -->
</div> <!-- End Content Wrapper -->

@section('footer_optional')
<!-- Datatables -->
<script src="{{asset('admin/plugins/data-tables/jquery.datatables.min.js')}}"></script>
<script th:src="{{asset('admin/plugins/data-tables/datatables.bootstrap5.min.js')}}"></script>
<script th:src="{{asset('admin/plugins/data-tables/datatables.responsive.min.js')}}"></script>
<!-- Option Switcher -->
<script th:src="{{asset('admin/plugins/options-sidebar/optionswitcher.js')}}"></script>
@endsection


@endsection