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
				Order
			</span>
        </div>
    </div>

    <div id="main-order">
        <div class="bg0 p-t-35 p-b-85">
            <h1 style="text-align: center" class="p-b-35"><strong>YOUR ORDER</strong></h1>

            <div class="container">
                @include('aleart')
            </div>
            @include('frontend.assets.main-order')
            <div id="modal-order">
                @include('frontend.order.modal-order')
            </div>

        </div>
    </div>

@stop
@section('footer')
    @include('frontend.assets.footer')
@stop

