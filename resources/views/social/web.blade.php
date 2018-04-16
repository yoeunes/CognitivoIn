
@extends('layouts.app')

@section('main')

    <div id="page-container" class="sidebar-inverse side-scroll page-header-fixed page-header-glass page-header-inverse main-content-boxed">
        <!-- Sidebar -->
        <nav id="sidebar">
            <!-- Sidebar Scroll Container -->
            <div id="sidebar-scroll">
                <!-- Sidebar Content -->
                <div class="sidebar-content">
                    <!-- Side Header -->
                    <div class="content-header content-header-fullrow bg-black-op-10">
                        <div class="content-header-section text-center align-parent">
                            <!-- Close Sidebar, Visible only on mobile screens -->
                            <!-- Layout API, functionality initialized in Codebase() -> uiApiLayout() -->
                            <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                                <i class="fa fa-times text-danger"></i>
                            </button>
                            <!-- END Close Sidebar -->

                            <!-- Logo -->
                            <div class="content-header-item">
                                <a class="link-effect font-w700" href="">
                                    <img src="/img/logo/cognitivo-64.svg" width="32" alt="">
                                    {{-- <span class="font-size-xl text-dual-primary-dark">code</span><span class="font-size-xl text-primary">base</span> --}}
                                </a>
                            </div>
                            <!-- END Logo -->
                        </div>
                    </div>
                    <!-- END Side Header -->

                    <!-- Side Main Navigation -->
                    <div class="content-side content-side-full">
                        <!--
                        Mobile navigation, desktop navigation can be found in #page-header

                        If you would like to use the same navigation in both mobiles and desktops, you can use exactly the same markup inside sidebar and header navigation ul lists
                    -->
                    <ul class="nav-main">
                        <li>
                            <a class="active" href="">
                                <i class="si si-home"></i>Home
                        </li>
                        <li class="nav-main-heading">Heading</li>
                        <li>
                            <a class="nav-submenu" data-toggle="nav-submenu" href="#">
                                <i class="si si-puzzle"></i>Dropdown
                            </a>
                            <ul>
                                <li>
                                    <a href="javascript:void(0)">Link #1</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Link #2</a>
                                </li>
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#">Dropdown</a>
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)">Link #1</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">Link #2</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-main-heading">Vital</li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="si si-wrench"></i>Page
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="si si-wrench"></i>Page
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="si si-wrench"></i>Page
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- END Side Main Navigation -->
            </div>
            <!-- Sidebar Content -->
        </div>
        <!-- END Sidebar Scroll Container -->
    </nav>
    <!-- END Sidebar -->

    <!-- Header -->
    <header id="page-header">
        <!-- Header Content -->
        <div class="content-header">
            <!-- Left Section -->
            <div class="content-header-section">
                <!-- Logo -->
                <div class="content-header-item">
                    <a class="link-effect font-w700 mr-5" href="">
                        <img src="/img/logo/cognitivo-64.svg" width="32" alt="">
                        {{-- <span class="font-size-xl text-dual-primary-dark">code</span><span class="font-size-xl text-primary">base</span> --}}
                    </a>
                </div>
                <!-- END Logo -->
            </div>
            <!-- END Left Section -->

            <!-- Right Section -->
            <div class="content-header-section">
                <!-- Header Navigation -->
                <!--
                Desktop Navigation, mobile navigation can be found in #sidebar

                If you would like to use the same navigation in both mobiles and desktops, you can use exactly the same markup inside sidebar and header navigation ul lists
                If your sidebar menu includes headings, they won't be visible in your header navigation by default
                If your sidebar menu includes icons and you would like to hide them, you can add the class 'nav-main-header-no-icons'
            -->
            <ul class="nav-main-header nav-main-header-no-icons">
                <li>
                    <a class="active" href="">
                        <i class="si si-home"></i>Home
                    </a>
                </li>
                <li class="nav-main-heading">Heading</li>
                <li>
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#">
                        <i class="si si-puzzle"></i>Dropdown
                    </a>
                    <ul>
                        <li>
                            <a href="javascript:void(0)">Link #1</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Link #2</a>
                        </li>
                        <li>
                            <a class="nav-submenu" data-toggle="nav-submenu" href="#">Dropdown</a>
                            <ul>
                                <li>
                                    <a href="javascript:void(0)">Link #1</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Link #2</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-heading">Vital</li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="si si-wrench"></i>Page
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="si si-wrench"></i>Page
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="si si-wrench"></i>Page
                    </a>
                </li>
            </ul>
            <!-- END Header Navigation -->

            <!-- Open Search Section -->
            <!-- Layout API, functionality initialized in Codebase() -> uiApiLayout() -->
            <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="header_search_on">
                <i class="fa fa-search"></i>
            </button>
            <!-- END Open Search Section -->

            <!-- Toggle Sidebar -->
            <!-- Layout API, functionality initialized in Codebase() -> uiApiLayout() -->
            <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
                <i class="fa fa-navicon"></i>
            </button>
            <!-- END Toggle Sidebar -->
        </div>
        <!-- END Right Section -->
    </div>
    <!-- END Header Content -->

    <!-- Header Search -->
    <div id="page-header-search" class="overlay-header">
        <div class="content-header content-header-fullrow">
            <form>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <!-- Close Search Section -->
                        <!-- Layout API, functionality initialized in Codebase() -> uiApiLayout() -->
                        <button type="button" class="btn btn-secondary px-15" data-toggle="layout" data-action="header_search_off">
                            <i class="fa fa-times"></i>
                        </button>
                        <!-- END Close Search Section -->
                    </div>
                    <input type="text" class="form-control" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-secondary px-15">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END Header Search -->

    <!-- Header Loader -->
    <div id="page-header-loader" class="overlay-header bg-primary">
        <div class="content-header content-header-fullrow text-center">
            <div class="content-header-item">
                <i class="fa fa-sun-o fa-spin text-white"></i>
            </div>
        </div>
    </div>
    <!-- END Header Loader -->
    </header>
    <!-- END Header -->

    <!-- Main Container -->
    <main id="main-container">
        <!-- Hero -->
        <div class="bg-gd-primary overflow-hidden">
            <div class="hero bg-black-op-25">
                <div class="hero-inner">
                    <div class="content content-full text-center">
                        <h1 class="display-3 font-w700 text-white mb-10 invisible" data-toggle="appear" data-class="animated fadeInDown">Hero {{ $profile ->name}}</h1>
                        <h2 class="font-w400 text-white-op mb-50 invisible" data-toggle="appear" data-class="animated fadeInDown">Hero Subtitle.</h2>
                        <a class="btn btn-hero btn-noborder btn-rounded btn-success mr-5 mb-10 invisible" data-toggle="appear" data-class="animated fadeInUp" href="javascript:void(0)">
                            <i class="fa fa-rocket mr-10"></i> Call to Action
                        </a>
                        <a class="btn btn-hero btn-noborder btn-rounded btn-primary mb-10 invisible" data-toggle="appear" data-class="animated fadeInUp" href="javascript:void(0)">
                            <i class="fa fa-rocket mr-10"></i> Call to Action
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        <!-- Content #1 -->
        <div class="bg-white">
            <div class="content content-full">
                <div class="py-50 text-center">
                    <h3 class="font-w700 mb-10">Title #1</h3>
                    <h4 class="font-w400 text-muted mb-0">Content..</h4>
                </div>
            </div>
        </div>
        <!-- END Content #1 -->

        <!-- Content #2 -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="py-50 text-center">
                    <h3 class="font-w700 mb-10">Title #2</h3>
                    <h4 class="font-w400 text-muted mb-0">Content..</h4>
                </div>
            </div>
        </div>
        <!-- END Content #2 -->

        <!-- Content #3 -->
        <div class="bg-white">
            <div class="content content-full">
                <div class="py-50 text-center">
                    <h3 class="font-w700 mb-10">Title #3</h3>
                    <h4 class="font-w400 text-muted mb-0">Content..</h4>
                </div>
            </div>
        </div>
        <!-- END Content #3 -->

        <!-- Call to Action -->
        <div class="bg-body-light">
            <div class="content content-full text-center">
                <div class="py-50">
                    <h3 class="font-w700 mb-10">Title</h3>
                    <h4 class="font-w400 text-muted mb-30">Subtitle.</h4>
                    <a class="btn btn-hero btn-rounded btn-alt-primary" href="">Call to Action</a>
                </div>
            </div>
        </div>
        <!-- END Call to Action -->
    </main>
    <!-- END Main Container -->

    <!-- Footer -->
    <footer id="page-footer" class="bg-white opacity-0">
        <div class="content content-full">
            <!-- Footer Navigation -->
            <div class="row items-push-2x mt-30">
                <div class="col-6 col-md-4">
                    <h3 class="h5 font-w700">Heading</h3>
                    <ul class="list list-simple-mini font-size-sm">
                        <li>
                            <a class="link-effect font-w600" href="javascript:void(0)">Link #1</a>
                        </li>
                        <li>
                            <a class="link-effect font-w600" href="javascript:void(0)">Link #2</a>
                        </li>
                        <li>
                            <a class="link-effect font-w600" href="javascript:void(0)">Link #3</a>
                        </li>
                        <li>
                            <a class="link-effect font-w600" href="javascript:void(0)">Link #4</a>
                        </li>
                        <li>
                            <a class="link-effect font-w600" href="javascript:void(0)">Link #5</a>
                        </li>
                        <li>
                            <a class="link-effect font-w600" href="javascript:void(0)">Link #6</a>
                        </li>
                    </ul>
                </div>
                <div class="col-6 col-md-4">
                    <h3 class="h5 font-w700">Heading</h3>
                    <ul class="list list-simple-mini font-size-sm">
                        <li>
                            <a class="link-effect font-w600" href="javascript:void(0)">Link #1</a>
                        </li>
                        <li>
                            <a class="link-effect font-w600" href="javascript:void(0)">Link #2</a>
                        </li>
                        <li>
                            <a class="link-effect font-w600" href="javascript:void(0)">Link #3</a>
                        </li>
                        <li>
                            <a class="link-effect font-w600" href="javascript:void(0)">Link #4</a>
                        </li>
                        <li>
                            <a class="link-effect font-w600" href="javascript:void(0)">Link #5</a>
                        </li>
                        <li>
                            <a class="link-effect font-w600" href="javascript:void(0)">Link #6</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h3 class="h5 font-w700">Company LTD</h3>
                    <div class="font-size-sm mb-30">
                        1080 Sunshine Valley, Suite 2563<br>
                        San Francisco, CA 85214<br>
                        <abbr title="Phone">P:</abbr> (123) 456-7890
                    </div>
                    <h3 class="h5 font-w700">Our Newsletter</h3>
                    <form>
                        <div class="input-group">
                            <input type="email" class="form-control" id="ld-subscribe-email" name="ld-subscribe-email" placeholder="Your email..">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary">Subscribe</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END Footer Navigation -->

            <!-- Copyright Info -->
            <div class="font-size-xs clearfix border-t pt-20 pb-10">
                <div class="float-right">
                    <a class="font-w600" href="mailto:hola@cognitivo.in" target="_blank">Cognitivo</a> &copy; <span class="js-year-copy"></span>
                </div>
            </div>
            <!-- END Copyright Info -->
        </div>
    </footer>
    <!-- END Footer -->
    </div>

@endsection
