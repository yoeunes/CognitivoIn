@extends('layouts.web')

@section('content')
    <div class="content content-boxed">
      @if (request()->route('profile')!=null)
        <input type="hidden" id="slug" value="{{request()->route('profile')->slug}}"/>
        <input type="hidden" id="slugid" value="{{request()->route('profile')->id}}"/>
      @endif

        <div class="bg-image img-rounded overflow-hidden push" style="background-image: url('/img/photos/photo29@2x.jpg');">
            <div class="bg-black-op">
                <div class="content">
                    <div class="block block-transparent block-themed text-center">
                        <div class="block-content">
                            @if (request()->route('profile'))
                                <h1 class="h1 font-w700 text-white animated fadeInDown push-5">{{ request()->route('profile')->name }} Dashboard</h1>

                            @else
                                <h1 class="h1 font-w700 text-white animated fadeInDown push-5">Dashboard</h1>
                            @endif
                            <h2 class="h4 font-w400 text-white-op animated fadeInUp">Welcome {{ Auth::user()->profile->name}}.</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row text-uppercase">
            <div class="col-xs-6 col-sm-3">
                <div class="block block-rounded">
                    <div class="block-content block-content-full">
                        <div class="text-muted">
                            <small><i class="si si-calendar"></i> Today</small>
                        </div>
                        <div class="font-s12 font-w700">Shop Visitors</div>
                        <a class="h2 font-w300 text-primary" href="bd_dashboard.php" data-toggle="countTo" data-to="0">0</a>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="block block-rounded">
                    <div class="block-content block-content-full">
                        <div class="text-muted">
                            <small><i class="si si-calendar"></i> Today</small>
                        </div>
                        <div class="font-s12 font-w700">Items in Cart</div>
                        <a class="h2 font-w300 text-primary" href="bd_dashboard.php" data-toggle="countTo" data-to="0">0</a>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="block block-rounded">
                    <div class="block-content block-content-full">
                        <div class="text-muted">
                            <small><i class="si si-calendar"></i> Today</small>
                        </div>
                        <div class="font-s12 font-w700">Items Sold</div>
                        <a class="h2 font-w300 text-primary" href="bd_dashboard.php" data-toggle="countTo" data-to="0" data-before="$ ">$ 0</a>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3">
                <div class="block block-rounded">
                    <div class="block-content block-content-full">
                        <div class="text-muted">
                            <small><i class="si si-calendar"></i> Today</small>
                        </div>
                        <div class="font-s12 font-w700">Average Sale</div>
                        <a class="h2 font-w300 text-primary" href="bd_dashboard.php" data-toggle="countTo" data-to="0" data-before="$ ">$ 0</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="block block-rounded block-opt-refresh-icon8">
                    <div class="block-header">
                        <ul class="block-options">
                            <li>
                                <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                            </li>
                        </ul>
                        <h3 class="block-title">Quantity per Month</h3>
                    </div>
                    <div class="block-content block-content-full bg-gray-lighter text-center">
                        <div style="height: 320px;">
                            <router-view name="VolumePerday" style="width: 555px; height: 320px;"></router-view>
                        </div>
                    </div>
                    <div class="block-content text-center">

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="block block-rounded block-opt-refresh-icon8">
                    <div class="block-header">
                        <ul class="block-options">
                            <li>
                                <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                            </li>
                        </ul>
                        <h3 class="block-title">Quantity per Item</h3>
                    </div>
                    <div class="block-content block-content-full bg-gray-lighter text-center">
                        <div style="height: 320px;">
                            <router-view name="VolumePerItem" style="width: 555px; height: 320px;"></router-view>
                        </div>
                    </div>
                    <div class="block-content text-center">

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="block block-rounded block-opt-refresh-icon8">
                    <div class="block-header">
                        <ul class="block-options">
                            <li>
                                <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                            </li>
                        </ul>
                        <h3 class="block-title">Top Customers</h3>
                    </div>
                    <div class="block-content block-content-full bg-gray-lighter text-center">
                        <div style="height: 320px;">
                            <router-view name="SalesPerDay" style="height: 320px;"></router-view>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
