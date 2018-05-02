
<!DOCTYPE html>
<!--[if IE 9]>         <html class="ie9 no-focus" lang="es"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-focus" lang="es"> <!--<![endif]-->
<head>
    <meta charset="utf-8">

    <title>{{ config('app.name', 'Cognitivo') }}</title>

    <meta name="description" content="Cognitivo, B2B made easy">
    <meta name="author" content="Cognitivo Paraguay SA">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="{{ asset('img/favicons/favicon.png') }}">

    <link rel="icon" type="image/png" href="{{ asset('img/favicons/favicon-16x16.png') }}" sizes="16x16">
    <link rel="icon" type="image/png" href="{{ asset('img/favicons/favicon-32x32.png') }}" sizes="32x32">
    <link rel="icon" type="image/png" href="{{ asset('img/favicons/favicon-96x96.png') }}" sizes="96x96">
    <link rel="icon" type="image/png" href="{{ asset('img/favicons/favicon-160x160.png') }}" sizes="160x160">
    <link rel="icon" type="image/png" href="{{ asset('img/favicons/favicon-192x192.png') }}" sizes="192x192">

    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('img/favicons/apple-touch-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('img/favicons/apple-touch-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('img/favicons/apple-touch-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/favicons/apple-touch-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('img/favicons/apple-touch-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('img/favicons/apple-touch-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('img/favicons/apple-touch-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('img/favicons/apple-touch-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicons/apple-touch-icon-180x180.png') }}">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Web fonts -->
    {{-- <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Page JS Plugins CSS go here -->

    <!-- Bootstrap and OneUI CSS framework -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('css/oneui.min.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('css/custom.min.css') }}">
    <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
    <!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/flat.min.css"> -->
    <!-- END Stylesheets -->
</head>
<body class="enable-cookies">
    <!-- Page Container -->
    <!--
    Available Classes:

    'enable-cookies'             Remembers active color theme between pages (when set through color theme list)

    'sidebar-l'                  Left Sidebar and right Side Overlay
    'sidebar-r'                  Right Sidebar and left Side Overlay
    'sidebar-mini'               Mini hoverable Sidebar (> 991px)
    'sidebar-o'                  Visible Sidebar by default (> 991px)
    'sidebar-o-xs'               Visible Sidebar by default (< 992px)

    'side-overlay-hover'         Hoverable Side Overlay (> 991px)
    'side-overlay-o'             Visible Side Overlay by default (> 991px)

    'side-scroll'                Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (> 991px)

    'header-navbar-fixed'        Enables fixed header
-->
<div id="app">
    <div id="page-container" class="sidebar-l sidebar-o side-scroll header-navbar-fixed">

        <!-- Sidebar -->
        <nav id="sidebar">
            <!-- Sidebar Scroll Container -->
            <div id="sidebar-scroll">
                <!-- Sidebar Content -->
                <!-- Adding .sidebar-mini-hide to an element will hide it when the sidebar is in mini mode -->
                <div class="sidebar-content">
                    <!-- Side Header -->
                    <div class="side-header side-content bg-white-op">
                        <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
                        <button class="btn btn-link text-gray pull-right hidden-md hidden-lg" type="button" data-toggle="layout" data-action="sidebar_close">
                            <i class="fa fa-times"></i>
                        </button>
                        <a class="h5 text-white" href="{{ route('home', request()->route('profile')) }}">
                            <img src="/img/cognitivo/logo64.svg" alt="Logo" height="24">
                            <span class="h5 font-w200 sidebar-mini-hide"> {{ mb_strimwidth(request()->route('profile')->alias, 0, 26, '...') }}</span>
                        </a>
                    </div>
                    <!-- END Side Header -->

                    <!-- Side Content -->
                    <div class="side-content side-content-full">
                        <ul class="nav-main">
                            <li>
                                <a class="active" href="{{ route('news', request()->route('profile')) }}"><i class="fa fa-newspaper-o"></i><span class="sidebar-mini-hide">News</span></a>
                            </li>
                            <li>
                                <a class="active" href="{{ route('store', request()->route('profile')) }}"><i class="si si-globe"></i><span class="sidebar-mini-hide">Markets</span></a>
                            </li>
                            <li>
                                <a class="active" href="{{ route('portal.show', [request()->route('profile')]) }}"><i class="si si-user"></i><span class="sidebar-mini-hide">Profile</span></a>
                            </li>
                            @if (request()->route('profile')->type == 2)
                                <li>
                                    <a class="active" href="{{ route('members.index', request()->route('profile')) }}"><i class="si si-users"></i><span class="sidebar-mini-hide">Team Members</span></a>
                                </li>
                            @endif

                            <li class="nav-main-heading"><span class="sidebar-mini-hide">Platforms</span></li>

                            @if (request()->route('profile')->type == 2)
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-rocket"></i><span class="sidebar-mini-hide">Sales</span></a>
                                    <ul>
                                        <li>
                                            <a href="#"><i class="si si-speedometer"></i>Dashboard</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('items.index', request()->route('profile')) }}"><i class="si si-grid"></i>Products &amp; Services</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('itemsglobal.index', request()->route('profile')) }}"><i class="si si-grid"></i>Global Products &amp; Services</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('customers.index', request()->route('profile')) }}"><i class="si si-users"></i>Customers</a>
                                        </li>
                                        <li>
                                            <a href="#" data-toggle="nav-submenu" class="nav-submenu"><i class="si si-directions"></i>Opportunities</a>
                                            <ul>
                                                <li>
                                                    <a href="{{ route('opportunities.index', request()->route('profile')) }}">List</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('pipelines.index', request()->route('profile')) }}">Pipeline</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="{{ route('carts.index', request()->route('profile')) }}"><i class="si si-basket-loaded"></i>Pending Orders</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('orders.index', request()->route('profile')) }}"><i class="si si-paper-plane"></i>Order Fulfillment</a>
                                        </li>
                                    </ul>
                                </li>

                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-wallet"></i><span class="sidebar-mini-hide">Finance</span></a>
                                    <ul>
                                        <li>
                                            <a href="#"><i class="si si-speedometer"></i>Dashboard</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="si si-doc"></i> Accounts &amp; Banks</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="si si-list"></i> Account Details</a>
                                        </li>
                                    </ul>
                                </li>

                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-grid"></i><span class="sidebar-mini-hide">Stock</span></a>
                                    <ul>
                                        <li>
                                            <a href="#"><i class="si si-speedometer"></i>Dashboard</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="si si-grid"></i> Products</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="si si-list"></i> Stock Levels</a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Header -->
        <header id="header-navbar" class="content-mini content-mini-full">
            <!-- Header Navigation Right -->

            <ul class="nav-header pull-right">
                @include('layouts.session')
            </ul>


            <!-- END Header Navigation Right -->

            <!-- Header Navigation Left -->
            <ul class="nav-header pull-left">
                <li class="hidden-md hidden-lg">
                    <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
                    <button class="btn btn-default" data-toggle="layout" data-action="sidebar_toggle" type="button">
                        <i class="fa fa-navicon"></i>
                    </button>
                </li>
                <li class="hidden-xs hidden-sm">
                    <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
                    <button class="btn btn-default" data-toggle="layout" data-action="sidebar_mini_toggle" type="button">
                        <i class="fa fa-ellipsis-v"></i>
                    </button>
                </li>
                <li class="visible-xs">
                    <!-- Toggle class helper (for .js-header-search below), functionality initialized in App() -> uiToggleClass() -->
                    <button class="btn btn-default" data-toggle="class-toggle" data-target=".js-header-search" data-class="header-search-xs-visible" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </li>
                <li class="js-header-search header-search">
                    <form class="form-horizontal" action="#" method="post">
                        <div class="form-material form-material-primary input-group remove-margin-t remove-margin-b">
                            <input class="form-control" type="text" id="base-material-text" name="base-material-text" placeholder="Buscar...">
                            <span class="input-group-addon"><i class="si si-magnifier"></i></span>
                        </div>
                    </form>
                </li>
            </ul>
            <!-- END Header Navigation Left -->
        </header>
        <!-- END Header -->

        <main id="main-container">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer id="page-footer" class="content-mini content-mini-full font-s12 bg-gray-lighter clearfix">
            <div class="pull-right">
                Crafted with <i class="fa fa-heart text-city"></i> by <a class="font-w600" href="http://www.cognitivo.in/cognitivo" target="_blank">Cognitivo</a>
            </div>
            <div class="pull-left">
                <a class="font-w600" href="http://www.cognitivo.in/cognitivo" target="_blank">Cognitivo Paraguay SA</a> &copy; <span class="js-year-copy"></span>
            </div>
            <div class="pull-left">
                <ul>
                    <li>Hi</li>
                </ul>
            </div>
        </footer>
        <!-- END Footer -->

    </div>
</div>
<!-- END Page Container -->

<script src="{{ asset('js/oneui.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>

{{-- <script src="{{ asset('js/vue/cart.js') }}"></script> --}}
@yield('javascript')

<!-- Page JS Plugins + Page JS Code -->
</body>
</html>
