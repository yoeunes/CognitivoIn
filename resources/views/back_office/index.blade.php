@extends('layouts.app')

@section('main')
    <model profile="{{ request()->route('profile')->slug }}" inline-template>
        {{-- main-content-boxed --}}
        <div id="page-container" class="sidebar-o page-header-glass page-header-inverse main-content-boxed side-trans-enabled">
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
                                    <img class="img-avatar img-avatar32" src="/img/avatars/avatar0.jpg" alt="">
                                </a>
                                <a class="align-middle link-effect text-primary-dark font-w600" href="#">{{ Auth::user()->profile->name }}</a>
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
                <div class="slimScrollDiv">
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
                            <div class="content-side content-side-full bg-body-light">
                                <!-- Visible only in mini mode -->
                                <div class="sidebar-mini-visible-b align-v animated fadeIn">
                                    <img class="img-avatar img-avatar32" src="/img/avatars/avatar0.jpg" alt="">
                                </div>
                                <!-- END Visible only in mini mode -->

                                <!-- Visible only in normal mode -->
                                <div class="sidebar-mini-hidden-b text-center">
                                    <a class="img-link" href="#">
                                        {{-- class="img-avatar" --}}
                                        <img src="{{ request()->route('profile')->avatar }}" onerror="this.src='/img/icons/briefcase.svg'" alt="Logo" width="64">
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
                                        <a @click="showModule = 1" href="#">
                                            <i class="si si-pie-chart"></i>
                                            <span class="sidebar-mini-hide">@lang('back-office.Dashboard')</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a class="nav-submenu" data-toggle="nav-submenu" href="#">
                                            <i class="si si-settings"></i>
                                            <span class="sidebar-mini-hide">@lang('global.Profile')</span>
                                        </a>
                                        <ul>
                                            <li>
                                                <a @click="showModule = 2.1" href="#">
                                                    <span class="sidebar-mini-hide">@lang('back-office.Company Profile')</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a @click="onList('locations', 2.2)" href="#">
                                                    <span class="sidebar-mini-hide">@lang('back-office.Shops and Locations')</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a @click="onList('followers', 2.3)" href="#">
                                                    <span class="sidebar-mini-hide">@lang('back-office.Teams and Followers')</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a @click="onList('contracts', 2.4)" href="#">
                                                    <span class="sidebar-mini-hide">@lang('back-office.Contracts')</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a @click="onList('vats', 2.5)" href="#">
                                                    <span class="sidebar-mini-hide">@lang('back-office.Sales Tax')</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li>
                                        <a @click="onList('items', 5.1)" href="#">
                                            <i class="si si-diamond"></i>
                                            <span class="sidebar-mini-hide">@lang('back-office.Products and Services')</span>
                                        </a>
                                    </li>

                                    <li class="nav-main-heading">
                                        <span class="sidebar-mini-hidden">@lang('back-office.Modules')</span>
                                    </li>

                                    <li>
                                        <a class="nav-submenu" data-toggle="nav-submenu" href="#">
                                            <i class="si si-paper-plane"></i>
                                            <span class="sidebar-mini-hide">@lang('back-office.Sales')</span>
                                        </a>
                                        <ul>
                                            <li>
                                                <a @click="showModule = '1.3'" href="#">@lang('back-office.Dashboard')</a>
                                            </li>
                                            <li>
                                                <a @click="onList('customers', 3.1)" href="#">@lang('back-office.Customers')</a>
                                            </li>
                                            <li>
                                                <a @click="onList('promotions', 3.5)" href="#">@lang('back-office.Promotions')</a>
                                            </li>
                                            <li>
                                                <a  class="nav-submenu" data-toggle="nav-submenu" href="#">@lang('back-office.Opportunities')</a>
                                                <ul>
                                                    <li>
                                                        <a @click="onList('pipelines', 3.3)" href="#">@lang('back-office.Pipelines')</a>
                                                    </li>
                                                    <li>
                                                        <a @click="onList('opportunities', 3.2)" href="#">@lang('back-office.Opportunities')</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a @click="onList('orders', 3.4)" href="#">@lang('back-office.Orders')</a>
                                            </li>
                                            <li>
                                                <a @click="onList('account-receivables', 6.2)" href="#">@lang('back-office.Account Receivables')</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a class="nav-submenu" data-toggle="nav-submenu" href="#">
                                            <i class="si si-basket"></i>
                                            <span class="sidebar-mini-hide">@lang('back-office.Purchases')</span>
                                        </a>
                                        <ul>
                                            <li>
                                                <a @click="showModule = '1.4'" href="#">@lang('back-office.Dashboard')</a>
                                            </li>
                                            <li>
                                                <a @click="onList('suppliers', 4.1)" href="#">@lang('back-office.Suppliers')</a>
                                            </li>
                                            <li>
                                                <a @click="onList('purchases', 4.2)" href="#">@lang('back-office.Orders')</a>
                                            </li>
                                            <li>
                                                <a @click="onList('account-payables', 6.3)" href="#">@lang('back-office.Account Payables')</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a class="nav-submenu" data-toggle="nav-submenu" href="#">
                                            <i class="si si-puzzle"></i>
                                            <span class="sidebar-mini-hide">@lang('back-office.Stock')</span>
                                        </a>
                                        <ul>
                                            <li>
                                                <a @click="showModule = '1.5'" href="#">@lang('back-office.Dashboard')</a>
                                            </li>
                                            <li>
                                                <a @click="onList('items', 5.1)" href="#">
                                                    <span class="sidebar-mini-hide">@lang('back-office.Products and Services')</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a @click="onList('stock', 5.2)" href="#">
                                                    <span class="sidebar-mini-hide">@lang('back-office.Stock Levels')</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a @click="onList('items', 5.3)" href="#">
                                                    <span class="sidebar-mini-hide">@lang('back-office.Movements')</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a @click="onList('items', 5.4)" href="#">
                                                    <span class="sidebar-mini-hide">@lang('back-office.Inventories')</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a class="nav-submenu" data-toggle="nav-submenu" href="#">
                                            <i class="si si-wallet"></i>
                                            <span class="sidebar-mini-hide">@lang('back-office.Finances')</span>
                                        </a>
                                        <ul>
                                            <li>
                                                <a @click="showModule = '1.6'" href="#">@lang('back-office.Dashboard')</a>
                                            </li>
                                            <li>
                                                <a @click="onList('accounts', 6.1)" href="#">@lang('back-office.Accounts')</a>
                                            </li>
                                            <li>
                                                <a @click="onList('accounts', 6.2)" href="#">@lang('back-office.Account Recievables')</a>
                                            </li>
                                            <li>
                                                <a @click="onList('accounts', 6.3)" href="#">@lang('back-office.Account Payables')</a>
                                            </li>
                                            <li>
                                                <a @click="onList('accounts', 6.4)" href="#">@lang('back-office.Account Movements')</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <!-- END Side Navigation -->
                        </div>
                        <!-- Sidebar Content -->
                    </div>
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

                            <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                {{ Auth::user()->profile->name }} <i class="fa fa-angle-down ml-5"></i>
                            </button>

                            <div class="dropdown-menu dropdown-menu-right min-width-150" aria-labelledby="page-header-user-dropdown" x-placement="bottom-end">
                                <a class="dropdown-item" href="#">
                                    <i class="si si-user mr-5"></i> @lang('global.Profile')
                                </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-between" href="#">
                                    <span><i class="si si-envelope-open mr-5"></i> Messages </span>
                                    <span class="badge badge-primary pull-right">3</span>
                                </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-between" href="#">
                                    <span><i class="si si-globe mr-5"></i> @lang('global.Market')</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('profile.create') }}">
                                    <span class="text-primary">
                                        <i class="si si-plus"></i> @lang('global.Create Company')
                                    </span>
                                </a>

                                @php
                                $listOfCompanies = Auth::user()->profile->followings(App\Profile::class)
                                ->where('role', '<', 4)
                                ->get();
                                @endphp

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

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}">
                                    <i class="si si-logout mr-5"></i> @lang('global.Log Out')Sign Out
                                </a>
                            </div>

                        </div>
                        <!-- END User Dropdown -->

                        <!-- Toggle Side Overlay -->
                        <!-- Layout API, functionality initialized in Codebase() -> uiApiLayout() -->
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-rounded btn-dual-secondary" data-toggle="layout" data-action="side_overlay_toggle">
                                {{ Auth::user()->profile->name }}
                                <i class="fa fa-angle-right ml-5"></i>
                            </button>
                        </div>
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
            <div v-if="showModule == '1'">
                @include('back_office/dashboard')
            </div>

            <div v-if="showModule == '2.1'">
                @include('back_office/configs/profile')
            </div>

            <div v-if="showModule == '2.3'">
                @include('back_office/configs/teams')
            </div>

            <div v-if="showModule == '2.2'">
                @include('back_office/configs/locations')
            </div>

            <div v-if="showModule == 2.4">
                @include('back_office/configs/contracts')
            </div>

            <div v-if="showModule == 2.5">
                @include('back_office/configs/vats')
            </div>

            <div v-if="showModule == '1.3'">
                @include('back_office/sales/dashboard')
            </div>

            <div v-if="showModule == 3.1">
                @include('back_office/sales/customers')
            </div>

            <div v-if="showModule == 3.3">
                @include('back_office/sales/pipeline')
            </div>

            <div v-if="showModule == 3.2">
                @include('back_office/sales/opportunity')
            </div>

            <div v-if="showModule == 3.4">
                @include('back_office/sales/orders')
            </div>

            <div v-if="showModule == 3.5">
                @include('back_office/sales/promotion')
            </div>

            <div v-if="showModule == '4.1'">
                @include('back_office/purchase/suppliers')
            </div>

            <div v-if="showModule == '1.4'">
                @include('back_office/purchase/dashboard')
            </div>

            <div v-if="showModule == '1.5'">
                @include('back_office/inventory/dashboard')
            </div>

            <div v-if="showModule == 5.1">
                @include('back_office/inventory/items')
            </div>

            <div v-if="showModule == 5.2">
                @include('back_office/inventory/items')
            </div>

            <div v-if="showModule == 5.3">
                @include('back_office/inventory/item_movements')
            </div>

            <div v-if="showModule == '1.6'">
                @include('back_office/finance/dashboard')
            </div>

            <div v-if="showModule == 6.1">
                @include('back_office/finance/accounts')
            </div>

            <div v-if="showModule == 6.2">
                @include('back_office/finance/account_receivables')
            </div>

            <div v-if="showModule == 6.3">
                @include('back_office/finance/account_payables')
            </div>

            <div v-if="showModule == 6.4">
                @include('back_office/finance/account_movements')
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
    </model>
@endsection
