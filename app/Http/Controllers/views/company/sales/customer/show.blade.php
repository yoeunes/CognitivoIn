
@extends('layouts.form')

@section('content')

    <div class="content content-boxed">
        <!-- Header Tiles -->
        <div class="row">
            <div class="col-sm-6">
                <a class="block block-link-hover3 text-center" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="h1 font-w700"><i class="fa fa-pencil"></i></div>
                    </div>
                    <div class="block-content block-content-full block-content-mini bg-gray-lighter text-muted font-w600">Edit Customer</div>
                </a>
            </div>
            <div class="col-sm-6">
                <a class="block block-link-hover3 text-center" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="h1 font-w700 text-danger"><i class="fa fa-times"></i></div>
                    </div>
                    <div class="block-content block-content-full block-content-mini bg-gray-lighter text-danger font-w600">Delete Customer</div>
                </a>
            </div>
        </div>
        <!-- END Header Tiles -->

        <!-- Customer Info -->
        <div class="block">
            <!-- Basic Info -->
            <div class="block-content text-center overflow-hidden">
                <div class="push-30-t push animated fadeInDown">
                    <img class="img-avatar" src="/img/avatars/avatar.jpg" alt="">
                </div>
                <div class="push-30 animated fadeInUp">
                    <h2 class="h4 font-w600 push-5">
                        {{ $profile->name }} <i class="fa fa-star text-warning" data-toggle="tooltip" title="" data-original-title="Premium Member"></i>
                    </h2>
                    <h3 class="h5 text-muted">{{ $profile->taxid }}</h3>
                </div>
            </div>
            <!-- END Basic Info -->

            <!-- Stats -->
            <div class="block-content text-center bg-gray-lighter">
                <div class="row items-push text-uppercase">
                    <div class="col-xs-6 col-sm-3">
                        <div class="font-w700 text-gray-darker animated fadeIn">Orders</div>
                        <a class="h2 font-w300 text-primary animated flipInX" href="javascript:void(0)">5</a>
                    </div>
                    <div class="col-xs-6 col-sm-3">
                        <div class="font-w700 text-gray-darker animated fadeIn">Orders Value</div>
                        <a class="h2 font-w300 text-primary animated flipInX" href="javascript:void(0)">$3.580</a>
                    </div>
                    <div class="col-xs-6 col-sm-3">
                        <div class="font-w700 text-gray-darker animated fadeIn">Cart</div>
                        <a class="h2 font-w300 text-primary animated flipInX" href="javascript:void(0)">4</a>
                    </div>
                    <div class="col-xs-6 col-sm-3">
                        <div class="font-w700 text-gray-darker animated fadeIn">Referred</div>
                        <a class="h2 font-w300 text-primary animated flipInX" href="javascript:void(0)">3</a>
                    </div>
                </div>
            </div>
            <!-- END Stats -->
        </div>
        <!-- END Customer Info -->

        <!-- Addresses -->
        <div class="block">
            <div class="block-header bg-gray-lighter">
                <h3 class="block-title">Addresses</h3>
            </div>
            <div class="block-content">
                <div class="row">
                    <div class="col-lg-6">
                        <!-- Billing Address -->
                        <div class="block block-bordered">
                            <div class="block-header">
                                <h3 class="block-title">Billing Address</h3>
                            </div>
                            <div class="block-content block-content-full">
                                <div class="h4 push-5">{{ $profile->name }}</div>
                                <address>
                                    {{ $profile->address }}
                                    <i class="fa fa-phone"></i> {{ $profile->telephone }} <br>
                                    <i class="fa fa-envelope-o"></i> <a href="javascript:void(0)"> {{ $profile->email }}</a>
                                </address>
                            </div>
                        </div>
                        <!-- END Billing Address -->
                    </div>
                    <div class="col-lg-6">
                        <!-- Shipping Address -->
                        <div class="block block-bordered">
                            <div class="block-header">
                                <h3 class="block-title">Shipping Address</h3>
                            </div>
                            <div class="block-content block-content-full">
                                <div class="h4 push-5">Dennis Ross</div>
                                <address>
                                    Sunrise Str 620<br>
                                    Melbourne<br>
                                    Australia, 11-587<br><br>
                                    <i class="fa fa-phone"></i> (999) 888-55555<br>
                                    <i class="fa fa-envelope-o"></i> <a href="javascript:void(0)">company@example.com</a>
                                </address>
                            </div>
                        </div>
                        <!-- END Shipping Address -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END Addresses -->

        <!-- Cart -->
        <div class="block">
            <div class="block-header bg-gray-lighter">
                <h3 class="block-title">Cart <small>(4)</small></h3>
            </div>
            <div class="block-content">
                <table class="table table-borderless table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 100px;">ID</th>
                            <th class="visible-lg">Product</th>
                            <th class="hidden-xs text-center">Added</th>
                            <th>Status</th>
                            <th class="hidden-xs text-right">Value</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">
                                <a class="font-" href="base_pages_ecom_product_edit.html">
                                    <strong>PID.0154</strong>
                                </a>
                            </td>
                            <td class="visible-lg">
                                <a href="base_pages_ecom_product_edit.html">Product #4</a>
                            </td>
                            <td class="hidden-xs text-center">06/02/2015</td>
                            <td>
                                <span class="label label-danger">Out of Stock</span>
                            </td>
                            <td class="text-right hidden-xs">
                                <strong>$38,00</strong>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-xs">
                                    <a href="base_pages_ecom_product_edit.html" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="View"><i class="fa fa-eye"></i></a>
                                    <a href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Delete"><i class="fa fa-times text-danger"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <a class="font-" href="base_pages_ecom_product_edit.html">
                                    <strong>PID.0153</strong>
                                </a>
                            </td>
                            <td class="visible-lg">
                                <a href="base_pages_ecom_product_edit.html">Product #3</a>
                            </td>
                            <td class="hidden-xs text-center">01/06/2015</td>
                            <td>
                                <span class="label label-danger">Out of Stock</span>
                            </td>
                            <td class="text-right hidden-xs">
                                <strong>$69,00</strong>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-xs">
                                    <a href="base_pages_ecom_product_edit.html" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="View"><i class="fa fa-eye"></i></a>
                                    <a href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Delete"><i class="fa fa-times text-danger"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <a class="font-" href="base_pages_ecom_product_edit.html">
                                    <strong>PID.0152</strong>
                                </a>
                            </td>
                            <td class="visible-lg">
                                <a href="base_pages_ecom_product_edit.html">Product #2</a>
                            </td>
                            <td class="hidden-xs text-center">19/05/2015</td>
                            <td>
                                <span class="label label-success">Available</span>
                            </td>
                            <td class="text-right hidden-xs">
                                <strong>$36,00</strong>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-xs">
                                    <a href="base_pages_ecom_product_edit.html" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="View"><i class="fa fa-eye"></i></a>
                                    <a href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Delete"><i class="fa fa-times text-danger"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <a class="font-" href="base_pages_ecom_product_edit.html">
                                    <strong>PID.0151</strong>
                                </a>
                            </td>
                            <td class="visible-lg">
                                <a href="base_pages_ecom_product_edit.html">Product #1</a>
                            </td>
                            <td class="hidden-xs text-center">12/03/2015</td>
                            <td>
                                <span class="label label-success">Available</span>
                            </td>
                            <td class="text-right hidden-xs">
                                <strong>$50,00</strong>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-xs">
                                    <a href="base_pages_ecom_product_edit.html" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="View"><i class="fa fa-eye"></i></a>
                                    <a href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Delete"><i class="fa fa-times text-danger"></i></a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Cart -->

        <!-- Orders -->
        <div class="block">
            <div class="block-header bg-gray-lighter">
                <h3 class="block-title">Orders <small>(5)</small></h3>
            </div>
            <div class="block-content">
                <table class="table table-borderless table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 100px;">ID</th>
                            <th class="hidden-xs text-center">Submitted</th>
                            <th>Status</th>
                            <th class="visible-lg text-center">Products</th>
                            <th class="hidden-xs text-right">Value</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">
                                <a class="font-" href="base_pages_ecom_order.html">
                                    <strong>ORD.00950</strong>
                                </a>
                            </td>
                            <td class="hidden-xs text-center">06/12/2015</td>
                            <td>
                                <span class="label label-success">Delivered</span>
                            </td>
                            <td class="text-center visible-lg">
                                <a href="javascript:void(0)">1</a>
                            </td>
                            <td class="text-right hidden-xs">
                                <strong>$2092,34</strong>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-xs">
                                    <a href="base_pages_ecom_order.html" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="View"><i class="fa fa-eye"></i></a>
                                    <a href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Delete"><i class="fa fa-times text-danger"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <a class="font-" href="base_pages_ecom_order.html">
                                    <strong>ORD.00949</strong>
                                </a>
                            </td>
                            <td class="hidden-xs text-center">04/12/2015</td>
                            <td>
                                <span class="label label-success">Delivered</span>
                            </td>
                            <td class="text-center visible-lg">
                                <a href="javascript:void(0)">7</a>
                            </td>
                            <td class="text-right hidden-xs">
                                <strong>$1380,72</strong>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-xs">
                                    <a href="base_pages_ecom_order.html" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="View"><i class="fa fa-eye"></i></a>
                                    <a href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Delete"><i class="fa fa-times text-danger"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <a class="font-" href="base_pages_ecom_order.html">
                                    <strong>ORD.00948</strong>
                                </a>
                            </td>
                            <td class="hidden-xs text-center">16/09/2015</td>
                            <td>
                                <span class="label label-success">Delivered</span>
                            </td>
                            <td class="text-center visible-lg">
                                <a href="javascript:void(0)">4</a>
                            </td>
                            <td class="text-right hidden-xs">
                                <strong>$231,90</strong>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-xs">
                                    <a href="base_pages_ecom_order.html" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="View"><i class="fa fa-eye"></i></a>
                                    <a href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Delete"><i class="fa fa-times text-danger"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <a class="font-" href="base_pages_ecom_order.html">
                                    <strong>ORD.00947</strong>
                                </a>
                            </td>
                            <td class="hidden-xs text-center">03/07/2015</td>
                            <td>
                                <span class="label label-success">Delivered</span>
                            </td>
                            <td class="text-center visible-lg">
                                <a href="javascript:void(0)">3</a>
                            </td>
                            <td class="text-right hidden-xs">
                                <strong>$1459,61</strong>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-xs">
                                    <a href="base_pages_ecom_order.html" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="View"><i class="fa fa-eye"></i></a>
                                    <a href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Delete"><i class="fa fa-times text-danger"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <a class="font-" href="base_pages_ecom_order.html">
                                    <strong>ORD.00946</strong>
                                </a>
                            </td>
                            <td class="hidden-xs text-center">11/10/2015</td>
                            <td>
                                <span class="label label-success">Delivered</span>
                            </td>
                            <td class="text-center visible-lg">
                                <a href="javascript:void(0)">7</a>
                            </td>
                            <td class="text-right hidden-xs">
                                <strong>$1029,81</strong>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-xs">
                                    <a href="base_pages_ecom_order.html" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="View"><i class="fa fa-eye"></i></a>
                                    <a href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Delete"><i class="fa fa-times text-danger"></i></a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Orders -->

        <!-- Referred Members -->
        <div class="block">
            <div class="block-header bg-gray-lighter">
                <h3 class="block-title">Referred Members <small>(3)</small></h3>
            </div>
            <div class="block-content">
                <div class="row">
                    <div class="col-sm-6 col-lg-4">
                        <a class="block block-rounded block-bordered block-link-hover3" href="javascript:void(0)">
                            <div class="block-content block-content-full clearfix">
                                <div class="pull-right">
                                    <img class="img-avatar" src="/img/avatars/avatar4.jpg" alt="">
                                </div>
                                <div class="pull-left push-10-t">
                                    <div class="font-w600 push-5">Emma Cooper</div>
                                    <div class="text-muted">4 Orders</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <a class="block block-rounded block-bordered block-link-hover3" href="javascript:void(0)">
                            <div class="block-content block-content-full clearfix">
                                <div class="pull-right">
                                    <img class="img-avatar" src="/img/avatars/avatar11.jpg" alt="">
                                </div>
                                <div class="pull-left push-10-t">
                                    <div class="font-w600 push-5">Ronald George</div>
                                    <div class="text-muted">5 Orders</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <a class="block block-rounded block-bordered block-link-hover3" href="javascript:void(0)">
                            <div class="block-content block-content-full clearfix">
                                <div class="pull-right">
                                    <img class="img-avatar" src="/img/avatars/avatar8.jpg" alt="">
                                </div>
                                <div class="pull-left push-10-t">
                                    <div class="font-w600 push-5">Rebecca Reid</div>
                                    <div class="text-muted">3 Orders</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Referred Members -->

        <!-- Private Notes -->
        <div class="block">
            <div class="block-header bg-gray-lighter">
                <h3 class="block-title">Private Notes</h3>
            </div>
            <div class="block-content">
                <p class="alert alert-info"><i class="fa fa-fw fa-info push-5-r"></i> This note will not be displayed to the customer.</p>
                <form class="form-horizontal push-30-t push-30" action="base_pages_ecom_customer.html" method="post" onsubmit="return false;">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="form-material form-material-primary">
                                <textarea class="form-control" id="product-customer-notes" name="product-customer-notes" rows="3"></textarea>
                                <label for="product-customer-notes">Note</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <button class="btn btn-sm btn-primary" type="submit">Add Note</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Private Notes -->
    </div>

@endsection
