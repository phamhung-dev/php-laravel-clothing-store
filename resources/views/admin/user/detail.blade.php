@extends('admin.layouts.default')

@section('title', 'User list')

@section('header_optional')
<!-- No Extra plugin used -->
<link href="{{asset('admin/plugins/data-tables/datatables.bootstrap5.min.css')}}" rel="stylesheet">
<link href="{{asset('admin/plugins/data-tables/responsive.datatables.min.css')}}" rel="stylesheet">
@endsection

@section('content')
<!-- CONTENT WRAPPER -->
<div class="ec-content-wrapper" layout:fragment="content">
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>Customer profile</h1>
                <p class="breadcrumbs"><span><a href="admin/">Home</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>Profile
                </p>
            </div>
        </div>
        <div class="user_profile_wrapper_top card">
            <div class="user_profile_top_bg"></div>
            <div class="user_profile_top_des">
                <div class="user_profile_img">
                    @if($user->avatar != null)
                    <img src="data:image/png;base64, {{$user->avatar}}" alt="">
                    @else
                    <img src="{{asset('web/img/common/avatar.png')}}" alt="">
                    @endif
                </div>
                <div class="user_profile_text_top">
                    <h3>{{$user->first_name.' '. $user->last_name}}</h3>
                    <p>
                        {{$user->apartment_number.', '.$user->street.', '.$user->ward.', '.$user->district.', '.$user->city}}
                    </p>
                </div>
            </div>

        </div>
        <div class="card bg-white profile-content">
            <div class="row">
                <div class="col-lg-4 col-xl-3">
                    <div class="profile-content-left profile-left-spacing">
                        <div class="product_card_bottom_wrapper">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card_bottom_items">
                                        <div class="card_bottom_item_icon">
                                            <img src="https://andit.co/projects/html/andshop/andshop-dashboard/assets/img/icons/shoping.png" alt="">
                                        </div>
                                        <div class="card_bottom_item_text">
                                            <p>Purchased</p>
                                            <h3>{{$totalPurchased}}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="card_bottom_items">
                                        <div class="card_bottom_item_icon">
                                            <img src="https://andit.co/projects/html/andshop/andshop-dashboard/assets/img/icons/cart.png" alt="">
                                        </div>
                                        <div class="card_bottom_item_text">
                                            <p>In order</p>
                                            <h3>{{$totalInOrder}}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="card_bottom_items">
                                        <div class="card_bottom_item_icon">
                                            <img src="https://andit.co/projects/html/andshop/andshop-dashboard/assets/img/icons/doller.png" alt="">
                                        </div>
                                        <div class="card_bottom_item_text">
                                            <p>Amount</p>
                                            <h3>{{$totalMoney}}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="w-100">

                        <div class="contact-info pt-4">
                            <h5 class="text-dark">Contact Information</h5>
                            <div class="contact_info_sidebar_item">
                                <h3>Address</h3>
                                <p>
                                    {{$user->apartment_number.', '.$user->street.', '.$user->ward.', '.$user->district.', '.$user->city}}
                                </p>
                            </div>

                            <div class="contact_info_sidebar_item">
                                <h3>Email</h3>
                                <p> {{$user->email}}</p>
                            </div>
                            <div class="contact_info_sidebar_item">
                                <h3>Phone number</h3>
                                <p>{{$user->telephone}}</p>
                            </div>

                            <div class="contact_info_sidebar_item">
                                <h3>Social Profile</h3>

                                <ul>
                                    <li>
                                        <a href="#" class="mb-1 btn btn-outline btn-twitter rounded-circle">
                                            <i class="mdi mdi-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="mb-1 btn btn-outline btn-linkedin rounded-circle">
                                            <i class="mdi mdi-linkedin"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="mb-1 btn btn-outline btn-facebook rounded-circle">
                                            <i class="mdi mdi-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="mb-1 btn btn-outline btn-skype rounded-circle">
                                            <i class="mdi mdi-skype"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>


                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-xl-9">
                    <div class="profile-content-right profile-right-spacing py-5">
                        <ul class="nav nav-tabs px-3 px-xl-5 nav-style-border" id="myProfileTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="purchased-tab" data-bs-toggle="tab" data-bs-target="#purchased" type="button" role="tab" aria-controls="purchased" aria-selected="true">Purchased</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="orders-tab" data-bs-toggle="tab" data-bs-target="#r-orders" type="button" role="tab" aria-controls="orders" aria-selected="false">Recent orders</button>
                            </li>
                        </ul>
                        <div class="tab-content px-3 px-xl-5" id="myTabContent">

                            <div class="tab-pane fade show active" id="purchased" role="tabpanel" aria-labelledby="purchased-tab">
                                <div class="tab-widget mt-5">
                                    <div class="user_profile_top_heading">
                                        <h3>All purchased products</h3>
                                    </div>

                                    <div class="row">
                                        @foreach ($orderItems as $orderItem)
                                        <div class="col-lg-3 col-md-6 col-sm-6">
                                            <div class="card-wrapper">
                                                <div class="card-container">
                                                    <div class="card-top">
                                                        <img class="card-image" src="data:image/png;base64, {{$orderItem->ProductInventory->Product->image}}" alt="">
                                                    </div>
                                                    <div class="card-bottom">
                                                        <h3><a href="product-detail.html" > {{ $orderItem->ProductInventory->Product->name.' - '.$orderItem->ProductInventory->size.' - '.$orderItem->ProductInventory->color }} </a></h3>
                                                        <p>@money($orderItem->ProductInventory->Product->sell_price * (1 - $orderItem->ProductInventory->Product->discount_percent /
                                                            100.0)) <del>@money($orderItem->ProductInventory->Product->sell_price)</del></p>
                                                    </div>
                                                    <div class="card-action">
                                                        <div class="card-edit"><i class="mdi mdi-circle-edit-outline"></i>
                                                        </div>
                                                        <div class="card-preview"><i class="mdi mdi-eye-outline"></i>
                                                        </div>
                                                        <div class="card-remove"><i class="mdi mdi mdi-delete-outline"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="r-orders" role="tabpanel" aria-labelledby="orders-tab">
                                <div class="tab-widget mt-5">
                                    <div class="user_profile_top_heading">
                                        <h3>Recent orders</h3>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card card-default">
                                                <div class="card-body">
                                                    <div>
                                                        <table id="responsive-data-table" class="table" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>ID</th>
                                                                    <th>Name</th>
                                                                    <th>Total</th>
                                                                    <th>Payment</th>
                                                                    <th>Telephone</th>
                                                                    <th>Order date</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                @foreach ($orderDetails as $orderDetail)
                                                                <tr class="odd">
                                                                    <td class="sorting_1" th:text="${orderDetail.id}">{{$orderDetail->id}}</td>
                                                                    <td>
                                                                        {{$orderDetail->User->first_name.' '.$orderDetail->User->last_name}}
                                                                    </td>
                                                                    <td>
                                                                        @money($orderDetail->total)
                                                                    </td>
                                                                    <td>
                                                                        {{$orderDetail->Payment->name}}
                                                                    </td>
                                                                    <td>
                                                                        {{$orderDetail->telephone}}
                                                                    </td>
                                                                    <td>
                                                                        {{$orderDetail->created_at}}
                                                                    </td>
                                                                    @if($orderDetail->status == 0)
                                                                    <td>Pending</td>
                                                                    @elseif($orderDetail->status == 1)
                                                                    <td>Shipped</td>
                                                                    @else
                                                                    <td>Delivered</td>
                                                                    @endif
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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