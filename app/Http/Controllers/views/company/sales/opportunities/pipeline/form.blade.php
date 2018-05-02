@extends('company.sales.menu')

@section('title', 'Pipeline')
@section('subTitle', 'Create')

@section('action')
    {{-- <a class="btn btn-default" href="{{ route('opportunities.create', request()->route('profile')) }}">
    <i class="fa fa-plus-circle text-success push-5-r"></i> New Opportunity
</a> --}}
@endsection

@section('subContent')
    <div class="content">
        <div class="row">
            @isset($pipeline)
                {{-- push-30-t push-30 --}}
                <form class="form-horizontal" action="{{ route('pipelines.destroy', [request()->route('profile'), $pipeline]) }}" method="post" >
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <div class="col-xs-12 col-sm-4">
                        <button type="submit" class="block block-link-hover3 text-center">
                            <div class="block-content block-content-full">
                                <div class="h1 font-w700 text-danger">
                                    <i class="fa fa-times"></i>
                                </div>
                            </div>
                            <div class="block-content block-content-full block-content-mini text-danger font-w600">Delete Pipeline</div>
                        </button>
                    </div>
                </form>
            @endisset
        </div>
        <div class="block">
            <div class="block-content block-content-full">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 col-lg-8">
                        <h3>Pipeline</h3>
                        @isset($pipeline)
                            <form class="form-horizontal push-30-t push-30" action="{{ route('pipelines.update', [request()->route('profile'), $pipeline]) }}" method="post" >
                                {{ method_field('PUT') }}
                            @else
                                <form class="form-horizontal push-30-t push-30" action="{{ route('pipelines.store', request()->route('profile')) }}" method="post" >
                                @endif
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <div class="form-material form-material-primary">
                                            @isset($pipeline)
                                                <input class="form-control" type="text" id="name" name="name" value="{{$pipeline->name}}">
                                            @else
                                                <input class="form-control" type="text" id="name" name="name" value="">
                                            @endisset
                                            <label for="product-id">Name</label>
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
                @isset($pipeline)
                    <hr>

                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 col-lg-8">
                            <h3>Pipeline Stages</h3>

                            <form class="form-horizontal push-30-t push-30" action="{{ route('pipelinestage.store', request()->route('profile')) }}" method="post" >
                                {{ csrf_field() }}
                                <input type="hidden" id="pipeline_id" name="pipeline_id" value="{{$pipeline->id}}">
                                <div class="form-group">
                                    <div class="col-xs-6">
                                        <div class="form-material form-material-primary">
                                            <input class="form-control" type="text" id="name" name="name" value="">
                                            <label for="product-id">Name</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="form-material form-material-primary">
                                            <input class="form-control" type="number" id="sequence" name="sequence" value="{{ $pipeline->stages->max('sequence') + 1 }}">
                                            <label for="product-id">Sequence</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-2">
                                        <button class="btn btn-default" type="submit">Create</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif

                @isset($pipelinestages)
                    <div class="row">

                        <div class="col-sm-8 col-sm-offset-2 col-lg-8">

                            <table class="table table-borderless table-striped table-vcenter">
                                <thead>
                                    <tr>
                                        <th>Sequence</th>
                                        <th class="visible-lg">Stage</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pipelinestages as $pipelinestage)
                                        <tr>

                                            <td class="text-right">
                                                <a class="font-" href="{{ route('pipelinestage.edit', [ request()->route('profile'), $pipelinestage]) }}">
                                                    <strong>{{$pipelinestage->sequence}}</strong>
                                                </a>
                                            </td>

                                            <td class="text-center">
                                                <a class="font-" href="{{ route('pipelinestage.edit', [ request()->route('profile'), $pipelinestage]) }}">
                                                    <strong>{{$pipelinestage->name}}</strong>
                                                </a>
                                            </td>

                                            <td class="text-center">
                                                <div class="btn-group btn-group-xs">
                                                    <form class="form-horizontal push-30-t push-30" action="{{ route('pipelinestage.destroy', [request()->route('profile'), $pipelinestage]) }}" method="post" >
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <a href="" data-toggle="tooltip" title=""><button class="btn btn-danger" type="submit">Delete</button>
                                                        </a>
                                                    </form>
                                                </div>
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
                @endif
            </div>
        </div>
    </div>
@endsection
