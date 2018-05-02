@extends('layouts.form')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <a class="block block-link-hover3 text-center" href="{{ route('orders.create', request()->route('profile')) }}">
                    <div class="block-content block-content-full">
                        <div class="h1 font-w700 text-primary" data-toggle="countTo" data-to="35"></div>
                    </div>
                    <div class="block-content block-content-full block-content-mini bg-gray-lighter text-muted font-w600">Create</div>
                </a>
            </div>
            <div class="col-sm-6 col-md-3">
                <a class="block block-link-hover3 text-center" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="h1 font-w700 text-primary" data-toggle="countTo" data-to="35"></div>
                    </div>
                    <div class="block-content block-content-full block-content-mini bg-gray-lighter text-muted font-w600">Pending</div>
                </a>
            </div>
            <div class="col-sm-6 col-md-3">
                <a class="block block-link-hover3 text-center" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="h1 font-w700" data-toggle="countTo" data-to="260"></div>
                    </div>
                    <div class="block-content block-content-full block-content-mini bg-gray-lighter text-muted font-w600">This Month</div>
                </a>
            </div>
            <div class="col-sm-6 col-md-3">
                <a class="block block-link-hover3 text-center" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="h1 font-w700" data-toggle="countTo" data-to="57890"></div>
                    </div>
                    <div class="block-content block-content-full block-content-mini bg-gray-lighter text-muted font-w600">Last Month</div>
                </a>
            </div>
        </div>
        <div class="block">
            {{ csrf_field() }}
            <div class="block-header bg-gray-lighter">
                <ul class="block-options">
                    <li class="dropdown">
                        <button type="button" data-toggle="dropdown">Filter <span class="caret"></span></button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li>
                                <a tabindex="-1" href="javascript:void(0)"><span class="badge pull-right">35</span>Pending</a>
                            </li>
                            <li>
                                <a tabindex="-1" href="javascript:void(0)"><span class="badge pull-right">15</span>Processing</a>
                            </li>
                            <li>
                                <a tabindex="-1" href="javascript:void(0)"><span class="badge pull-right">20</span>For delivery</a>
                            </li>
                            <li>
                                <a tabindex="-1" href="javascript:void(0)"><span class="badge pull-right">72</span>Canceled</a>
                            </li>
                            <li>
                                <a tabindex="-1" href="javascript:void(0)"><span class="badge pull-right">890</span>Delivered</a>
                            </li>
                            <li>
                                <a tabindex="-1" href="javascript:void(0)"><span class="badge pull-right">997</span>All</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <h3 class="block-title">All Orders</h3>
            </div>
            <div class="block-content">

                <table class="table table-borderless table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 100px;">ID</th>
                            <th class="hidden-xs text-center">Submitted</th>
                            <th>Status</th>
                            <th class="visible-lg">Customer</th>
                            <th class="visible-lg text-center">Products</th>
                            <th class="hidden-xs text-right">Value</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td class="text-center">
                                    <a class="font-" href="base_pages_ecom_order.html">
                                        <strong>{{$order->tracking_code}}</strong>
                                    </a>
                                </td>
                                <td class="hidden-xs text-center">{{$order->created_at}}</td>
                                <td>
                                    <span class="label label-danger">{{$order->status}}</span>
                                </td>
                                <td class="visible-lg">
                                    <a href="{{ route('orders.show', [request()->route('profile'),$order]) }}">{{$order->customer_alias}}</a>
                                </td>
                                <td class="text-center visible-lg">
                                    <a href="javascript:void(0)"></a>
                                </td>
                                <td class="text-right hidden-xs">
                                    <strong></strong>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-xs">
                                        <a href="base_pages_ecom_order.html" data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                                        <a href="javascript:void(0)" data-toggle="tooltip" title="Delete" class="btn btn-default"><i class="fa fa-times text-danger"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $orders->links() }}
            </div>
        </div>
    </div>
@endsection
