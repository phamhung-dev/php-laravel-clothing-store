@extends('admin.layouts.default')

@section('title', 'create new coupon')

@section('content')

<!-- CONTENT WRAPPER -->
<div class="ec-content-wrapper">
    <div class="content">
        <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
            <div>
                <h1>Add coupon</h1>
                <p class="breadcrumbs"><span><a href="index.html">Home</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>Add coupon
                </p>
            </div>
            <div>
                <a href="/admin/coupon" class="btn btn-primary"> View All
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>Add coupon</h2>

                    </div>

                </div>
                <div class="card-body">
                    <div class="row ec-vendor-uploads">
                        @if (session('error'))
                        <div class="alert alert-danger text-center">{{ session('error') }}</div>
                        @endif
                        <form method="POST" action="{{route('admin.coupon.create.submit')}}" class="row g-3" enctype="multipart/form-data">
                            @csrf
                            <div class="col-lg-8">
                                <div class="ec-vendor-upload-detail">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="color" class="form-label">Name</label>
                                            <input type="text" class="form-control slug-title" placeholder="Name" value="{{ old('name') }}" name="name">
                                            @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="discountPercent" class="form-label">Discount
                                                percent</label>
                                            <input type="number" class="form-control" placeholder="Discount Percent" value="{{ old('discount_percent') }}" name="discount_percent" min="0">
                                            @error('discount_percent')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="startDate" class="form-label">Start day</label>
                                            <input type="date" class="form-control" placeholder="startDate" min="0" id="startDate" value="{{ old('start_date') }}" name="start_date">
                                            @error('start_date')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="endDate" class="form-label">End day</label>
                                            <input type="date" class="form-control" placeholder="endDate" min="0" id="startDate" value="{{ old('end_date') }}" name="end_date">
                                            @error('end_date')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Describe</label>
                                            <textarea class="form-control" rows="2" name="description"></textarea>
                                        </div>
                                        <div class="form-group col-12 form-check form-switch m-3">
                                            <input class="form-check-input" type="checkbox" role="switch" id="isActived" @checked(old('is_active')) checked name="is_active">
                                            <label class="form-check-label" for="isActived">Active</label>
                                        </div>
                                        <div class="col-md-12">
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