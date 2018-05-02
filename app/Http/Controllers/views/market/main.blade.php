@extends('layouts.web')

@section('content')

<!-- Search Section -->
<div class="content">
    <form action="base_pages_search.html" method="post">
        <div class="input-group input-group-lg">
            <input class="form-control" type="text" placeholder="Search the Market...">
            <div class="input-group-btn">
                <button class="btn btn-default"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
</div>
<!-- END Search Section -->

<!-- Page Content -->
<div>
    <div class="content">

        <!-- New Arrivals -->
        <h3 class="font-w400 text-black push-30-t push-20">
            New Shops
            <small>
                <a class="font-w600 link-effect" href="base_pages_ecom_store_products.html"> more... <i class="fa fa-angle-right"></i></a>
            </small>
        </h3>
        {{-- <div class="col-xs-12 text-right push">

        </div> --}}
        <div class="row">
            @foreach ($profiles as $profile)
                <div class="col-sm-6 col-lg-3">
                    <div class="block">
                        <div class="img-container">
                            <img class="img-responsive" src="/img/various/ecom_product1.png" alt="{{$profile->name}}">
                            <div class="img-options">
                                <div class="img-options-content">
                                    <div class="push-20">
                                        <a class="btn btn-sm btn-default" href="{{ route('store', request()->route('profile')) }}">View</a>
                                    </div>
                                    <div class="text-warning">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-full"></i>
                                        <span class="text-white">(35)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="push-10">
                                <div class="h4 font-w600 text-success pull-right push-10-l"></div>
                                <a class="h4" href="{{ route('store', request()->route('profile')) }}">{{$profile->alias}}</a>
                            </div>
                            <p class="text-muted">{{$profile->short_description}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- END New Arrivals -->

        <!-- Best Sellers -->
        <h3 class="font-w400 text-black push-20">Best Sellers</h3>
        <div class="row">
            <div class="col-sm-6 col-lg-3">
                <div class="block">
                    <div class="img-container">
                        <img class="img-responsive" src="assets/img/various/ecom_product5.png" alt="">
                        <div class="img-options">
                            <div class="img-options-content">
                                <div class="push-20">
                                    <a class="btn btn-sm btn-default" href="base_pages_ecom_store_product.html">View</a>
                                    <a class="btn btn-sm btn-default" href="javascript:void(0)">
                                        <i class="fa fa-plus"></i> Add to cart
                                    </a>
                                </div>
                                <div class="text-warning">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <span class="text-white">(690)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="push-10">
                            <div class="h4 font-w600 text-success pull-right push-10-l">$44</div>
                            <a class="h4" href="base_pages_ecom_store_product.html">Video UI Kit</a>
                        </div>
                        <p class="text-muted">Media components that work</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="block">
                    <div class="img-container">
                        <img class="img-responsive" src="assets/img/various/ecom_product6.png" alt="">
                        <div class="img-options">
                            <div class="img-options-content">
                                <div class="push-20">
                                    <a class="btn btn-sm btn-default" href="base_pages_ecom_store_product.html">View</a>
                                    <a class="btn btn-sm btn-default" href="javascript:void(0)">
                                        <i class="fa fa-plus"></i> Add to cart
                                    </a>
                                </div>
                                <div class="text-warning">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <span class="text-white">(480)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="push-10">
                            <div class="h4 font-w600 text-success pull-right push-10-l">$58</div>
                            <a class="h4" href="base_pages_ecom_store_product.html">Super Badges Pack</a>
                        </div>
                        <p class="text-muted">1000s of high quality badges</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="block">
                    <div class="img-container">
                        <img class="img-responsive" src="assets/img/various/ecom_product7.png" alt="">
                        <div class="img-options">
                            <div class="img-options-content">
                                <div class="push-20">
                                    <a class="btn btn-sm btn-default" href="base_pages_ecom_store_product.html">View</a>
                                    <a class="btn btn-sm btn-default" href="javascript:void(0)">
                                        <i class="fa fa-plus"></i> Add to cart
                                    </a>
                                </div>
                                <div class="text-warning">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <span class="text-white">(520)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="push-10">
                            <div class="h4 font-w600 text-success pull-right push-10-l">$65</div>
                            <a class="h4" href="base_pages_ecom_store_product.html">RPG Game Pack</a>
                        </div>
                        <p class="text-muted">10-in-1 Anniversary Pack</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="block">
                    <div class="img-container">
                        <img class="img-responsive" src="assets/img/various/ecom_product8.png" alt="">
                        <div class="img-options">
                            <div class="img-options-content">
                                <div class="push-20">
                                    <a class="btn btn-sm btn-default" href="base_pages_ecom_store_product.html">View</a>
                                    <a class="btn btn-sm btn-default" href="javascript:void(0)">
                                        <i class="fa fa-plus"></i> Add to cart
                                    </a>
                                </div>
                                <div class="text-warning">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <span class="text-white">(490)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="push-10">
                            <div class="h4 font-w600 text-success pull-right push-10-l">$17</div>
                            <a class="h4" href="base_pages_ecom_store_product.html">Antivir</a>
                        </div>
                        <p class="text-muted">Antivirus protection for all</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 text-right push">
                <a class="font-w600 link-effect" href="base_pages_ecom_store_products.html">View More Best Sellers <i class="fa fa-angle-right"></i></a>
            </div>
        </div>
        <!-- END Best Sellers -->

        <!-- Best Rated -->
        <h3 class="font-w400 text-black push-20">Best Rated</h3>
        <div class="row">
            <div class="col-sm-6 col-lg-3">
                <div class="block">
                    <div class="img-container">
                        <img class="img-responsive" src="assets/img/various/ecom_product9.png" alt="">
                        <div class="img-options">
                            <div class="img-options-content">
                                <div class="push-20">
                                    <a class="btn btn-sm btn-default" href="base_pages_ecom_store_product.html">View</a>
                                    <a class="btn btn-sm btn-default" href="javascript:void(0)">
                                        <i class="fa fa-plus"></i> Add to cart
                                    </a>
                                </div>
                                <div class="text-warning">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <span class="text-white">(1050)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="push-10">
                            <div class="h4 font-w600 text-success pull-right push-10-l">$18</div>
                            <a class="h4" href="base_pages_ecom_store_product.html">MapNow</a>
                        </div>
                        <p class="text-muted">Map service for your app</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="block">
                    <div class="img-container">
                        <img class="img-responsive" src="assets/img/various/ecom_product10.png" alt="">
                        <div class="img-options">
                            <div class="img-options-content">
                                <div class="push-20">
                                    <a class="btn btn-sm btn-default" href="base_pages_ecom_store_product.html">View</a>
                                    <a class="btn btn-sm btn-default" href="javascript:void(0)">
                                        <i class="fa fa-plus"></i> Add to cart
                                    </a>
                                </div>
                                <div class="text-warning">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <span class="text-white">(998)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="push-10">
                            <div class="h4 font-w600 text-success pull-right push-10-l">$44</div>
                            <a class="h4" href="base_pages_ecom_store_product.html">Calendious</a>
                        </div>
                        <p class="text-muted">Management for freelancers</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="block">
                    <div class="img-container">
                        <img class="img-responsive" src="assets/img/various/ecom_product11.png" alt="">
                        <div class="img-options">
                            <div class="img-options-content">
                                <div class="push-20">
                                    <a class="btn btn-sm btn-default" href="base_pages_ecom_store_product.html">View</a>
                                    <a class="btn btn-sm btn-default" href="javascript:void(0)">
                                        <i class="fa fa-plus"></i> Add to cart
                                    </a>
                                </div>
                                <div class="text-warning">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <span class="text-white">(870)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="push-10">
                            <div class="h4 font-w600 text-success pull-right push-10-l">$35</div>
                            <a class="h4" href="base_pages_ecom_store_product.html">Todo App</a>
                        </div>
                        <p class="text-muted">All your tasks in one place</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="block">
                    <div class="img-container">
                        <img class="img-responsive" src="assets/img/various/ecom_product12.png" alt="">
                        <div class="img-options">
                            <div class="img-options-content">
                                <div class="push-20">
                                    <a class="btn btn-sm btn-default" href="base_pages_ecom_store_product.html">View</a>
                                    <a class="btn btn-sm btn-default" href="javascript:void(0)">
                                        <i class="fa fa-plus"></i> Add to cart
                                    </a>
                                </div>
                                <div class="text-warning">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <span class="text-white">(745)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="push-10">
                            <div class="h4 font-w600 text-success pull-right push-10-l">$22</div>
                            <a class="h4" href="base_pages_ecom_store_product.html">e-Music</a>
                        </div>
                        <p class="text-muted">Music streaming service</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 text-right push">
                <a class="font-w600 link-effect" href="base_pages_ecom_store_products.html">View More Best Rated <i class="fa fa-angle-right"></i></a>
            </div>
        </div>
        <!-- END Best Rated -->
    </div>
</div>
<!-- END Page Content -->

@endsection
