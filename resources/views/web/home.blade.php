@extends('web.layouts.default')

@section('title', 'Home')

@section('content')
    <!-- Banner Area -->
    <section id="banner_one">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="banner_text_one">
                        <h1 class="wow flipInX" data-wow-duration="3.0s" data-wow-delay=".3s"
                            style="visibility: visible; animation-duration: 3s; animation-delay: 0.3s; animation-name: flipInX;">
                            Live For <span class="wow flipInX" data-wow-duration="2.0s" data-wow-delay=".5s"
                                style="visibility: visible; animation-duration: 2s; animation-delay: 0.5s; animation-name: flipInX;">Fashion</span>
                        </h1>
                        <h3>Save Up To 50%</h3>
                        <a href="{{route('products')}}" class="theme-btn-one bg-black btn_md">Shop Now</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero_img">
                        <img src="{{asset('web/img/common/man.png')}}" alt="img" class="wow slideInRight" data-wow-duration="3.0s"
                            data-wow-delay=".3s"
                            style="visibility: visible; animation-duration: 3s; animation-delay: 0.3s; animation-name: slideInRight;">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="home_area">
        <!-- Hot Product Area -->
        <section id="hot_Product_area" class="ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="center_heading">
                            <h2>Hot Product</h2>
                            <p>Mauris luctus nisi sapien tristique dignissim ornare</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tabs_center_button">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li role="presentation">
                                    <a data-bs-toggle="tab" href="#!" data-bs-target="#new_arrival" role="tab"
                                        class="active">New Arrival</a>
                                </li>
                                <li role="presentation">
                                    <a data-bs-toggle="tab" data-bs-target="#sale" role="tab" href="#!">On sale</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="tabs_el_wrapper">
                            <div class="tab-content" id="myTabContent">
                                <div id="new_arrival" class="tab-pane fade show in active" role="tabpanel">
                                    <div class="row">
                                        @forelse ($newArrivalProducts as $product)
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
                                <div id="sale" class="tab-pane fade" role="tabpanel">
                                    <div class="row">
                                    @forelse ($saleProducts as $product)
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Special offer -->
        <section id="special_offer_one">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 offset-lg-4 col-md-12 col-sm-12 col-12">
                        <div class="offer_banner_one text-center">
                            <h5>TRENDING</h5>
                            <h2>New Fashion</h2>
                            <p>
                                Consectetur adipisicing elit. Dolores nisi distinctio magni, iure deserunt doloribus
                                optio
                            </p>
                            <a href="{{route('products')}}" class="theme-btn-one bg-whites btn_md">Shop Now</a>
                        </div>
                    </div>
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
    </section>
@endsection