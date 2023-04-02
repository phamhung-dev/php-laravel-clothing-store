@extends('web.layouts.default')

@section('title', $product->name)

@section('content')
    <!-- Banner Area -->
    <section id="common_banner_one">
        <div class="container ">
            <div class="row">
                <div class="col-lg-12">
                    <div class="common_banner_text">
                        <h2>Single Product</h2>
                        <ul>
                            <li><a href="{{route('home')}}">Home</a></li>
                            <li><i class="fas fa-slash"></i></li>
                            <li><a href="{{route('products')}}">Products</a></li>
                            <li><i class="fas fa-slash"></i></li>
                            <li class="active">Single Product</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Single Area -->
    <section id="product_single_one" class="ptb-100">
        <div class="container">
            <div class="row area_boxed">
                <div class="col-lg-4">
                    <div class="product_single_one_img">
                        <img src="data:image/png;base64, {{$product->image}}" alt="">
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="product_details_right_one">
                        <div class="modal_product_content_one">
                            <div id="product_count_form_two">
                                <input type="text" name="id" value="{{$product->id}}" hidden />
                                <h3>{{$product->name}} - Code: {{$product->id}}</h3>
                                <h4>@money($product->discountPrice())
                                    @if($product->discount_percent > 0)
                                    <del>@money($product->sell_price)</del>
                                    @endif
                                </h4>
                                <div class="customs_selects">
                                    <div class="mb-2">
                                        <span class="font-weight-600">Size</span>
                                    </div>
                                    <div>
                                        <select name="size" id="size" class="customs_sel_box">
                                            @foreach($sizes as $size)
                                            <option value="{{$size->size}}">{{$size->size}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="customs_selects pt-2 mb-3">
                                    <div class="mb-2">
                                        <span class="font-weight-600">Color</span>
                                    </div>
                                    <div>
                                        <select name="color" id="color" class="customs_sel_box">
                                            @foreach($colors as $color)
                                            <option value="{{$color->color}}">{{$color->color}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="product_count_one">
                                    <div class="plus-minus-input">
                                        <div class="input-group-button">
                                            <button type="button" class="button" data-quantity="minus"
                                                data-field="quantity">
                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                        <input class="form-control" type="number" id="quantity" name="quantity"
                                            value="0" min="0" max="{{$maxQuantity}}">
                                        <div class="input-group-button">
                                            <button type="button" class="button" data-quantity="plus"
                                                data-field="quantity">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div id="message">
                                </div>
                                @error('quantity')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                                @if(session('message'))
                                <p class="text-success">{{session('message')}}</p>
                                @endif
                                <div class="links_Product_areas">
                                    <ul>
                                        <li>
                                            <a onclick="addToWishlist({{$product->id}})" class="action wishlist" title="Wishlist"><i
                                                    class="far fa-heart"></i>Add To Wishlist</a>
                                        </li>
                                        <li>
                                            <a href="compare.html" class="action compare" title="Compare"><i
                                                    class="fas fa-exchange-alt"></i>Add To Compare</a>
                                        </li>
                                    </ul>
                                    <button onclick="addToCart()" class="theme-btn-one btn-black-overlay btn_sm">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="product_details_tabs">
                        <ul class="nav nav-tabs">
                            <li><a data-bs-toggle="tab" data-bs-target="#description" href="#!"
                                    class="active">Description</a></li>
                            <li><a data-bs-toggle="tab" data-bs-target="#additional" href="#!">Additional
                                    Information</a></li>
                            <li><a data-bs-toggle="tab" data-bs-target="#review" href="#!">Review</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="description" class="tab-pane fade in show active">
                                <div class="product_description">
                                    {!! $product->description !!}
                                </div>
                            </div>
                            <div id="additional" class="tab-pane fade">
                                <div class="product_additional">
                                    <ul>
                                        <li>Gender: <span>{{$product->gender()}}</span></li>
                                        <li>Weight: <span>{{$product->weight}}</span></li>
                                        <li>Dimensions: <span>{{$product->dimensions}}</span></li>
                                        <li>Materials: <span>{{$product->materials}}</span></li>
                                        <li>Other Info: <span>{{$product->other_info}}</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div id="review" class="tab-pane fade">
                                <div class="product_reviews">
                                    <ul>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Product -->
    <section id="related_product" class="pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="center_heading">
                        <h2>You Might Also Like</h2>
                        <p>Mauris luctus nisi sapien tristique dignissim ornare</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse ($relatedProducts as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="product_wrappers_one">
                            <div class="thumb">
                                <a href="{{route('products.single-product', ['id' => $product->id])}}"
                                    class="image">
                                    <img src="data:image/png;base64, {{$product->image}}"
                                        alt="Product">
                                    <img class="hover-image"
                                        src="data:image/png;base64, {{$product->image_hover}}"
                                        alt="Product">
                                </a>
                                <span class="badges">
                                    <span class="new">New</span>
                                </span>
                                @if($product->discount_percent > 0)
                                    <span class="badges mt-5">
                                        <span class="hot">Sale {{$product->discount_percent}}%</span>
                                    </span>
                                @endif
                                <div class="actions">
                                    <a onclick="addToWishlist({{$product->id}})" class="action wishlist"
                                        title="Wishlist"><i class="far fa-heart"></i></a>
                                    <a href="compare.html" class="action compare" title="Compare"><i
                                            class="fas fa-exchange-alt"></i></a>
                                </div>
                                <a class="add-to-cart offcanvas-toggle" href="{{route('products.single-product', ['id' => $product->id])}}">
                                    View Detail
                                </a>
                            </div>
                            <div class="content">
                                <h5 class="title">
                                    <a href="{{route('products.single-product', ['id' => $product->id])}}">{{$product->name}}</a>
                                </h5>
                                <span class="price">
                                    <span class="new">@money($product->discountPrice())</span>
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center my-5">No products</p>
                @endforelse
            </div>
        </div>
    </section>
    <!-- Instagram Arae -->
    <section id="instagram_area_one" class="pt-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="center_heading">
                        <h2>Follow Us Instagram</h2>
                        <p>Mauris luctus nisi sapien tristique dignissim ornare</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="instagram_post_slider owl-carousel owl-theme owl-loaded owl-drag">
                        <div class="owl-stage-outer">
                            <div class="owl-stage"
                                style="transform: translate3d(-3993px, 0px, 0px); transition: all 1s ease 0s; width: 8712px;">
                                <div class="owl-item cloned" style="width: 363px;">
                                    <div class="instgram_post">
                                        <a href="#!">
                                            <i class="fab fa-instagram"></i>
                                            <img src="{{asset('web/img/instagram/post8.png')}}" alt="img">
                                        </a>
                                    </div>
                                </div>
                                <div class="owl-item cloned" style="width: 363px;">
                                    <div class="instgram_post">
                                        <a href="#!">
                                            <i class="fab fa-instagram"></i>
                                            <img src="{{asset('web/img/instagram/post9.png')}}" alt="img">
                                        </a>
                                    </div>
                                </div>
                                <div class="owl-item cloned" style="width: 363px;">
                                    <div class="instgram_post">
                                        <a href="#!">
                                            <i class="fab fa-instagram"></i>
                                            <img src="{{asset('web/img/instagram/post10.png')}}" alt="img">
                                        </a>
                                    </div>
                                </div>
                                <div class="owl-item cloned" style="width: 363px;">
                                    <div class="instgram_post">
                                        <a href="#!">
                                            <i class="fab fa-instagram"></i>
                                            <img src="{{asset('web/img/instagram/post1.png')}}" alt="img">
                                        </a>
                                    </div>
                                </div>
                                <div class="owl-item cloned" style="width: 363px;">
                                    <div class="instgram_post">
                                        <a href="#!">
                                            <i class="fab fa-instagram"></i>
                                            <img src="{{asset('web/img/instagram/post11.png')}}" alt="img">
                                        </a>
                                    </div>
                                </div>
                                <div class="owl-item cloned" style="width: 363px;">
                                    <div class="instgram_post">
                                        <a href="#!">
                                            <i class="fab fa-instagram"></i>
                                            <img src="{{asset('web/img/instagram/post12.png')}}" alt="img">
                                        </a>
                                    </div>
                                </div>
                                <div class="owl-item" style="width: 363px;">
                                    <div class="instgram_post">
                                        <a href="#!">
                                            <i class="fab fa-instagram"></i>
                                            <img src="{{asset('web/img/instagram/post2.png')}}" alt="img">
                                        </a>
                                    </div>
                                </div>
                                <div class="owl-item" style="width: 363px;">
                                    <div class="instgram_post">
                                        <a href="#!">
                                            <i class="fab fa-instagram"></i>
                                            <img src="{{asset('web/img/instagram/post3.png')}}" alt="img">
                                        </a>
                                    </div>
                                </div>
                                <div class="owl-item" style="width: 363px;">
                                    <div class="instgram_post">
                                        <a href="#!">
                                            <i class="fab fa-instagram"></i>
                                            <img src="{{asset('web/img/instagram/post4.png')}}" alt="img">
                                        </a>
                                    </div>
                                </div>
                                <div class="owl-item" style="width: 363px;">
                                    <div class="instgram_post">
                                        <a href="#!">
                                            <i class="fab fa-instagram"></i>
                                            <img src="{{asset('web/img/instagram/post5.png')}}" alt="img">
                                        </a>
                                    </div>
                                </div>
                                <div class="owl-item" style="width: 363px;">
                                    <div class="instgram_post">
                                        <a href="#!">
                                            <i class="fab fa-instagram"></i>
                                            <img src="{{asset('web/img/instagram/post6.png')}}" alt="img">
                                        </a>
                                    </div>
                                </div>
                                <div class="owl-item active" style="width: 363px;">
                                    <div class="instgram_post">
                                        <a href="#!">
                                            <i class="fab fa-instagram"></i>
                                            <img src="{{asset('web/img/instagram/post7.png')}}" alt="img">
                                        </a>
                                    </div>
                                </div>
                                <div class="owl-item active" style="width: 363px;">
                                    <div class="instgram_post">
                                        <a href="#!">
                                            <i class="fab fa-instagram"></i>
                                            <img src="{{asset('web/img/instagram/post8.png')}}" alt="img">
                                        </a>
                                    </div>
                                </div>
                                <div class="owl-item active" style="width: 363px;">
                                    <div class="instgram_post">
                                        <a href="#!">
                                            <i class="fab fa-instagram"></i>
                                            <img src="{{asset('web/img/instagram/post9.png')}}" alt="img">
                                        </a>
                                    </div>
                                </div>
                                <div class="owl-item active" style="width: 363px;">
                                    <div class="instgram_post">
                                        <a href="#!">
                                            <i class="fab fa-instagram"></i>
                                            <img src="{{asset('web/img/instagram/post10.png')}}" alt="img">
                                        </a>
                                    </div>
                                </div>
                                <div class="owl-item active" style="width: 363px;">
                                    <div class="instgram_post">
                                        <a href="#!">
                                            <i class="fab fa-instagram"></i>
                                            <img src="{{asset('web/img/instagram/post1.png')}}" alt="img">
                                        </a>
                                    </div>
                                </div>
                                <div class="owl-item" style="width: 363px;">
                                    <div class="instgram_post">
                                        <a href="#!">
                                            <i class="fab fa-instagram"></i>
                                            <img src="{{asset('web/img/instagram/post11.png')}}" alt="img">
                                        </a>
                                    </div>
                                </div>
                                <div class="owl-item" style="width: 363px;">
                                    <div class="instgram_post">
                                        <a href="#!">
                                            <i class="fab fa-instagram"></i>
                                            <img src="{{asset('web/img/instagram/post12.png')}}" alt="img">
                                        </a>
                                    </div>
                                </div>
                                <div class="owl-item cloned" style="width: 363px;">
                                    <div class="instgram_post">
                                        <a href="#!">
                                            <i class="fab fa-instagram"></i>
                                            <img src="{{asset('web/img/instagram/post2.png')}}" alt="img">
                                        </a>
                                    </div>
                                </div>
                                <div class="owl-item cloned" style="width: 363px;">
                                    <div class="instgram_post">
                                        <a href="#!">
                                            <i class="fab fa-instagram"></i>
                                            <img src="{{asset('web/img/instagram/post3.png')}}" alt="img">
                                        </a>
                                    </div>
                                </div>
                                <div class="owl-item cloned" style="width: 363px;">
                                    <div class="instgram_post">
                                        <a href="#!">
                                            <i class="fab fa-instagram"></i>
                                            <img src="{{asset('web/img/instagram/post4.png')}}" alt="img">
                                        </a>
                                    </div>
                                </div>
                                <div class="owl-item cloned" style="width: 363px;">
                                    <div class="instgram_post">
                                        <a href="#!">
                                            <i class="fab fa-instagram"></i>
                                            <img src="{{asset('web/img/instagram/post5.png')}}" alt="img">
                                        </a>
                                    </div>
                                </div>
                                <div class="owl-item cloned" style="width: 363px;">
                                    <div class="instgram_post">
                                        <a href="#!">
                                            <i class="fab fa-instagram"></i>
                                            <img src="{{asset('web/img/instagram/post6.png')}}" alt="img">
                                        </a>
                                    </div>
                                </div>
                                <div class="owl-item cloned" style="width: 363px;">
                                    <div class="instgram_post">
                                        <a href="#!">
                                            <i class="fab fa-instagram"></i>
                                            <img src="{{asset('web/img/instagram/post7.png')}}" alt="img">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="owl-nav disabled"><button type="button" role="presentation"
                                class="owl-prev"><span aria-label="Previous">‹</span></button><button type="button"
                                role="presentation" class="owl-next"><span aria-label="Next">›</span></button></div>
                        <div class="owl-dots disabled"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer_optional')
<script>
    function addToCart(){
        var id = parseInt('{{ $product->id }}');
        var size = $('#size').find(":selected").val();
        var color = $('#color').find(":selected").val();
        var quantity = $('#quantity').val();
        $.ajax({
            url: "{{ route('user.my-cart.add-to-cart') }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
                size: size,
                color: color,
                quantity: quantity
            },
            success: function(response){
                if(response.status == 200){
                    $('#message').html(`<p class="text-success">${response.message}</p>`);
                    viewCart();
                }
                else{
                    $('#message').html(`<p class="text-danger">${response.message}</p>`);
                }
            },
            error: function(error){
                console.log(error);
            }
        });
    }
</script>
@endsection