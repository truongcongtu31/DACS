@extends('frontend.assets.master')
@section('header')
    @include('frontend.assets.header')
@stop
@section('content')
    <!-- Title page -->
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/bg-02.jpg');">
        <h2 class="ltext-105 cl0 txt-center">
            Blog
        </h2>
    </section>


    <!-- Content page -->
    <section class="bg0 p-t-62 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-9 p-b-80">
                    <div class="p-r-45 p-r-0-lg">
                        <!-- item blog -->
                        @if(isset($blogs))
                            @foreach($blogs as $key => $value)
                                <div class="p-b-63">
                                    <a href="{{route('blog-detail',['id'=>$value->id])}}"
                                       class="hov-img0 how-pos5-parent">
                                        <img src="{{$value->image}}" alt="IMG-BLOG">

                                        <div class="flex-col-c-m size-123 bg9 how-pos5">
									<span class="ltext-107 cl2 txt-center">
										{{$value->created_at->format('d')}}
									</span>

                                            <span class="stext-109 cl3 txt-center">
										{{$value->created_at->format('M-Y')}}
									</span>
                                        </div>
                                    </a>

                                    <div class="p-t-32">
                                        <h4 class="p-b-15">
                                            <a href="{{route('blog-detail',['id'=>$value->id])}}"
                                               class="ltext-108 cl2 hov-cl1 trans-04">
                                                {!!$value->title!!}
                                            </a>
                                        </h4>

                                        <p class="stext-117 cl6">
                                            {!!$value->description!!}
                                        </p>

                                        <div class="flex-w flex-sb-m p-t-18">
									<span class="flex-w flex-m stext-111 cl2 p-r-30 m-tb-10">
										<span>
											<span class="cl4">By</span> Admin
											<span class="cl12 m-l-4 m-r-6">|</span>
										</span>
									</span>

                                            <a href="{{route('blog-detail',['id'=>$value->id])}}"
                                               class="stext-101 cl2 hov-cl1 trans-04 m-tb-10">
                                                Continue Reading

                                                <i class="fa fa-long-arrow-right m-l-9"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            {{ $blogs->links('frontend.assets.pagination')}}
                        @endif


                    </div>
                </div>

                <div class="col-md-4 col-lg-3 p-b-80">
                    <div class="side-menu">
                        <div class="p-t-0">
                            <h4 class="mtext-112 cl2 p-b-33">
                                Categories
                            </h4>

                            <ul>
                                @foreach($categories as $value)
                                    <li class="bor18">
                                        <a href="{{route('shop')}}"
                                           class="dis-block stext-115 cl6 hov-cl1 trans-04 p-tb-8 p-lr-4">
                                            {{$value->name}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="p-t-65">
                            <h4 class="mtext-112 cl2 p-b-33">
                                Featured Products
                            </h4>

                            <ul>
                                @forelse($products as $product)
                                    <li class="flex-w flex-t p-b-30">
                                        <a href="{{route('product-detail',['id'=>$product->id])}}"
                                           class="wrao-pic-w size-214  m-r-20">
                                            <img style="width: 80px" src="{{$product->image}}" alt="PRODUCT">
                                        </a>

                                        <div class="size-215 flex-col-t p-t-8">
                                            <a href="{{route('product-detail',['id'=>$product->id])}}"
                                               class="stext-116 cl8 hov-cl1 trans-04">
                                                {{$product->name}}
                                            </a>

                                            <span class="stext-116 cl6 p-t-20">
											${{$product->price}}
										</span>
                                        </div>
                                    </li>
                                    @if ($loop->iteration == 3)
                                        @break
                                    @endif
                                @empty
                                    <p>No products found.</p>
                                @endforelse

                            </ul>
                        </div>


                        <div class="p-t-50">
                            <h4 class="mtext-112 cl2 p-b-27">
                                Tags
                            </h4>

                            <div class="flex-w m-r--5">
                                <a href="#"
                                   class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                    Man
                                </a>

                                <a href="#"
                                   class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                    Woman
                                </a>

                                <a href="#"
                                   class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                    Kid
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('footer')
    @include('frontend.assets.footer')
@stop
