

@extends('layouts.app')


@section('content')

    <div id="page-container" class="sidebar-o side-scroll page-header-modern main-content-boxed">
        <!-- Side Overlay-->
        <aside id="side-overlay">
            <!-- Side Overlay Scroll Container -->
            <div id="side-overlay-scroll">
                <!-- Side Header -->
                <div class="content-header content-header-fullrow">
                    <div class="content-header-section align-parent">
                        <!-- Close Side Overlay -->
                        <!-- Layout API, functionality initialized in Codebase() -> uiApiLayout() -->
                        <button type="button" class="btn btn-circle btn-dual-secondary align-v-r" data-toggle="layout" data-action="side_overlay_close">
                            <i class="fa fa-times text-danger"></i>
                        </button>
                        <!-- END Close Side Overlay -->

                        <!-- User Info -->
                        <div class="content-header-item">
                            <a class="img-link mr-5" href="">
                                <img class="img-avatar img-avatar32" src="assets/img/avatars/avatar0.jpg" alt="">
                            </a>
                            <a class="align-middle link-effect text-primary-dark font-w600" href="">Admin</a>
                        </div>
                        <!-- END User Info -->
                    </div>
                </div>
                <!-- END Side Header -->

                <!-- Side Content -->
                <div class="content-side">
                    <!-- Search -->
                    <div class="block pull-t pull-r-l">
                        <div class="block-content block-content-full block-content-sm bg-body-light">
                            <form>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="side-overlay-search" name="side-overlay-search" placeholder="Search..">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-secondary px-10">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- END Search -->

                    <!-- Mini Stats -->
                    <div class="block pull-r-l">
                        <div class="block-content block-content-full block-content-sm bg-body-light">
                            <div class="row">
                                <div class="col-4">
                                    <div class="font-size-sm font-w600 text-uppercase text-muted">Stat</div>
                                    <div class="font-size-h4">100</div>
                                </div>
                                <div class="col-4">
                                    <div class="font-size-sm font-w600 text-uppercase text-muted">Stat</div>
                                    <div class="font-size-h4">200</div>
                                </div>
                                <div class="col-4">
                                    <div class="font-size-sm font-w600 text-uppercase text-muted">Stat</div>
                                    <div class="font-size-h4">300</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Mini Stats -->

                    <!-- Block -->
                    <div class="block pull-r-l">
                        <div class="block-header bg-body-light">
                            <h3 class="block-title">Title</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                    <i class="si si-refresh"></i>
                                </button>
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content">
                            <p>Content...</p>
                        </div>
                    </div>
                    <!-- END Block -->
                </div>
                <!-- END Side Content -->
            </div>
            <!-- END Side Overlay Scroll Container -->
        </aside>
        <!-- END Side Overlay -->

        <!-- Sidebar -->
        <!--
        Helper classes

        Adding .sidebar-mini-hide to an element will make it invisible (opacity: 0) when the sidebar is in mini mode
        Adding .sidebar-mini-show to an element will make it visible (opacity: 1) when the sidebar is in mini mode
        If you would like to disable the transition, just add the .sidebar-mini-notrans along with one of the previous 2 classes

        Adding .sidebar-mini-hidden to an element will hide it when the sidebar is in mini mode
        Adding .sidebar-mini-visible to an element will show it only when the sidebar is in mini mode
        - use .sidebar-mini-visible-b if you would like to be a block when visible (display: block)
    -->
    <nav id="sidebar">
        <!-- Sidebar Scroll Container -->
        <div id="sidebar-scroll">
            <!-- Sidebar Content -->
            <div class="sidebar-content">
                <!-- Side Header -->
                <div class="content-header content-header-fullrow px-15">
                    <!-- Mini Mode -->
                    <div class="content-header-section sidebar-mini-visible-b">
                        <!-- Logo -->
                        <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                            <span class="text-dual-primary-dark">c</span><span class="text-primary">b</span>
                        </span>
                        <!-- END Logo -->
                    </div>
                    <!-- END Mini Mode -->

                    <!-- Normal Mode -->
                    <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                        <!-- Close Sidebar, Visible only on mobile screens -->
                        <!-- Layout API, functionality initialized in Codebase() -> uiApiLayout() -->
                        <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                            <i class="fa fa-times text-danger"></i>
                        </button>
                        <!-- END Close Sidebar -->

                        <!-- Logo -->
                        <div class="content-header-item">
                            <a class="link-effect font-w700" href="">
                                <i class="si si-fire text-primary"></i>
                                <span class="font-size-xl text-dual-primary-dark">code</span><span class="font-size-xl text-primary">base</span>
                            </a>
                        </div>
                        <!-- END Logo -->
                    </div>
                    <!-- END Normal Mode -->
                </div>
                <!-- END Side Header -->

                <!-- Side User -->
                <div class="content-side content-side-full content-side-user px-10 align-parent">
                    <!-- Visible only in mini mode -->
                    <div class="sidebar-mini-visible-b align-v animated fadeIn">
                        <img class="img-avatar img-avatar32" src="assets/img/avatars/avatar0.jpg" alt="">
                    </div>
                    <!-- END Visible only in mini mode -->

                    <!-- Visible only in normal mode -->
                    <div class="sidebar-mini-hidden-b text-center">
                        <a class="img-link" href="">
                            <img class="img-avatar" src="assets/img/avatars/avatar0.jpg" alt="">
                        </a>
                        <ul class="list-inline mt-10">
                            <li class="list-inline-item">
                                <a class="link-effect text-dual-primary-dark font-size-xs font-w600 text-uppercase" href="">J. Smith</a>
                            </li>
                            <li class="list-inline-item">
                                <!-- Layout API, functionality initialized in Codebase() -> uiApiLayout() -->
                                <a class="link-effect text-dual-primary-dark" data-toggle="layout" data-action="sidebar_style_inverse_toggle" href="javascript:void(0)">
                                    <i class="si si-drop"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a class="link-effect text-dual-primary-dark" href="">
                                    <i class="si si-logout"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- END Visible only in normal mode -->
                </div>
                <!-- END Side User -->

                <!-- Side Navigation -->
                <div class="content-side content-side-full">
                    <ul class="nav-main">
                        <li>
                            <a class="active" href="">
                                <i class="si si-cup"></i>
                                <span class="sidebar-mini-hide">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-main-heading">
                            <span class="sidebar-mini-visible">HD</span>
                            <span class="sidebar-mini-hidden">Heading</span>
                        </li>
                        <li>
                            <a class="nav-submenu" data-toggle="nav-submenu" href="#">
                                <i class="si si-puzzle"></i>
                                <span class="sidebar-mini-hide">Dropdown</span>
                            </a>
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
                </div>
                <!-- END Side Navigation -->
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
                <!-- Toggle Sidebar -->
                <!-- Layout API, functionality initialized in Codebase() -> uiApiLayout() -->
                <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="sidebar_toggle">
                    <i class="fa fa-navicon"></i>
                </button>
                <!-- END Toggle Sidebar -->

                <!-- Open Search Section -->
                <!-- Layout API, functionality initialized in Codebase() -> uiApiLayout() -->
                <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="header_search_on">
                    <i class="fa fa-search"></i>
                </button>
                <!-- END Open Search Section -->

                <!-- Color Themes (used just for demonstration) -->
                <!-- Themes functionality initialized in Codebase() -> uiHandleTheme() -->
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-circle btn-dual-secondary" id="page-header-themes-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-paint-brush"></i>
                    </button>
                    <div class="dropdown-menu min-width-150" aria-labelledby="page-header-themes-dropdown">
                        <h6 class="dropdown-header text-center">Color Themes</h6>
                        <div class="row no-gutters text-center mb-5">
                            <div class="col-4 mb-5">
                                <a class="text-default" data-toggle="theme" data-theme="default" href="javascript:void(0)">
                                    <i class="fa fa-2x fa-circle"></i>
                                </a>
                            </div>
                            <div class="col-4 mb-5">
                                <a class="text-elegance" data-toggle="theme" data-theme="assets/css/themes/elegance.min.css" href="javascript:void(0)">
                                    <i class="fa fa-2x fa-circle"></i>
                                </a>
                            </div>
                            <div class="col-4 mb-5">
                                <a class="text-pulse" data-toggle="theme" data-theme="assets/css/themes/pulse.min.css" href="javascript:void(0)">
                                    <i class="fa fa-2x fa-circle"></i>
                                </a>
                            </div>
                            <div class="col-4 mb-5">
                                <a class="text-flat" data-toggle="theme" data-theme="assets/css/themes/flat.min.css" href="javascript:void(0)">
                                    <i class="fa fa-2x fa-circle"></i>
                                </a>
                            </div>
                            <div class="col-4 mb-5">
                                <a class="text-corporate" data-toggle="theme" data-theme="assets/css/themes/corporate.min.css" href="javascript:void(0)">
                                    <i class="fa fa-2x fa-circle"></i>
                                </a>
                            </div>
                            <div class="col-4 mb-5">
                                <a class="text-earth" data-toggle="theme" data-theme="assets/css/themes/earth.min.css" href="javascript:void(0)">
                                    <i class="fa fa-2x fa-circle"></i>
                                </a>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <button type="button" class="btn btn-sm btn-block btn-alt-secondary mb-10" data-toggle="layout" data-action="sidebar_style_inverse_toggle">Sidebar Style</button>
                    </div>
                </div>
                <!-- END Color Themes -->
            </div>
            <!-- END Left Section -->

            <!-- Right Section -->
            <div class="content-header-section">
                <!-- User Dropdown -->
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        J. Smith<i class="fa fa-angle-down ml-5"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right min-width-150" aria-labelledby="page-header-user-dropdown">
                        <a class="dropdown-item" href="">
                            <i class="si si-user mr-5"></i> Profile
                        </a>
                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="">
                            <span><i class="si si-envelope-open mr-5"></i> Inbox</span>
                            <span class="badge badge-primary">3</span>
                        </a>
                        <a class="dropdown-item" href="">
                            <i class="si si-note mr-5"></i> Invoices
                        </a>
                        <div class="dropdown-divider"></div>

                        <!-- Toggle Side Overlay -->
                        <!-- Layout API, functionality initialized in Codebase() -> uiApiLayout() -->
                        <a class="dropdown-item" href="javascript:void(0)" data-toggle="layout" data-action="side_overlay_toggle">
                            <i class="si si-wrench mr-5"></i> Settings
                        </a>
                        <!-- END Side Overlay -->

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="">
                            <i class="si si-logout mr-5"></i> Sign Out
                        </a>
                    </div>
                </div>
                <!-- END User Dropdown -->

                <!-- Toggle Side Overlay -->
                <!-- Layout API, functionality initialized in Codebase() -> uiApiLayout() -->
                <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="side_overlay_toggle">
                    <i class="fa fa-tasks"></i>
                </button>
                <!-- END Toggle Side Overlay -->
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
        <!-- Page Content -->
        <div class="content">
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Blank <small>Get Started</small></h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="pinned_toggle">
                            <i class="si si-pin"></i>
                        </button>
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <p>Create your own awesome project!</p>
                </div>
            </div>
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->

    <!-- Footer -->
    <footer id="page-footer" class="opacity-0">
        <div class="content py-20 font-size-xs clearfix">
            <div class="float-right">
                <a class="font-w600" href="https://goo.gl/po9Usv" target="_blank">Codebase</a> &copy; <span class="js-year-copy"></span>
            </div>
            <div class="float-left">

            </div>
        </div>
    </footer>
    <!-- END Footer -->
</div>

@endsection
