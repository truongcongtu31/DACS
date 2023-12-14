<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Star Admin2 </title>
    <!-- plugins:css -->
    <base href="/">
    <link rel="stylesheet" href="{{asset('backend/vendors/feather/feather.css')}}">
    <link rel="stylesheet" href="{{asset('/backend/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend/vendors/ti-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('/backend/vendors/typicons/typicons.css')}}">
    <link rel="stylesheet" href="{{asset('/backend/vendors/simple-line-icons/css/simple-line-icons.css')}}">
    <link rel="stylesheet" href="{{asset('/backend/vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet"
          href="{{asset('backend/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/js/select.dataTables.min.css')}}">


    <link rel="stylesheet" href="{{asset('/backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">


    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('/backend/css/vertical-layout-light/style.css')}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{asset('/backend/images/favicon.png')}}"/>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        a {
            text-transform: none !important;
        }
    </style>
</head>

<body>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
            <div class="me-3">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-bs-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>
            </div>
            <div>
                <a class="navbar-brand brand-logo" href="{{route('homeAdmin')}}">
                    <img src="/backend/images/logo.svg" alt="logo"/>
                </a>
                <a class="navbar-brand brand-logo-mini" href="{{route('homeAdmin')}}">
                    <img src="/backend/images/logo-mini.svg" alt="logo"/>
                </a>
            </div>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-top">
            <ul class="navbar-nav">
                <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                    <h1 class="welcome-text">Good Morning, <span
                            class="text-black fw-bold">{{Auth::user()->name}}</span></h1>
                    <h3 class="welcome-sub-text">Your performance summary this week </h3>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                @yield('search')
                <li class="nav-item dropdown">
                    <a class="nav-link count-indicator" id="notificationDropdown" href="#"
                       data-bs-toggle="dropdown">
                        <i class="icon-mail icon-lg"></i>
                    </a>

                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link count-indicator" id="countDropdown" href="#" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <i class="icon-bell"></i>
                        <span class="count"></span>
                    </a>

                </li>
                <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                    <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <img class="img-xs rounded-circle" src="/backend/images/faces/face8.jpg"
                             alt="Profile image"> </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                        <div class="dropdown-header text-center">
                            <img class="img-md rounded-circle" src="/backend/images/faces/face8.jpg"
                                 alt="Profile image">
                            <p class="mb-1 mt-3 font-weight-semibold">
                                @if(Auth::user()->role === "admin" )
                                    {{Auth::user()->name}}
                                @endif
                            </p>
                            <p class="fw-light text-muted mb-0">
                                @if(Auth::user()->role === "admin" )
                                    {{Auth::user()->email}}
                                @endif</p>
                        </div>
                        <a href="{{route('profile.edit')}}" class="dropdown-item"><i
                                class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile
                            <span class="badge badge-pill badge-danger">1</span></a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item"><i
                                    class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>
                                Logout
                            </button>
                        </form>

                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-bs-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_settings-panel.html -->
        <div class="theme-setting-wrapper">
            <div id="settings-trigger"><i class="ti-settings"></i></div>
            <div id="theme-settings" class="settings-panel">
                <i class="settings-close ti-close"></i>
                <p class="settings-heading">SIDEBAR SKINS</p>
                <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                    <div class="img-ss rounded-circle bg-light border me-3"></div>
                    Light
                </div>
                <div class="sidebar-bg-options" id="sidebar-dark-theme">
                    <div class="img-ss rounded-circle bg-dark border me-3"></div>
                    Dark
                </div>
                <p class="settings-heading mt-2">HEADER SKINS</p>
                <div class="color-tiles mx-0 px-4">
                    <div class="tiles success"></div>
                    <div class="tiles warning"></div>
                    <div class="tiles danger"></div>
                    <div class="tiles info"></div>
                    <div class="tiles dark"></div>
                    <div class="tiles default"></div>
                </div>
            </div>
        </div>
        <div id="right-sidebar" class="settings-panel">
            <i class="settings-close ti-close"></i>
            <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="todo-tab" data-bs-toggle="tab" href="#todo-section"
                       role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="chats-tab" data-bs-toggle="tab" href="#chats-section"
                       role="tab" aria-controls="chats-section">CHATS</a>
                </li>
            </ul>
            <div class="tab-content" id="setting-content">
                <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel"
                     aria-labelledby="todo-section">
                    <div class="add-items d-flex px-3 mb-0">
                        <form class="form w-100">
                            <div class="form-group d-flex">
                                <input type="text" class="form-control todo-list-input"
                                       placeholder="Add To-do">
                                <button type="submit" class="add btn btn-primary todo-list-add-btn"
                                        id="add-task">Add
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="list-wrapper px-3">
                        <ul class="d-flex flex-column-reverse todo-list">
                            <li>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="checkbox" type="checkbox">
                                        Team review meeting at 3.00 PM
                                    </label>
                                </div>
                                <i class="remove ti-close"></i>
                            </li>
                            <li>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="checkbox" type="checkbox">
                                        Prepare for presentation
                                    </label>
                                </div>
                                <i class="remove ti-close"></i>
                            </li>
                            <li>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="checkbox" type="checkbox">
                                        Resolve all the low priority tickets due today
                                    </label>
                                </div>
                                <i class="remove ti-close"></i>
                            </li>
                            <li class="completed">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="checkbox" type="checkbox" checked>
                                        Schedule meeting for next week
                                    </label>
                                </div>
                                <i class="remove ti-close"></i>
                            </li>
                            <li class="completed">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="checkbox" type="checkbox" checked>
                                        Project review
                                    </label>
                                </div>
                                <i class="remove ti-close"></i>
                            </li>
                        </ul>
                    </div>
                    <h4 class="px-3 text-muted mt-5 fw-light mb-0">Events</h4>
                    <div class="events pt-4 px-3">
                        <div class="wrapper d-flex mb-2">
                            <i class="ti-control-record text-primary me-2"></i>
                            <span>Feb 11 2018</span>
                        </div>
                        <p class="mb-0 font-weight-thin text-gray">Creating component page build a js</p>
                        <p class="text-gray mb-0">The total number of sessions</p>
                    </div>
                    <div class="events pt-4 px-3">
                        <div class="wrapper d-flex mb-2">
                            <i class="ti-control-record text-primary me-2"></i>
                            <span>Feb 7 2018</span>
                        </div>
                        <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
                        <p class="text-gray mb-0 ">Call Sarah Graves</p>
                    </div>
                </div>
                <!-- To do section tab ends -->
                <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
                    <div class="d-flex align-items-center justify-content-between border-bottom">
                        <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
                        <small
                            class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 fw-normal">See
                            All</small>
                    </div>
                    <ul class="chat-list">
                        <li class="list active">
                            <div class="profile"><img src="/backend/images/faces/face1.jpg" alt="image"><span
                                    class="online"></span></div>
                            <div class="info">
                                <p>Thomas Douglas</p>
                                <p>Available</p>
                            </div>
                            <small class="text-muted my-auto">19 min</small>
                        </li>
                        <li class="list">
                            <div class="profile"><img src="/backend/images/faces/face2.jpg" alt="image"><span
                                    class="offline"></span></div>
                            <div class="info">
                                <div class="wrapper d-flex">
                                    <p>Catherine</p>
                                </div>
                                <p>Away</p>
                            </div>
                            <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                            <small class="text-muted my-auto">23 min</small>
                        </li>
                        <li class="list">
                            <div class="profile"><img src="/backend/images/faces/face3.jpg" alt="image"><span
                                    class="online"></span></div>
                            <div class="info">
                                <p>Daniel Russell</p>
                                <p>Available</p>
                            </div>
                            <small class="text-muted my-auto">14 min</small>
                        </li>
                        <li class="list">
                            <div class="profile"><img src="/backend/images/faces/face4.jpg" alt="image"><span
                                    class="offline"></span></div>
                            <div class="info">
                                <p>James Richardson</p>
                                <p>Away</p>
                            </div>
                            <small class="text-muted my-auto">2 min</small>
                        </li>
                        <li class="list">
                            <div class="profile"><img src="/backend/images/faces/face5.jpg" alt="image"><span
                                    class="online"></span></div>
                            <div class="info">
                                <p>Madeline Kennedy</p>
                                <p>Available</p>
                            </div>
                            <small class="text-muted my-auto">5 min</small>
                        </li>
                        <li class="list">
                            <div class="profile"><img src="/backend/images/faces/face6.jpg" alt="image"><span
                                    class="online"></span></div>
                            <div class="info">
                                <p>Sarah Graves</p>
                                <p>Available</p>
                            </div>
                            <small class="text-muted my-auto">47 min</small>
                        </li>
                    </ul>
                </div>
                <!-- chat tab ends -->
            </div>
        </div>
        <!-- partial -->
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('homeAdmin')}}">
                        <i class="mdi mdi-grid-large menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item nav-category">Manage</li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                       aria-controls="ui-basic">
                        <i class="menu-icon mdi mdi-floor-plan"></i>
                        <span class="menu-title">List</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="ui-basic">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link"
                                                    href="{{ route('listuser') }}">User</a></li>
                            <li class="nav-item"><a class="nav-link"
                                                    href="{{ route('listorder') }}">Order</a></li>
                            <li class="nav-item"><a class="nav-link"
                                                    href="{{ route('listproduct') }}">Product</a></li>
                            <li class="nav-item"><a class="nav-link"
                                                    href="{{ route('listcategory') }}">Category</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('listslide') }}">Slide</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('listbanner') }}">Banner</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('listmenu') }}">Menu</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('listblog') }}">Blog</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('listabout') }}">About</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('listcolor') }}">Color</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('listcomment') }}">Comment</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('listfeedback') }}">Feedback</a>
                            </li>


                        </ul>
                    </div>
                </li>

                <li class="nav-item nav-category">pages</li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false"
                       aria-controls="auth">
                        <i class="menu-icon mdi mdi-account-circle-outline"></i>
                        <span class="menu-title">User Pages</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="auth">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="pages/samples/login.html"> Login </a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>
        </nav>

        <!-- partial -->
        @yield('content')
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<script src="{{asset('/backend/vendors/js/vendor.bundle.base.js')}}"></script>
<script src="{{asset('/backend/vendors/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('/backend/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('/backend/vendors/progressbar.js/progressbar.min.js')}}"></script>
<script src="{{asset('/backend/js/off-canvas.js')}}"></script>
<script src="{{asset('/backend/js/hoverable-collapse.js')}}"></script>
<script src="{{asset('/backend/js/template.js')}}"></script>
<script src="{{asset('/backend/js/settings.js')}}"></script>
<script src="{{asset('/backend/js/todolist.js')}}"></script>
<script src="{{asset('/backend/js/dashboard.js')}}"></script>
<script src="{{asset('/backend/js/proBanner.js')}}"></script>
<script src="{{asset('/backend/js/Chart.roundedBarCharts.js')}}"></script>
<script src="{{asset('/backend/js/upload.js')}}"></script>

{{-- End Upload js --}}
@yield('js-custom')
</body>

</html>
