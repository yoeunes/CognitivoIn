@extends('layouts.app')

@section('main')
    <backend-nav inline-template>
        <div>
            {{-- <passport-clients></passport-clients>
            <passport-authorized-clients></passport-authorized-clients>
            <passport-personal-access-tokens></passport-personal-access-tokens> --}}
            <div id="page-container" class="side-scroll page-header-modern main-content-boxed side-trans-enabled sidebar-o">
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
                                    <a class="img-link mr-5" href="#">
                                        <img class="img-avatar img-avatar32" src="assets/img/avatars/avatar0.jpg" alt="">
                                    </a>
                                    <a class="align-middle link-effect text-primary-dark font-w600" href="#">Admin</a>
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
                                        <img src="/img/logo/cognitivo-64.svg" width="32" alt="">
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
                                        <a href="#">
                                            <img src="/img/logo/cognitivo-64.svg" width="36" alt="">
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
                                    <a class="img-link" href="#">
                                        <img class="img-avatar" src="{{ request()->route('profile')->avatar }}" alt="Logo">
                                    </a>
                                    <ul class="list-inline mt-10">
                                        <li class="list-inline-item">
                                            <a class="link-effect text-dual-primary-dark font-size-xs font-w600 text-uppercase" href="#">
                                                {{ request()->route('profile')->alias }}
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
                                        <a @click="Dashboard()" href="#">
                                            <i class="si si-pie-chart"></i>
                                            <span class="sidebar-mini-hide">Dashboard</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a @click="Profile()" href="#">
                                            <i class="si si-home"></i>
                                            <span class="sidebar-mini-hide">Company Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a @click="Stores()" href="#">
                                            <i class="si si-pointer"></i>
                                            <span class="sidebar-mini-hide">Shops &amp; Locations</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a @click="Items()" href="#">
                                            <i class="si si-diamond"></i>
                                            <span class="sidebar-mini-hide">Products & Services</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-heading">
                                        <span class="sidebar-mini-hidden">Modules</span>
                                    </li>
                                    <li>
                                        <a class="nav-submenu" data-toggle="nav-submenu" href="#">
                                            <i class="si si-paper-plane"></i>
                                            <span class="sidebar-mini-hide">Sales</span>
                                        </a>
                                        <ul>
                                            <li>
                                                <a @click="SalesDashboard()" href="#">Dashboard</a>
                                            </li>
                                            <li>
                                                <a @click="Customers()" href="#">Customers</a>
                                            </li>
                                            <li>
                                                <a  class="nav-submenu" data-toggle="nav-submenu" href="#">Opportunities</a>
                                                <ul>
                                                    <li>
                                                        <a @click="Pipeline()" href="#">Pipeline</a>
                                                    </li>
                                                    <li>
                                                        <a @click="PipelineStage()" href="#">Pipeline Stage</a>
                                                    </li>
                                                    <li>
                                                        <a @click="Opportunities()" href="#">Opportunity</a>
                                                    </li>

                                                </ul>
                                            </li>
                                            <li>
                                                <a @click="Orders()">Orders</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a class="nav-submenu" data-toggle="nav-submenu" href="#">
                                            <i class="si si-basket"></i>
                                            <span class="sidebar-mini-hide">Purchase</span>
                                        </a>
                                        <ul>
                                            <li>
                                                <a @click="PurchaseDashboard()" href="#">Dashboard</a>
                                            </li>
                                            <li>
                                                <a @click="Suppliers()" href="#">Suppliers</a>
                                            </li>
                                            <li>
                                                <a @click="Purchases()" href="#">Purchases</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a class="nav-submenu" data-toggle="nav-submenu" href="#">
                                            <i class="si si-puzzle"></i>
                                            <span class="sidebar-mini-hide">Stock</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-submenu" data-toggle="nav-submenu" href="#">
                                            <i class="si si-wallet"></i>
                                            <span class="sidebar-mini-hide">Finance</span>
                                        </a>
                                        <ul>
                                            <li>
                                                <a @click="viewFinanceDashboard()" href="#">Dashboard</a>
                                            </li>
                                            <li>
                                                <a @click="" href="#">Accounts</a>
                                            </li>
                                            <li>
                                                <a @click="" href="#">Account Recievables</a>
                                            </li>
                                            <li>
                                                <a @click="" href="#">Account Payables</a>
                                            </li>
                                            <li>
                                                <a @click="" href="#">Account Movements</a>
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

                        </div>
                        <!-- END Left Section -->

                        <!-- Right Section -->
                        <div class="content-header-section">
                            <!-- User Dropdown -->
                            <div class="btn-group" role="group">

                                @php
                                $listOfCompanies = App\Profile::GetProfiles()->where('type', 2)->get();
                                @endphp

                                <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->profile->name }}<i class="fa fa-angle-down ml-5"></i>
                                </button>

                                <div id="dropdown" class="dropdown-menu dropdown-menu-right min-width-150 show" aria-labelledby="page-header-user-dropdown">
                                    <a class="dropdown-item" href="#">
                                        <i class="si si-user mr-5"></i> Profile
                                    </a>

                                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="#">
                                        <span><i class="si si-envelope-open mr-5"></i> Messages</span>
                                        <span class="badge badge-primary pull-right">3</span>
                                    </a>

                                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="#">
                                        <span><i class="si si-globe mr-5"></i> Market</span>
                                    </a>

                                    {{-- <a class="dropdown-item" href="#">
                                        <i class="si si-note mr-5"></i> Invoices
                                    </a> --}}

                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item" href="{{ route('profile.create') }}">
                                        <span class="text-primary">
                                            <i class="si si-plus"></i> Create Company
                                        </span>
                                    </a>

                                    @isset($listOfCompanies)
                                        @if ($listOfCompanies->count() > 0)
                                            @foreach ($listOfCompanies->sortBy('alias') as $company)
                                                <a class="dropdown-item" href="{{ route('home', $company)}}">
                                                    @if (request()->route('profile')->id == $company->id)
                                                        <i class="si si-check"></i> <b> {{ mb_strimwidth($company->alias, 0, 15, "...") }} </b>
                                                    @else
                                                        <i class="si si-briefcase"></i> {{ mb_strimwidth($company->alias, 0, 15, "...") }}
                                                    @endif
                                                </a>
                                            @endforeach
                                        @endif
                                    @endisset

                                    <!-- Toggle Side Overlay -->
                                    <!-- Layout API, functionality initialized in Codebase() -> uiApiLayout() -->
                                    {{-- <a class="dropdown-item" href="#" data-toggle="layout" data-action="side_overlay_toggle">
                                        <i class="si si-wrench mr-5"></i> Settings
                                    </a> --}}
                                    <!-- END Side Overlay -->

                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}">
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

                <div>

                    <div v-if="showItem===1">

                        @include('back_office/items')
                    </div>
                    <div v-else-if="showCustomer===1">

                        @include('back_office/customers')
                    </div>
                    <div v-else-if="showPipeline===1">

                        @include('back_office/pipeline')
                    </div>
                    <div v-else-if="showPipelineStage===1">

                        @include('back_office/pipelinestage')
                    </div>
                    <div v-else-if="showOpportunity===1">

                        @include('back_office/opportunity')
                    </div>
                    <div v-else-if="showOrders===1">

                        @include('back_office/orders')
                    </div>

                </div>

                <!-- END Main Container -->

                <!-- Footer -->
                <footer id="page-footer" class="opacity-0">
                    <div class="content py-20 font-size-xs clearfix">
                        <div class="float-right">
                            <a class="font-w600" href="mailto:hola@cognitivo.in" target="_blank">Cognitivo</a> &copy; <span class="js-year-copy"></span>
                        </div>
                        <div class="float-left">
                        </div>
                    </div>
                </footer>
                <!-- END Footer -->
            </div>
        </div>
    </backend-nav>
@endsection
