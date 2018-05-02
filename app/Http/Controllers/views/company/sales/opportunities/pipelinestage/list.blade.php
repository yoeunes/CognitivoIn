
@extends('layouts.form')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <a class="block block-link-hover3 text-center" href="{{ route('pipelinestage.create', request()->route('profile')) }}">
                    <div class="block-content block-content-full">
                        <div class="h1 font-w700 text-success"><i class="fa fa-plus"></i></div>
                    </div>
                    <div class="block-content block-content-full block-content-mini bg-gray-lighter text-success font-w600">Add New Product</div>
                </a>
            </div>

        </div>
        <div class="block">

            <div class="block-content">
                <table class="table table-borderless table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 100px;">Pipeline</th>
                            <th class="visible-lg">Sequence</th>
                            <th class="hidden-xs text-center">Name</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pipelinestages as $pipelinestage)
                            <tr>
                                <td class="text-center">
                                    <a class="font-" href="{{ route('pipelinestage.edit',[ request()->route('profile'),$pipelinestage->id]) }}">
                                        <strong>{{$pipelinestage->pipeline->name}}</strong>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a class="font-" href="{{ route('pipelinestage.edit',[ request()->route('profile'),$pipelinestage]) }}">
                                        <strong>{{$pipelinestage->sequence}}</strong>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a class="font-" href="{{ route('pipelinestage.edit',[ request()->route('profile'),$pipelinestage]) }}">
                                        <strong>{{$pipelinestage->name}}</strong>
                                    </a>
                                </td>

                            </tr>
                        @endforeach


                    </tbody>
                </table>
                <nav class="text-right">
                    <ul class="pagination pagination-sm">
                        <li class="active">
                            <a href="javascript:void(0)">1</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">2</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">3</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">4</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">5</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><i class="fa fa-angle-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection
