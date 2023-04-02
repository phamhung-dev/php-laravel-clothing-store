@extends('admin.layouts.default')

@section('title', 'create new product inventory')

@section('content')

<!-- CONTENT WRAPPER -->
<div class="ec-content-wrapper">
    <div class="content">
        <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
            <div>
                <h1>Add inventory</h1>
                <p class="breadcrumbs"><span><a href="index.html">Home</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>Add inventory
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
                        <h2>Add inventory</h2>
                    </div>

                </div>
                <div class="card-body">
                    <div class="row ec-vendor-uploads">
                        <form method="POST" action="/admin/inventory/create" class="row g-3" enctype="multipart/form-data">
                            @csrf
                            <div class="col-lg-8">
                                <div class="ec-vendor-upload-detail">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="color" class="form-label">Product name</label>
                                            <select class="form-select" name="product_id">
                                                @foreach ($products as $product)
                                                <option value="{{$product->id}}" selected="0">
                                                    {{$product->name}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="size" class="form-label">Size</label>
                                            <input type="text" class="form-control" placeholder="size" value="{{ old('size') }}" name="size" >
                                            @error('size')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="size" class="form-label">Color</label>
                                            <input type="text" class="form-control" placeholder="color" value="{{ old('color') }}" name="color" >
                                            @error('color')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="quantity" class="form-label">Quantity</label>
                                            <input type="number" class="form-control" placeholder="quantity" value="{{ old('quantity') }}" name="quantity" min="1">
                                            @error('discount_percent')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-12 form-check form-switch m-3">
                                            <input class="form-check-input" type="checkbox" role="switch" id="isActived" @checked(old('is_active')) name="is_active">
                                            <label class="form-check-label" for="isActived">Active</label>
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