
@extends('layouts.form')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <a class="block block-link-hover3 text-center" href="{{ route('pipelines.create', request()->route('profile')) }}">
                    <div class="block-content block-content-full">
                        <div class="h1 font-w700 text-success"><i class="fa fa-plus"></i></div>
                    </div>
                    <div class="block-content block-content-full block-content-mini bg-gray-lighter text-success font-w600">Add New Pipeline</div>
                </a>
            </div>
        </div>
        <div class="row">
            @foreach ($pipelines as $pipeline)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="block">
                        <div class="block-content block-content-full text-center">
                            <div class="item item-2x item-circle bg-gray-lighter">
                                <i class="si si-direction text-black"></i>
                            </div>
                        </div>
                        <div class="block-content block-content-full text-center">
                            <a class="font-w600" href="{{ route('pipelines.edit', [request()->route('profile'), $pipeline]) }}">{{ $pipeline->name }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
