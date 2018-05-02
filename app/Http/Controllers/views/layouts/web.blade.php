<!DOCTYPE html>
<!--[if IE 9]>         <html class="ie9 no-focus" lang="es"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-focus" lang="es"> <!--<![endif]-->
<head>
    <meta charset="utf-8">

    <title>{{ config('app.name', 'Cognitivo') }}</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="description" content="Cognitivo Social B2B Platform">
    <meta name="author" content="Cognitivo Paraguay SA">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="{{ asset('img/favicons/favicon.png') }}">

    <link rel="icon" type="image/png" href="{{ asset('/img/favicons/favicon-16x16.png') }}" sizes="16x16">
    <link rel="icon" type="image/png" href="{{ asset('/img/favicons/favicon-32x32.png') }}" sizes="32x32">
    <link rel="icon" type="image/png" href="{{ asset('/img/favicons/favicon-96x96.png') }}" sizes="96x96">
    <link rel="icon" type="image/png" href="{{ asset('/img/favicons/favicon-160x160.png') }}" sizes="160x160">
    <link rel="icon" type="image/png" href="{{ asset('/img/favicons/favicon-192x192.png') }}" sizes="192x192">

    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('/img/favicons/apple-touch-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('/img/favicons/apple-touch-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('/img/favicons/apple-touch-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/img/favicons/apple-touch-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('/img/favicons/apple-touch-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('/img/favicons/apple-touch-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('/img/favicons/apple-touch-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('/img/favicons/apple-touch-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/img/favicons/apple-touch-icon-180x180.png') }}">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Web fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap and OneUI CSS framework -->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('/css/oneui.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/custom.min.css')}}">

    <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
    <!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/flat.min.css"> -->
    <!-- END Stylesheets -->

</head>

<body class="enable-cookies header-navbar-fixed">
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
    <div id="page-container" class="sidebar-l side-scroll header-navbar-fixed">

        <!-- Header -->
        <header id="header-navbar">
            <div class="content-mini content-mini-full content-boxed">
                <!-- Header Navigation Right -->
                <ul class="nav-header pull-right">
                    <li class="visible-xs">
                        <button class="btn btn-default" data-toggle="class-toggle" data-target=".js-header-search" data-class="header-search-xs-visible" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </li>
                    <li class="js-header-search header-search remove-margin">
                        <form action="{{ route('search.profiles') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-material form-material-primary input-group remove-margin-t remove-margin-b">
                                <input class="form-control" type="text" name="searchText" placeholder="Search...">
                                <span class="input-group-addon">
                                    <i class="si si-magnifier"></i>
                                </span>
                            </div>
                        </form>
                    </li>
                    @if (Auth::check())
                        @include('layouts.session')
                    @else
                        <li>
                            <a href="{{ route('login') }}">
                                Login
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}">
                                Register
                            </a>
                        </li>
                    @endif
                </ul>
                <!-- END Header Navigation Right -->

                <div class="visible-xs pull-left">
                    <div class="content-mini content-boxed">
                        <button class="btn btn-block btn-default visible-xs push" data-toggle="collapse" data-target="#sub-header-nav">
                            <i class="fa fa-navicon push-5-r"></i> Menu
                        </button>
                    </div>
                </div>
                <div class="collapse navbar-collapse remove-padding pull-left" id="sub-header-nav">
                    <div class="">
                        <ul class="nav nav-pills nav-sub-header push">
                            <li>
                                {{-- <img src="/img/cognitivo/logo64.svg" alt="Cognitivo Logo" width="40"> --}}
                            </li>
                            @if (Auth::check())
                                <li>
                                    <a href="{{ route('profile.show', Auth::user()->profile) }}">
                                        <i class="si si-user push-5-r"></i>
                                    </a>
                                </li>

                                <li>
                                    <a href="">
                                        <i class="si si-envelope push-5-r"></i>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('news') }}">
                                        <i class="fa fa-newspaper-o push-5-r"></i>News
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('market.index') }}">
                                        <i class="si si-globe push-5-r"></i>Market
                                    </a>
                                </li>
                                @if (request()->route('profile'))
                                    <li>
                                        <a href="{{ route('portal.show', request()->route('profile')) }}">
                                            <i class="si si-rocket push-5-r"></i>Portal
                                        </a>
                                    </li>
                                @endif
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <!-- END Header -->

        <!-- Main Container -->
        <main id="main-container">
            <!-- Page Content -->
            @yield('content')
            <!-- END Page Content -->
        </main>
        <!-- END Main Container -->

        <!-- Footer -->
        <footer id="page-footer" class="content-mini content-mini-full font-s12 bg-gray-lighter clearfix">
            <div class="pull-right">
                Crafted with <i class="fa fa-heart text-city"></i> by <a class="font-w600" href="http://www.cognitivo.in/cognitivo" target="_blank">Cognitivo</a>
            </div>
        </footer>
        <!-- END Footer -->
    </div>
</div>
<!-- END Page Container -->

<script src="{{ asset('js/oneui.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>




@yield('javascript')

</body>
</html>
