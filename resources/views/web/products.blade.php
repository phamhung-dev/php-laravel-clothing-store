@extends('web.layouts.default')

@section('title', 'Products')

@section('content')
    <!-- Banner Area -->
    <section id="common_banner_one">
        <div class="container ">
            <div class="row">
                <div class="col-lg-12">
                    <div class="common_banner_text">
                        <h2>Products</h2>
                        <ul>
                            <li><a href="{{route('home')}}">Home</a></li>
                            <li><i class="fas fa-slash"></i></li>
                            <li class="active">Products</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
   <!-- Shop Main Area -->
   <section id="shop_main_area" class="ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="product_shot" style="justify-content: flex-start;">
                        <div class="product_shot_title">
                            <p> Filter:</p>
                        </div>
                        <div class="customs_selects">
                            <select id="filter_products" class="customs_sel_box">
                                <option {{$filter == 'all' ? 'selected' : ''}} value="all">All</option>
                                <option {{$filter == 'newArrival' ? 'selected' : ''}} value="newArrival">New Arrival</option>
                                <option {{$filter == 'onSale' ? 'selected' : ''}} value="onSale">On Sale</option>
                                <option {{$filter == 'pant' ? 'selected' : ''}} value="pant">Pant</option>
                                <option {{$filter == 'shirt' ? 'selected' : ''}} value="shirt">Shirt</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="product_shot">
                        <div class="product_shot_title">
                            <p> Sort By:</p>
                        </div>
                        <div class="customs_selects">
                            <select id="sort_products" class="customs_sel_box">
                                <option {{$sort == 'newest' ? 'selected' : ''}} value="newest">Sort by newest</option>
                                <option {{$sort == 'priceLow' ? 'selected' : ''}} value="priceLow">Price: low to high</option>
                                <option {{$sort == 'priceHigh' ? 'selected' : ''}} value="priceHigh">Price: high to low</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse ($products as $product)
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
                    <h3 class="text-center my-5">No product found</h3>
                @endforelse
                <div class="col-lg-12">
                    <!-- pagination start -->
                    <ul id="pagination" class="pagination">
                        <li class="page-item">
                            <a class="page-link" aria-label="Previous">
                                <span aria-hidden="true">«</span>
                            </a>
                        </li>
                        @for($i = 1; $i <= $totalPage; $i++)
                            @if($i == $page)
                                <li class="page-item active"><a class="page-link">{{$i}}</a></li>
                            @else
                                <li class="page-item"><a class="page-link">{{$i}}</a></li>
                            @endif
                        @endfor
                        <li class="page-item">
                            <a class="page-link" aria-label="Next">
                                <span aria-hidden="true">»</span>
                            </a>
                        </li>
                    </ul>
                    <!-- pagination end -->
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer_optional')
    <script>
        function getProducts(filter, sort, page){
            var filter = filter == null ? '{{$filter}}' : filter;
            var sort = sort == null ? '{{$sort}}' : sort;
            var page = page == null ? '{{$page}}' : page;
            $(location).attr('href',`/products?filter=${filter}&&sort=${sort}&&page=${page}`);
        }
        $('#sort_products').change(function(){
            var sort = $(this).find(":selected").val();
            getProducts(null, sort, null);
        });
        $('#filter_products').change(function(){
            var filter = $(this).find(":selected").val();
            getProducts(filter, null, null);
        });
        $('.page-link').click(function(){
            var page = $(this).find('span').text();
            if(page == '«')
                page = '{{$page > 1 ? $page - 1 : 1}}';
            if(page == '»')
                page = '{{$page < $totalPage ? $page + 1 : $totalPage}}';
            getProducts(null, null, page);
        });
    </script>
@endsection