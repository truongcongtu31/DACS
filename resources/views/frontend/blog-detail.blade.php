@extends('frontend.master')
@section('header')
    @include('frontend.assets.header')
@stop
@section('content')

    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{route('home')}}}" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="{{route('blog')}}" class="stext-109 cl8 hov-cl1 trans-04">
                Blog
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                {{$blog->title}}
            </span>
        </div>
    </div>


    <!-- Content page -->
    <section class="bg0 p-t-52 p-b-20">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-9 p-b-80">
                    <div class="p-r-45 p-r-0-lg">
                        <!--  -->
                        <div class="wrap-pic-w how-pos5-parent">
                            <img src="{{$blog->image}}" alt="IMG-BLOG">

                            <div class="flex-col-c-m size-123 bg9 how-pos5">
                                <span class="ltext-107 cl2 txt-center">
                                    22
                                </span>

                                <span class="stext-109 cl3 txt-center">
                                    Jan 2018
                                </span>
                            </div>
                        </div>

                        <div class="p-t-32">
                            <span class="flex-w flex-m stext-111 cl2 p-b-19">
                                <span>
                                    <span class="cl4">By</span> Admin
                                    <span class="cl12 m-l-4 m-r-6">|</span>
                                </span>

                                <span>
                                    22 Jan, 2018
                                    <span class="cl12 m-l-4 m-r-6">|</span>
                                </span>

                                <span>
                                    StreetStyle, Fashion, Couple
                                    <span class="cl12 m-l-4 m-r-6">|</span>
                                </span>

                                <span>
                                    8 Comments
                                </span>
                            </span>

                            <h4 class="ltext-109 cl2 p-b-28">
                                {{$blog->title}}
                            </h4>

                            <p class="stext-117 cl6 p-b-26">
                                {{$blog->description}}
                            </p>

                            <p class="stext-117 cl6 p-b-26">
                                {{$blog->content}}
                            </p>
                        </div>

                        <div class="flex-w flex-t p-t-16">
                            <span class="size-216 stext-116 cl8 p-t-4">
                                Tags
                            </span>

                            <div class="flex-w size-217">
                                <a href="#"
                                   class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                    Streetstyle
                                </a>

                                <a href="#"
                                   class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                    Crafts
                                </a>
                            </div>
                        </div>

                        <!--  -->
                        <div class="p-t-40">
                            <h5 class="mtext-113 cl2 p-b-12">
                                Comment
                            </h5>
                            <div style="overflow-wrap: break-word;" data-id="{{$blog->id}}" id="show_comment"
                                 id="comment">
                                @include('frontend.products.comment')
                            </div>

                        </div>
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

                        <div class="p-t-55">
                            <h4 class="mtext-112 cl2 p-b-20">
                                Archive
                            </h4>

                            <ul>
                                <li class="p-b-7">
                                    <a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
                                        <span>
                                            July 2018
                                        </span>

                                        <span>
                                            (9)
                                        </span>
                                    </a>
                                </li>

                                <li class="p-b-7">
                                    <a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
                                        <span>
                                            June 2018
                                        </span>

                                        <span>
                                            (39)
                                        </span>
                                    </a>
                                </li>

                                <li class="p-b-7">
                                    <a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
                                        <span>
                                            May 2018
                                        </span>

                                        <span>
                                            (29)
                                        </span>
                                    </a>
                                </li>

                                <li class="p-b-7">
                                    <a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
                                        <span>
                                            April 2018
                                        </span>

                                        <span>
                                            (35)
                                        </span>
                                    </a>
                                </li>

                                <li class="p-b-7">
                                    <a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
                                        <span>
                                            March 2018
                                        </span>

                                        <span>
                                            (22)
                                        </span>
                                    </a>
                                </li>

                                <li class="p-b-7">
                                    <a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
                                        <span>
                                            February 2018
                                        </span>

                                        <span>
                                            (32)
                                        </span>
                                    </a>
                                </li>

                                <li class="p-b-7">
                                    <a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
                                        <span>
                                            January 2018
                                        </span>

                                        <span>
                                            (21)
                                        </span>
                                    </a>
                                </li>

                                <li class="p-b-7">
                                    <a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
                                        <span>
                                            December 2017
                                        </span>

                                        <span>
                                            (26)
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="p-t-65">
                            <h5 class="mtext-113 cl2 p-b-12">
                                Leave a Comment
                            </h5>

                            <p class="stext-107 cl6 p-b-40">
                                Your email address will not be published. Required fields are marked *
                            </p>

                            <form id="form-comment">
                                <div class="bor19">
                                    <textarea class="content-comment stext-111 cl2 plh3 size-124 p-lr-18 p-tb-15"
                                              name="comment"
                                              placeholder="Comment..."></textarea>
                                </div>
                                <span class="text-danger error-text comment_error1"></span>

                                <div class="bor19 size-218 m-t-20">
                                    <input class="name-comment stext-111 cl2 plh3 size-116 p-lr-18" type="text"
                                           name="name"
                                           placeholder="Name *">
                                </div>
                                <span class="text-danger error-text name_error1"></span>


                                <div class="bor19 size-218 m-t-20 ">
                                    <input class="email-comment stext-111 cl2 plh3 size-116 p-lr-18" type="text"
                                           name="email"
                                           placeholder="Email *">
                                    <input type="hidden" name="id" value="{{$blog->id}}">
                                </div>
                                <span class="text-danger error-text email_error1"></span>


                                <button data-url="{{route('add-comment')}}"
                                        data-id="{{$blog->id}}"
                                        class="post_comment flex-c-m stext-101 cl0 size-125 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-t-20">
                                    Post Comment
                                </button>
                            </form>
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