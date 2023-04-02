@extends('web.layouts.default')

@section('title', 'My Account')

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
                        <h2>My Account</h2>
                        <ul>
                            <li><a href="{{route('home')}}">Home</a></li>
                            <li><i class="fas fa-slash"></i></li>
                            <li class="active">My Account</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- My-account-area-Area -->
    <section id="my-account_area" class="ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-3">
                    <!-- Nav tabs -->
                    <div class="dashboard_tab_button">
                        <ul role="tablist" class="nav flex-column dashboard-list">
                            <li><a href="#!" data-bs-toggle="tab" data-bs-target="#dashboard"><i
                                        class="fas fa-tachometer-alt"></i>Dashboard</a></li>
                            <li> <a href="#!" data-bs-toggle="tab" data-bs-target="#orders"><i
                                        class="fas fa-cart-arrow-down"></i>Orders</a></li>
                            <li><a href="#!" data-bs-toggle="tab" data-bs-target="#account-details"><i
                                        class="fas fa-user"></i>Account
                                    details</a>
                            </li>
                            <li><a href="{{route('logout')}}" class=""><i class="fas fa-sign-out-alt"></i>logout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-9">
                    <!-- Tab panes -->
                    <div class="tab-content dashboard_content">
                        <div class="tab-pane fade show active" id="dashboard">
                            <div class="myaccount-content">
                                <h4 class="title">Dashboard </h4>
                                <p>From your account dashboard. you can easily check &amp; view your <a href="#">recent
                                        orders</a>, manage your <a href="#">shipping and billing addresses</a> and <a
                                        href="#">Edit your password and account details.</a></p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="orders">
                            <div class="myaccount-content">
                                <h4 class="title">Orders </h4>
                                <div class="card card-default">
                                    <div class="card-body">
                                        <div>
                                            <div id="responsive-data-table_wrapper"
                                                class="dataTables_wrapper dt-bootstrap5 no-footer">
                                                <table id="responsive-data-table" class="table dataTable no-footer"
                                                    style="width: 100%;" aria-describedby="responsive-data-table_info">
                                                    <thead>
                                                        <tr>
                                                            <th class="sorting sorting_asc" tabindex="0"
                                                                aria-controls="responsive-data-table"
                                                                aria-sort="ascending"
                                                                aria-label="Id: activate to sort column descending">Id
                                                            </th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="responsive-data-table"
                                                                aria-label="Total: activate to sort column ascending">
                                                                Total</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="responsive-data-table"
                                                                aria-label="Payment: activate to sort column ascending">
                                                                Payment</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="responsive-data-table"
                                                                aria-label="Status: activate to sort column ascending">
                                                                Status</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="responsive-data-table"
                                                                aria-label="Order date: activate to sort column ascending">
                                                                Order date</th>
                                                            <th class="sorting" tabindex="0"
                                                                aria-controls="responsive-data-table"
                                                                aria-label="Action: activate to sort column ascending">
                                                                Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @foreach ($orders as $order)
                                                            <tr class="odd">
                                                                <td class="sorting_1">{{$order->id}}</td>
                                                                <td>@money($order->total)</td>
                                                                <td>{{$order->payment()->first()->name}}</td>
                                                                <td>{{$order->status()}}</td>
                                                                <td>{{$order->created_at}}</td>
                                                                <td>
                                                                    <div class="btn-group mb-1">
                                                                        <a href="{{route('user.order-detail',['id' => $order->id])}}"
                                                                            class="btn text-primary">View</a>
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
                        <div class="tab-pane fade" id="account-details">
                            <div class="myaccount-content">
                                <h4 class="title">Account details</h4>
                                <div class="login_form_container">
                                    <div class="account_details_form">
                                        <form method="POST" action="{{route('user.my-account.update-account')}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="img_profiles">
                                                <a onclick="openUpload()">
                                                @if($user->avatar)
                                                    <img id="avatar" src="data:image/png;base64, {{$user->avatar}}" alt="img">
                                                @else
                                                    <img id="avatar" src="/web/img/team/team1.png" alt="img">
                                                @endif
                                                </a>
                                                <input type="file" accept="image/*" id="upload" name="upload" hidden>
                                            </div>
                                            <div class="input-radio">
                                                <span class="custom-radio"><input type="radio" id="gender" name="gender" value="1" {{ $user->gender ? 'checked' : '' }} /> Mr.</span>
                                                <span class="custom-radio"><input type="radio" id="gender" name="gender" value="0" {{ $user->gender ? '' : 'checked' }} /> Mrs.</span>
                                            </div>
                                            <div class="row">
                                                <div class="default-form-box col-lg-6">
                                                    <label for="first_name">First name <span>*</span></label>
                                                    <input type="text" class="form-control" value="{{ $user->first_name }}" id="first_name" name="first_name" required autofocus>
                                                    @error('first_name')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror    
                                                </div>
                                                <div class="default-form-box col-lg-6">
                                                    <label for="last_name">Last name <span>*</span></label>
                                                    <input type="text" class="form-control" value="{{ $user->last_name }}" id="last_name" name="last_name" required>
                                                    @error('last_name')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror  
                                                </div>
                                            </div>
                                            <div class="default-form-box">
                                                <label for="birthdate">Birthdate <span>*</span></label>
                                                <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ $user->birthdate }}">
                                                @error('birthdate')
                                                        <p class="text-danger">{{ $message }}</p>
                                                @enderror 
                                            </div>
                                            <div class="default-form-box">
                                                <label for="telephone">Telephone <span>*</span></label>
                                                <input type="text" class="form-control" value="{{ $user->telephone }}" readonly>
                                            </div>
                                            <div class="default-form-box">
                                                <label for="apartment_number">Apartment number <span>*</span></label>
                                                <input type="text" class="form-control" value="{{ $user->apartment_number }}" id="apartment_number" name="apartment_number" required>
                                                @error('apartment_number')
                                                        <p class="text-danger">{{ $message }}</p>
                                                @enderror  
                                            </div>
                                            <div class="row">
                                                <div class="default-form-box col-lg-6">
                                                    <label for="street">Street <span>*</span></label>
                                                    <input type="text" class="form-control" value="{{ $user->street }}" id="street" name="street" required>
                                                    @error('street')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror  
                                                </div>
                                                <div class="default-form-box col-lg-6">
                                                    <label for="ward">Ward <span>*</span></label>
                                                    <input type="text" class="form-control" value="{{ $user->ward }}" id="ward" name="ward" required>
                                                    @error('ward')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror  
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="default-form-box col-lg-6">
                                                    <label for="district">District <span>*</span></label>
                                                    <input type="text" class="form-control" value="{{ $user->district }}" id="district" name="district" required>
                                                    @error('district')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror  
                                                </div>
                                                <div class="default-form-box col-lg-6">
                                                    <label for="city">City <span>*</span></label>
                                                    <input type="text" class="form-control" value="{{ $user->city }}" id="city" name="city" required>
                                                    @error('city')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror  
                                                </div>
                                            </div>
                                            <div class="default-form-box">                   
                                                <label for="email">Email <span>*</span></label>
                                                <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                                            </div>
                                            <div class="default-form-box">
                                                <label for="password">New password</label>
                                                <input type="password" class="form-control" id="password" name="password">
                                                @error('password')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <br>
                                            <label class="checkbox-default">
                                                <input type="checkbox" id="receive_offers" name="receive_offers" {{ $user->receive_offers ? 'checked' : '' }}>
                                                <span>Receive offers from our partners</span>
                                            </label>
                                            @error('receive_offers')
                                                    <p class="text-danger">{{ $message }}</p>
                                            @enderror 
                                            </br>
                                            <br>
                                            <label class="checkbox-default">
                                                <input type="checkbox" id="receive_newsletter" name="receive_newsletter" {{ $user->receive_newsletter ? 'checked' : '' }}>
                                                <span>Sign up for our newsletter<br><em>You may unsubscribe at any
                                                        moment. For that purpose, please find our contact info in the
                                                        legal notice.</em></span>
                                            </label>
                                            @error('receive_newsletter')
                                                    <p class="text-danger">{{ $message }}</p>
                                            @enderror  
                                            </br>
                                            <div class="save_button mt-3">
                                                <button type="submit"
                                                    class="theme-btn-one bg-black btn_sm">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
    <script>
        $('a[data-bs-toggle="tab"]').click(function () {
            localStorage.setItem("CURRENT_TAB", $(this).attr('data-bs-target'));
        });
        $(document).ready(function () {
            var tab = localStorage.getItem('CURRENT_TAB') == null ? '#dashboard' : localStorage.getItem('CURRENT_TAB');
            $(`a[data-bs-toggle="tab"][data-bs-target="${tab}"]`)[0].click();
        });
    </script>
@endsection