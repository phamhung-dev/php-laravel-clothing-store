@extends('admin.layouts.default')

@section('title', 'Your profile')

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
                <h1>Your profile</h1>
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
                        <div class="card-body">
                            <div class="row ec-vendor-uploads">
                                @if ($errors->any())
                                <div class="alert alert-danger text-center">{{ $errors->first() }}</div>
                                @endif
                                <form method="POST" action="{{route('admin.adminUser.updateProfile',$user->id)}}" class="row g-3" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-lg-8">
                                        <div class="ec-vendor-upload-detail">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label for="first_name" class="form-label">Fist name</label>
                                                    <input type="text" class="form-control slug-title" placeholder="First name" name="first_name" value="{{ $user->first_name }}">
                                                    @error('first_name')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="last_name" class="form-label">Last name</label>
                                                    <input type="text" class="form-control slug-title" placeholder="Last name" name="last_name" value="{{ $user->last_name }}">
                                                    @error('last_name')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" placeholder="Email" name="email" value="{{ $user->email }}">
                                                    @error('email')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="telephone" class="form-label">Telephone</label>
                                                    <input type="text" class="form-control" placeholder="telephone" min="0" id="telephone" name="telephone" value="{{ $user->telephone }}">
                                                    @error('telephone')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="birthdate" class="form-label">BirthDate</label>
                                                    <input type="date" class="form-control" placeholder="birthdate" min="0" id="birthdate" name="birthdate" value="{{ $user->birthdate }}">
                                                    @error('birthdate')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Gender</label>
                                                    <select name="gender" id="gender" class="form-select">
                                                        <option value="0" {{ $user->gender == 0 ? 'selected' : '' }}>Male</option>
                                                        <option value="1" {{ $user->gender == 1 ? 'selected' : '' }}>Female</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="apartment_number" class="form-label">Apartment number</label>
                                                    <input type="text" class="form-control" placeholder="apartment number" min="0" id="apartment_number" name="apartment_number" value="{{ $user->apartment_number }}">
                                                    @error('apartment_number')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="district" class="form-label">street</label>
                                                    <input type="text" class="form-control" placeholder="Street" min="0" id="street" name="street" value="{{ $user->street }}">
                                                    @error('street')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="ward" class="form-label">ward</label>
                                                    <input type="text" class="form-control" placeholder="ward" min="0" id="ward" name="ward" value="{{ $user->ward }}">
                                                    @error('ward')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="district" class="form-label">district</label>
                                                    <input type="text" class="form-control" placeholder="district" min="0" id="district" name="district" value="{{ $user->district }}">
                                                    @error('district')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="city" class="form-label">city</label>
                                                    <input type="text" class="form-control" placeholder="city" min="0" id="city" name="city" value="{{ $user->city }}">
                                                    @error('city')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="new_password" class="form-label">New password</label>
                                                    <input type="password" class="form-control" placeholder="new password" min="0" id="password" name="new_password" value="">
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <div class="product_add_cancel_button">
                                                        <button type="submit" class="btn btn-border">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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