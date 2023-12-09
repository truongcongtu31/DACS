@extends('frontend.master')
@section('header')
    @include('frontend.assets.header')
@stop
@section('content')

    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
				Shoping Cart
			</span>
        </div>
    </div>

    <div id="main-cart">
        <form class="bg0 p-t-75 p-b-85">
            <div class="container">
                <div id="product-cart" class="row">
                    @include('frontend.assets.main-cart')
                </div>
            </div>
        </form>
    </div>

@stop
@section('footer')
    @include('frontend.assets.footer')
@stop

