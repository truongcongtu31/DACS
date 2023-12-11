@extends('frontend.master')
@section('header')
    @include('frontend.assets.header')
@stop
@section('content')

    <!-- Title page -->
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('../images/banners/banner-03.jpg');">
        <h2 class="ltext-105 cl0 txt-center">
            About
        </h2>
    </section>


    <!-- Content page -->
    <section class="bg0 p-t-75 p-b-120">
        <div class="container">
            @foreach ($abouts as $key => $item)
                @if (($key + 1) % 2 != 0)
                    <div class="row p-b-148">
                        <div class="col-md-7 col-lg-8">
                            <div class="p-t-7 p-r-85 p-r-15-lg p-r-0-md">
                                <h3 class="mtext-111 cl2 p-b-16">
                                    {{ $item->title }}
                                </h3>

                                <p class="stext-113 cl6 p-b-26">
                                    {!! $item->content !!}
                                </p>
                            </div>
                        </div>

                        <div class="col-11 col-md-5 col-lg-4 m-lr-auto">
                            <div class="how-bor1 ">
                                <div class="hov-img0">
                                    <img src="{{ $item->image }}" alt="IMG">
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="order-md-2 col-md-7 col-lg-8 p-b-30">
                            <div class="p-t-7 p-l-85 p-l-15-lg p-l-0-md">
                                <h3 class="mtext-111 cl2 p-b-16">
                                    {{ $item->title }}
                                </h3>
                                {{--
						<p class="stext-113 cl6 p-b-26">
							Mauris non lacinia magna. Sed nec lobortis dolor. Vestibulum rhoncus dignissim risus, sed consectetur erat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam maximus mauris sit amet odio convallis, in pharetra magna gravida. Praesent sed nunc fermentum mi molestie tempor. Morbi vitae viverra odio. Pellentesque ac velit egestas, luctus arcu non, laoreet mauris. Sed in ipsum tempor, consequat odio in, porttitor ante. Ut mauris ligula, volutpat in sodales in, porta non odio. Pellentesque tempor urna vitae mi vestibulum, nec venenatis nulla lobortis. Proin at gravida ante. Mauris auctor purus at lacus maximus euismod. Pellentesque vulputate massa ut nisl hendrerit, eget elementum libero iaculis.
						</p> --}}
                                <div class="bor16 p-l-29 p-b-9 m-t-22">
                                    <p class="stext-114 cl6 p-r-40 p-b-11">
                                        {!! $item->content !!}
                                    </p>

                                    <span class="stext-111 cl8">
                                        - Van Anh’s
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="order-md-1 col-11 col-md-5 col-lg-4 m-lr-auto p-b-30">
                            <div class="how-bor2">
                                <div class="hov-img0">
                                    <img src="{{ $item->image }}" alt="IMG">
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

    </section>
@stop
@section('footer')
    @include('frontend.assets.footer')
@stop
