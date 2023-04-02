@extends('admin.layouts.default')

@section('title', 'Edit create')

@section('content')

<!-- CONTENT WRAPPER -->
<div class="ec-content-wrapper">
    <div class="content">
        <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
            <div>
                <h1>Edit Admin</h1>
                <p class="breadcrumbs"><span><a href="index.html">Home</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>Admin
                </p>
            </div>
            <div>
                <a href="/admin/admin-user" class="btn btn-primary"> View All
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>Edit Admin</h2>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row ec-vendor-uploads">
                        @if ($errors->any())
                        <div class="alert alert-danger text-center">{{ $errors->first() }}</div>
                        @endif
                        <form method="POST" action="{{route('admin.adminUser.update',$user->id)}}" class="row g-3" enctype="multipart/form-data">
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
                            <div class="col-lg-4">
                                <div class="ec-vendor-img-upload">
                                    <div class="ec-vendor-main-img">
                                        <label class="form-check-label">Avatar upload</label>
                                        @error('avatar_upload')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror>
                                        <div class="avatar-upload">
                                            <div class="avatar-edit">
                                                <input type="file" id="uploadImage" class="ec-image-upload" accept="image/*" name="avatar_upload">
                                                <label for="uploadImage"><img src="https://andit.co/projects/html/andshop/andshop-dashboard/assets/img/icons/edit.svg" class="svg_img header_svg" alt="edit"></label>
                                            </div>
                                            <div class="avatar-preview ec-preview">
                                                <div class="imagePreview ec-div-preview">
                                                    @if($user->avatar !=null)
                                                    <img class="ec-image-preview" src="data:image/png;base64, {{$user->avatar}}" alt="img">
                                                    @else
                                                    <img class="ec-image-preview" src="{{asset('web/img/common/avatar.png')}}" alt="edit">
                                                    @endif
                                                </div>
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
    </div> <!-- End Content -->
</div> <!-- End Content Wrapper -->

@endsection

@section('footer_optional')
<!-- Option Switcher -->
<script th:src="{{asset('admin/plugins/options-sidebar/optionswitcher.js')}}"></script>
@endsection