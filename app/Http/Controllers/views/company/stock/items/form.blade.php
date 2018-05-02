
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
                <form class="form-horizontal push-30-t push-30" action="{{ route('items.destroy', [request()->route('profile'), $item]) }}" method="post" >
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
                        @isset($item)
                            <form class="form-horizontal push-30-t push-30" action="{{ route('items.update', [request()->route('profile'), $item]) }}" method="post" enctype="multipart/form-data">
                                {{ method_field('PUT') }}
                            @else
                                <form class="form-horizontal push-30-t push-30" action="{{ route('items.store', request()->route('profile')) }}" method="post" enctype="multipart/form-data">
                                @endif
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <div class="form-material form-material-primary">
                                            @isset($item)
                                                <input class="form-control" type="text" id="sku" name="sku" value="{{$item->sku}}">
                                            @else
                                                <input class="form-control" type="text" id="sku" name="sku" value="">
                                            @endisset
                                            <label for="product-id">SKU</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <div class="form-material form-material-primary">
                                            @isset($item)
                                                <input class="form-control" type="text" id="name" name="name" value="{{$item->name}}">
                                            @else
                                                <input class="form-control" type="text" id="name" name="name" value="">
                                            @endisset

                                            <label for="product-name">Item (Product or Service) name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <div class="form-material form-material-primary">
                                            @isset($item)
                                                <textarea class="form-control" type="text" id="short_description" name="short_description" rows="3" >{{$item->short_description}}</textarea>
                                            @else
                                                <textarea class="form-control" id="short_description" name="short_description" rows="3"></textarea>
                                            @endisset

                                            <label for="product-short-description">Short Description</label>
                                        </div>
                                    </div>

                                    <div class="col-xs-12">
                                        <div class="form-material form-material-primary">
                                            @isset($item)
                                                <textarea class="form-control" type="text" id="long_description" name="long_description" rows="6" >{{$item->long_description}}</textarea>
                                            @else
                                                <textarea class="form-control" id="long_description" name="long_description" rows="6"></textarea>
                                            @endisset

                                            <label for="product-short-description">Long Description</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <div class="form-material form-material-primary">
                                            @isset($item)
                                                <input class="form-control" type="text" id="unit_price" name="unit_price" value="{{$item->unit_price}}">
                                            @else
                                                <input class="form-control" type="text" id="unit_price" name="unit_price" value="">
                                            @endisset

                                            <label for="product-price">Price in USD ($)</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <label class="css-input switch switch-sm switch-primary">
                                            @isset($item)
                                                <input type="checkbox" id="is_active" name="is_active" checked="{{$item->is_active}}"><span></span>
                                            @else
                                                <input type="checkbox" id="is_active" name="is_active" checked=""><span></span>
                                            @endisset
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">

                                          <input type="file" name="item_image">

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
            {{-- <div class="block">
                <div class="block-header bg-gray-lighter">
                    <h3 class="block-title">Images</h3>
                </div>
                <div class="block-content block-content-full">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 col-lg-6 col-lg-offset-3">
                            <input type="file" name="item_image">
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
