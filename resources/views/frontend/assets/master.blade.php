<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS -->
    <base href="/">
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{'/frontend/fonts/font-awesome-4.7.0/css/font-awesome.min.css'}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('/frontend/fonts/iconic/css/material-design-iconic-font.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend/fonts/linearicons-v1.0.0/icon-font.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend/vendor/animate/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend/vendor/css-hamburgers/hamburgers.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend/vendor/animsition/css/animsition.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend/vendor/select2/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend/vendor/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend/vendor/slick/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend/vendor/MagnificPopup/magnific-popup.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/frontend/vendor/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/main.css')}}">


    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- Alertify CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>

    <style>
        #alldata, #data-filter {
            height: auto !important;
        }
    </style>
</head>

<body class="animsition">

<!-- Header -->
@yield('header')

<!-- Cart -->
<div id="modal-cart">
    {{--    @include('frontend.products.modal-cart')--}}
</div>

@yield('content')

<!-- Footer -->
@yield('footer')

<!-- Back to top -->
<div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="zmdi zmdi-chevron-up"></i>
        </span>
</div>

<!-- Modal -->
<div id="modal">
    @include('frontend.products.modal')
</div>

@include('frontend.scripts.script')

</body>

</html>
