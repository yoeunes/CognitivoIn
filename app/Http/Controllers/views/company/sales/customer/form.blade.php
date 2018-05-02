
@extends('layouts.form')

@section('content')
    <div class="content">
        <div class="row">
            @isset($item)
                <div class="col-xs-6 col-sm-4">
                    <a class="block block-link-hover3 text-center" href="javascript:void(0)">
                        <div class="block-content block-content-full">
                            <div class="h1 font-w700" data-toggle="countTo" data-to="250">250</div>
                        </div>
                        <div class="block-content block-content-full block-content-mini bg-gray-lighter text-muted font-w600">In Orders</div>
                    </a>
                </div>
                <div class="col-xs-6 col-sm-4">
                    <a class="block block-link-hover3 text-center" href="javascript:void(0)">
                        <div class="block-content block-content-full">
                            <div class="h1 font-w700" data-toggle="countTo" data-to="29">29</div>
                        </div>
                        <div class="block-content block-content-full block-content-mini bg-gray-lighter text-muted font-w600">Available</div>
                    </a>
                </div>
                <form class="form-horizontal push-30-t push-30" action="{{ route('customers.destroy', [request()->route('profile'), $item]) }}" method="post" >
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}

                    <div class="col-xs-12 col-sm-4">
                        <button type="submit" class="block block-link-hover3 text-center">
                            <div class="block-content block-content-full">
                                <div class="h1 font-w700 text-danger"><i class="fa fa-times"></i></div>
                            </div>
                            <div class="block-content block-content-full block-content-mini bg-gray-lighter text-danger font-w600">Delete Product</div>
                        </button>
                    </div>
                </form>
            @endisset
        </div>
        <div class="block">
            <div class="block-header bg-gray-lighter">
                <h3 class="block-title">Info</h3>
            </div>
            <div class="block-content block-content-full">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 col-lg-6 col-lg-offset-3">
                        @isset($customer)
                            <form class="form-horizontal push-30-t push-30" action="{{ route('customers.update', [request()->route('profile'), $customer]) }}" method="post" >
                                {{ method_field('PUT') }}
                            @else
                                <form class="form-horizontal push-30-t push-30" action="{{ route('customers.store', request()->route('profile')) }}" method="post" >
                                    {{ method_field('POST') }}
                                @endif

                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <div class="form-material form-material-primary">
                                            @isset($customer)

                                                <input class="form-control" type="text" id="taxid" name="taxid" value="{{$customer->customer_taxid}}">
                                            @else
                                                <input class="form-control" type="text" id="taxid" name="taxid" value="">
                                            @endisset
                                            <label for="taxid">GovCode</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <div class="form-material form-material-primary">
                                            @isset($customer)
                                                <input class="form-control" type="text" id="alias" name="alias" value="{{$customer->customer_alias}}">
                                            @else
                                                <input class="form-control" type="text" id="alias" name="alias" value="">
                                            @endisset

                                            <label for="alias">Alias</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <div class="form-material form-material-primary">
                                            @isset($customer)
                                                <input class="form-control" type="text" id="address" name="address" value="{{$customer->customer_address}}">
                                            @else
                                                <input class="form-control" type="text" id="address" name="address" value="">
                                            @endisset

                                            <label for="address">Address</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <div class="form-material form-material-primary">
                                            @isset($customer)
                                                <input class="form-control" type="text" id="telephone" name="telephone" value="{{$customer->customer_telephone}}">
                                            @else
                                                <input class="form-control" type="text" id="telephone" name="telephone" value="">
                                            @endisset
                                            <label for="telephone">Telephone</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <div class="form-material form-material-primary">
                                            @isset($customer)
                                                <input class="form-control" type="text" id="email" name="email" value="{{$customer->customer_email}}">
                                            @else
                                                <input class="form-control" type="text" id="email" name="email" value="">
                                            @endisset

                                            <label for="email">Email</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <button class="btn btn-primary" type="submit">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block">
                <div class="block-header bg-gray-lighter">
                    <h3 class="block-title">Images</h3>
                </div>
                <div class="block-content block-content-full">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 col-lg-6 col-lg-offset-3">
                            <form class="dropzone push-30-t push-30 dz-clickable" action="base_pages_ecom_product_edit.php"><div class="dz-default dz-message"><span>Drop files here to upload</span></div></form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
