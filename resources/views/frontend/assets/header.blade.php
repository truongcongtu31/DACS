<!-- Header -->
<header class="header-v4">
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
                            <a onclick="none" href="{{ route('profile.edit') }}" class="flex-c-m trans-04 p-lr-25">
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
                                Login
                            </a>
                        @endauth
                    @endif


                </div>
            </div>
        </div>

        <div class="wrap-menu-desktop how-shadow1">
            <nav class="limiter-menu-desktop container">

                <!-- Logo desktop -->
                <a href="{{ route('home') }}" class="logo">
                    <img src="images/icons/logo-01.png" alt="IMG-LOGO">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        @foreach ($menus as $value )
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
                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
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

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->
        <div class="logo-mobile">
            <a href="index.html"><img src="images/icons/logo-01.png" alt="IMG-LOGO"></a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m m-r-15">
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                <i class="zmdi zmdi-search"></i>
            </div>

            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
                 data-notify="2">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>

            <a href="#"
               class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti"
               data-notify="0">
                <i class="zmdi zmdi-favorite-outline"></i>
            </a>
        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
			<span class="hamburger-box">
				<span class="hamburger-inner"></span>
			</span>
        </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="topbar-mobile">
            <li>
                <div class="left-top-bar">
                    Free shipping for standard order over $100
                </div>
            </li>

            <li>
                <div class="right-top-bar flex-w h-full">
                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        Help & FAQs
                    </a>

                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        My Account
                    </a>

                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        EN
                    </a>

                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        USD
                    </a>
                </div>
            </li>
        </ul>

        <ul class="main-menu-m">
            <li>
                <a href="{{ route('home') }}">Home</a>
                <span class="arrow-main-menu-m">
					<i class="fa fa-angle-right" aria-hidden="true"></i>
				</span>
            </li>

            <li>
                <a href="{{ route('shop') }}">Shop</a>
            </li>

            <li>
                <a href="{{ route('blog') }}">Blog</a>
            </li>

            <li>
                <a href="{{ route('about') }}">About</a>
            </li>

            <li>
                <a href="{{ route('contact') }}">Contact</a>
            </li>
        </ul>
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
