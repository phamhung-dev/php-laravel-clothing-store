<!DOCTYPE html>
<html lang="en" class="mdl-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title') - AndShop</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('web/css/bootstrap.min.css')}}">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="{{asset('web/css/fontawesome.all.min.css')}}">
    <!-- owl.carousel css -->
    <link rel="stylesheet" href="{{asset('web/css/owl.carousel.min.css')}}">
    <!-- owl.theme.default css -->
    <link rel="stylesheet" href="{{asset('web/css/owl.theme.default.min.css')}}">
    <!--lineProgressbar css -->
    <link rel="stylesheet" href="{{asset('web/css/jquery.lineProgressbar.css')}}">
    <!-- animate css -->
    <link rel="stylesheet" href="{{asset('web/css/animate.min.css')}}">
    <!-- meanmenu css -->
    <link rel="stylesheet" href="{{asset('web/css/meanmenu.min.css')}}">

    @yield('header_optional')

    <!-- Style css -->
    <link rel="stylesheet" href="{{asset('web/css/style.css')}}">
    <!-- color css -->
    <link rel="stylesheet" href="{{asset('web/css/color.css')}}">
    <!-- Responsive css -->
    <link rel="stylesheet" href="{{asset('web/css/responsive.css')}}">

    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('web/img/favicon/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('web/img/favicon/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('web/img/favicon/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('web/img/favicon/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('web/img/favicon/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('web/img/favicon/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('web/img/favicon/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('web/img/favicon/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('web/img/favicon/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('web/img/favicon/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('web/img/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('web/img/favicon/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('web/img/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('web/img/favicon/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('web/img/favicon/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">
</head>

<body>

    <!-- Preloader Area -->
    @include('web.includes.preloader')
    
    <!-- Top Header Area -->
    @include('web.includes.header')

    <!-- Navbar Area -->
    @include('web.includes.navbar')

    <!-- Search Area -->
    @include('web.includes.search')

    <!-- Content Section -->
    @yield('content')

    <!-- ShopingCart Modal Area Start-->
    @include('web.includes.shopping_cart')

    <!-- Wishlist Modal Area Start-->
    @include('web.includes.wishlist')

    <!-- Footer Area -->
    @include('web.includes.footer')

    <!-- CopyRight Area -->
    @include('web.includes.copy_right')

    <!-- Jquery -->
    <script src="{{asset('web/js/jquery-3.6.0.min.js')}}"></script>
    <!-- Bootstrap js -->
    <script src="{{asset('web/js/popper.min.js')}}"></script>
    <script src="{{asset('web/js/bootstrap.min.js')}}"></script>
    <!-- owl carousel js -->
    <script src="{{asset('web/js/owl.carousel.min.js')}}"></script>
    <!-- Menu js -->
    <script src="{{asset('web/js/meanmenu.min.js')}}"></script>
    <!-- lineProgressbar js -->
    <script src="{{asset('web/js/jquery.waypoints.js')}}"></script>
    <!-- lineProgressbar js -->
    <script src="{{asset('web/js/jquery.lineProgressbar.js')}}"></script>
    <!-- Count js -->
    <script src="{{asset('web/js/count.js')}}"></script>
    <!-- Timer js -->
    <script src="{{asset('web/js/nice-select.min.js')}}"></script>
    <!-- wow.js -->
    <script src="{{asset('web/js/wow.min.js')}}"></script>

    @yield('footer_optional')
    
    <!-- Custom js -->
    <script src="{{asset('web/js/custom.js')}}"></script>

</body>

</html>