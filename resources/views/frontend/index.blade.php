@extends('frontend.assets.master')
@section('header')
    <header>
        <!-- Header desktop -->
        <div class="container-menu-desktop">
            <!-- Topbar -->
            <div class="top-bar">
                <div class="content-topbar flex-sb-m h-full container">
                    <div class="left-top-bar">
                        Free shipping for standard order over $100
                    </div>

                    <div class="right-top-bar flex-w h-full">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ route('profile.edit') }}" class="flex-c-m trans-04 p-lr-25">
                                    Hello, {{ Auth::user()->name }}
                                </a>

                                <a href="{{ route('profile.edit') }}" class="flex-c-m trans-04 p-lr-25">
                                    My Account
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <button type="submit" href="#" class="flex-c-m trans-04 p-lr-25 h-100"
                                            style="color: #b2b2b2; font-size: 12px">
                                        <span>{{ __('Log Out') }}</span>
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="flex-c-m trans-04 p-lr-25">
                                    You're not logged in!
                                </a>
                                <a href="{{ route('login') }}" class="flex-c-m trans-04 p-lr-25">
                                    Log in
                                </a>
                            @endauth
                        @endif

                    </div>
                </div>
            </div>

            <div class="wrap-menu-desktop">
                <nav class="limiter-menu-desktop container">

                    <!-- Logo desktop -->
                    <a href="{{ route('home') }}" class="logo">
                        <img src="images/icons/logo-01.png" alt="IMG-LOGO">
                    </a>

                    <!-- Menu desktop -->
                    <div class="menu-desktop">
                        <ul class="main-menu">
                            @foreach ($menus as $value)
                                <li class="menu">
                                    @if(Route::has($value['url']))
                                        <a href="{{ route($value['url'])  }}">{{ $value['name'] }}</a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Icon header -->
                    <div class="wrap-icon-header flex-w flex-r-m">

                        @if(session()->get('cart') !== null)
                            <div id="num"
                                 class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
                                 data-notify="{{count(session()->get('cart'))}}">
                                <i class="zmdi zmdi-shopping-cart"></i>
                            </div>
                        @else
                            <div
                                class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
                                data-notify="0">
                                <i class="zmdi zmdi-shopping-cart"></i>
                            </div>
                        @endif

                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
                            <a style="color: #353b41" href="{{ route('order-show')}}"><i class="zmdi zmdi-mall"></i></a>
                        </div>

                    </div>
                </nav>
            </div>
        </div>

        <!-- Modal Search -->
        <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
            <div class="container-search-header">
                <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                    <img src="images/icons/icon-close2.png" alt="CLOSE">
                </button>

                <form class="wrap-search-header flex-w p-l-15">
                    <button class="flex-c-m trans-04">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                    <input class="plh3" type="text" name="search" placeholder="Search...">
                </form>
            </div>
        </div>
    </header>
@stop
@section('content')
    <!-- Slider -->
    <section class="section-slide">
        <div class="wrap-slick1">
            <div class="slick1">
                @foreach ($slides as $key => $value)
                    <div class="item-slick1" style="background-image: url({{ $value['image'] }});">
                        <div class="container h-full">
                            <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                                <div class="layer-slick1 animated visible-false" data-appear="fadeInDown"
                                     data-delay="0">
                                    <span class="ltext-101 cl2 respon2">
                                        G-Shock Collection 2023
                                    </span>
                                </div>

                                <div class="layer-slick1 animated visible-false" data-appear="fadeInUp"
                                     data-delay="800">
                                    <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
                                        NEW COLLECTION
                                    </h2>
                                </div>

                                <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
                                    <a href="{{ route('shop') }}"
                                       class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                        Shop Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>


    <!-- Banner -->
    <div class="sec-banner bg0 p-t-80 p-b-50">
        <div class="container">
            <div class="row">
                @foreach ($banners as $key => $value)
                    <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                        <!-- Block1 -->
                        <div class="block1 wrap-pic-w">
                            <img src="{{ $value['image'] }}" alt="IMG-BANNER">

                            <a href="{{ route('shop') }}"
                               class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                                <div class="block1-txt-child1 flex-col-l">
                                    <span class="block1-name ltext-102 trans-04 p-b-8 text-white">
                                        {{ $value['name'] }}
                                    </span>

                                    <span class="block1-info stext-102 trans-04 text-white">
                                        {{ $value['event'] }}
                                    </span>
                                </div>

                                <div class="block1-txt-child2 p-b-4 trans-05">
                                    <div class="block1-link stext-101 cl0 trans-09">
                                        Shop Now
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>


    <!-- Product -->
    <section class="bg0 p-t-23 p-b-140">
        <div class="container">
            <div class="p-b-10">
                <h3 class="text-center ltext-103 cl5 mb-4">
                    Lastest product
                </h3>
            </div>


            <div class="row isotope-grid">
                @foreach ($latestProducts as $key => $value)
                    <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                        <!-- Block2 -->
                        <div class="block2">
                            <div class="block2-pic hov-img0">
                                <img src="{{ $value['image'] }}" alt="IMG-PRODUCT">

                                <a href="#" data-url="{{ route('product.show', $value->id) }}"
                                   class="product quick-view-btn block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                    Quick View
                                </a>
                            </div>

                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l ">
                                    <a href="{{ route('product-detail',['id'=>$value->id]) }}"
                                       class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        {{ $value['name'] }}
                                    </a>

                                    <span class="stext-105 cl3">
                                        {{ '$'.number_format($value['price']) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>



    <!-- Modal1 -->

@stop




<!-- Footer -->
