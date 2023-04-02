@extends('admin.layouts.default')

@section('title', 'product edit')

@section('content')

<!-- CONTENT WRAPPER -->
<div class="ec-content-wrapper">
    <div class="content">
        <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
            <div>
                <h1>Edit Product</h1>
                <p class="breadcrumbs"><span><a href="index.html">Home</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>Product
                </p>
            </div>
            <div>
                <a href="product-list.html" class="btn btn-primary"> View All
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>Edit Product</h2>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row ec-vendor-uploads">
                        @if ($errors->any())
                        <div class="alert alert-danger text-center">{{ $errors->first() }}</div>
                        @endif
                        <form method="POST" action="{{route('admin.product.update',$product->id)}}" class="row g-3" enctype="multipart/form-data">
                            @csrf
                            <div class="col-lg-8">
                                <div class="ec-vendor-upload-detail">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="name" class="form-label">Product name</label>
                                            <input type="text" class="form-control slug-title" placeholder="Casual men shirt" name="name" value="{{ $product->name }}">
                                            @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="weight" class="form-label">weight</label>
                                            <input type="text" class="form-control" placeholder="weight" name="weight" value="{{$product->weight }}">
                                            @error('weight')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="dimensions" class="form-label">Dimensions</label>
                                            <input type="number" class="form-control" placeholder="Dimensions" min="0" id="dimensions" name="dimensions" value="{{ $product->dimensions }}">
                                            @error('dimensions')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Category</label>
                                            <select class="form-select" name="product_category_id">
                                                @foreach ($productCategories as $productCategory)
                                                <option value="{{$productCategory->id}}" {{ $product->ProductCategory->id == $productCategory->id ? 'selected' : '' }}>
                                                    {{ $productCategory->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Gender</label>
                                            <select name="gender" id="gender" class="form-select">
                                                <option value="0" {{ $product->gender == 0 ? 'selected' : '' }}>Male</option>
                                                <option value="1" {{ $product->gender == 1 ? 'selected' : '' }}>Female</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="materials" class="form-label">Materials</label>
                                            <input type="text" class="form-control " placeholder="materials" id="materials" name="materials" value="{{ $product->materials }}">
                                            @error('materials')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="importPrice" class="form-label">Product price</label>
                                            <input type="text" class="form-control " placeholder="Product price" id="importPrice" name="import_price" value="{{ $product->import_price }}">
                                            @error('import_price')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="sellPrice" class="form-label">Product sale price</label>
                                            <input type="text" class="form-control" placeholder="Product sale price" id="sellPrice" name="sell_price" value="{{ $product->sell_price }}">
                                            @error('sell_price')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="discountPercent" class="form-label">Discount (%)</label>
                                            <input type="text" class="form-control " placeholder="Product discount" id="discountPercent" name="discount_percent" value="{{ $product->discount_percent }}">
                                            @error('discount_percent')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control" rows="4" name="description">{{ $product->description }}</textarea>
                                            @error('description')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Order info</label>
                                            <textarea class="form-control" rows="2" name="other_info">{{ $product->other_info }}</textarea>
                                            @error('other_info')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-12 form-check form-switch m-3">
                                            <input class="form-check-input" type="checkbox" role="switch" id="isActived" name="is_active" {{ $product->is_active ? 'checked' : '' }}>
                                            <label class="form-check-label" for="isActived">Active</label>
                                        </div>
                                        <div class="col-md-12">
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
                                        <label class="form-check-label">Image upload</label>
                                        @error('image_upload')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror>
                                        <div class="avatar-upload">
                                            <div class="avatar-edit">
                                                <input type="file" id="uploadImage" class="ec-image-upload" accept="image/*" name="image_upload">
                                                <label for="uploadImage"><img src="https://andit.co/projects/html/andshop/andshop-dashboard/assets/img/icons/edit.svg" class="svg_img header_svg" alt="edit"></label>
                                            </div>
                                            <div class="avatar-preview ec-preview">
                                                <div class="imagePreview ec-div-preview">
                                                    @if($product->image !=null)
                                                    <img class="ec-image-preview" src="data:image/png;base64, {{$product->image}}" alt="img">
                                                    @else
                                                    <img class="ec-image-preview" src="https://cdn3.iconfinder.com/data/icons/clothing-set-4/64/tshirt-other-512.png" alt="edit">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <label class="form-check-label">Image upload hover</label>
                                        @error('image_hover_upload')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror>
                                        <div class="avatar-upload">
                                            <div class="avatar-edit">
                                                <input type="file" id="uploadImageHover" class="ec-image-upload" name="image_hover_upload" accept="image/*">
                                                <label for="uploadImageHover"><img src="https://andit.co/projects/html/andshop/andshop-dashboard/assets/img/icons/edit.svg" class="svg_img header_svg" alt="edit"></label>
                                            </div>
                                            <div class="avatar-preview ec-preview">
                                                <div class="imagePreview ec-div-preview">
                                                    @if($product->image_hover !=null)
                                                    <img class="ec-image-preview" src="data:image/png;base64, {{$product->image_hover}}" alt="img">
                                                    @else
                                                    <img class="ec-image-preview" src="https://cdn3.iconfinder.com/data/icons/clothing-set-4/64/tshirt-other-512.png" alt="edit">
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