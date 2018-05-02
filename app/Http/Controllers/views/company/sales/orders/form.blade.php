
@extends('layouts.form')

@section('content')


        <input type="hidden" id="slug" value="{{request()->route('profile')->slug}}"/>
        <input type="hidden" id="slugid" value="{{request()->route('profile')->id}}"/>
        
        <router-view name="Order"></router-view>
        <!-- END Customer -->
        <!-- Header Tiles -->

        <!-- END Header Tiles -->

        <!-- Products -->

            <!-- END Products -->



            <!-- Log Messages -->
            <div class="block">
                <div class="block-header bg-gray-lighter">
                    <h3 class="block-title">Log Messages</h3>
                </div>
                <div class="block-content">
                    <div class="table-responsive">
                        <table class="table table-borderless table-striped table-vcenter">
                            <tbody>
                                <tr>
                                    <td style="width: 80px;">
                                        <span class="label label-primary">Order</span>
                                    </td>
                                    <td style="width: 220px;">
                                        <span class="font-w600">November 17, 2015 - 18:00</span>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)">Support</a>
                                    </td>
                                    <td class="text-success">Order Completed</td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="label label-primary">Order</span>
                                    </td>
                                    <td>
                                        <span class="font-w600">November 17, 2015 - 17:36</span>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)">Support</a>
                                    </td>
                                    <td class="text-info">Preparing Order</td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="label label-success">Payment</span>
                                    </td>
                                    <td>
                                        <span class="font-w600">November 16, 2015 - 18:10</span>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)">John Doe</a>
                                    </td>
                                    <td class="text-success">Payment Completed</td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="label label-danger">Email</span>
                                    </td>
                                    <td>
                                        <span class="font-w600">November 16, 2015 - 10:35</span>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)">Support</a>
                                    </td>
                                    <td class="text-danger">Missing payment details. Email was sent and awaiting for payment before processing</td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="label label-primary">Order</span>
                                    </td>
                                    <td>
                                        <span class="font-w600">November 15, 2015 - 14:59</span>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)">Support</a>
                                    </td>
                                    <td>All products are available</td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="label label-primary">Order</span>
                                    </td>
                                    <td>
                                        <span class="font-w600">November 15, 2015 - 14:29</span>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)">John Doe</a>
                                    </td>
                                    <td>Order Submitted</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END Log Messages -->


    @endsection
