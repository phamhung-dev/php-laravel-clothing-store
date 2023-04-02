@extends('admin.layouts.default')

@section('title', 'create new role')

@section('content')

<!-- CONTENT WRAPPER -->
<div class="ec-content-wrapper">
    <div class="content">
        <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
            <div>
                <h1>Add role</h1>
                <p class="breadcrumbs"><span><a href="index.html">Home</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>Add role
                </p>
            </div>
            <div>
                <a href="/admin/role" class="btn btn-primary"> View All
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>Add role</h2>
                    </div>

                </div>
                <div class="card-body">
                    <div class="row ec-vendor-uploads">
                        @if (session('error'))
                        <div class="alert alert-danger text-center">{{ session('error') }}</div>
                        @endif
                        <form method="POST" action="/admin/role/create" class="row g-3" enctype="multipart/form-data">
                            @csrf
                            <div class="col-lg-8">
                                <div class="ec-vendor-upload-detail">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="color" class="form-label"> User Name</label>
                                            <select class="form-select" name="user_id">
                                                @foreach ($users as $user)
                                                <option value="{{$user->id}}" selected="0">
                                                    {{$user->first_name.' '.$user->last_name}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="discountPercent" class="form-label">Role</label>
                                            <select class="form-select" name="role_id">
                                                @foreach ($roles as $role)
                                                <option value="{{$role->id}}" selected="0">
                                                    {{$role->name}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <div class="product_add_cancel_button">
                                                <button type="submit" class="btn btn-border">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Create
                                                    new</button>
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


@section('footer_optional')
<!-- Option Switcher -->
<script src="{{asset('admin/plugins/options-sidebar/optionswitcher.js')}}"></script>
@endsection

@endsection