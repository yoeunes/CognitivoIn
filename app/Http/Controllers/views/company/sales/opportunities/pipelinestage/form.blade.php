
@extends('layouts.form')

@section('content')
    <div class="content">
        <div class="row">
            @isset($pipelinestage)

                <form class="form-horizontal push-30-t push-30" action="{{ route('pipelinestage.destroy', [request()->route('profile'), $pipelinestage]) }}" method="post" >
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}

                    <div class="col-xs-12 col-sm-4">
                        <button type="submit" class="block block-link-hover3 text-center">
                            <div class="block-content block-content-full">
                                <div class="h1 font-w700 text-danger"><i class="fa fa-times"></i></div>
                            </div>
                            <div class="block-content block-content-full block-content-mini bg-gray-lighter text-danger font-w600">Delete Pipelines</div>
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
                        @isset($pipelinestage)
                            <form class="form-horizontal push-30-t push-30" action="{{ route('pipelinestage.update', [request()->route('profile'), $pipelinestage]) }}" method="post" >
                                {{ method_field('PUT') }}
                            @else
                                <form class="form-horizontal push-30-t push-30" action="{{ route('pipelinestage.store', request()->route('profile')) }}" method="post" >
                                @endif
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <div class="form-material form-material-primary">
                                            <select required id="pipeline_id" required name="pipeline_id">
                                                <option>Select a Pipeline</option>
                                                @isset($pipelinestage)
                                                    @foreach ($pipelines as $pipeline)

                                                        @if ($pipelinestage->pipeline_id==$pipeline->id)
                                                            <option value="{{ $pipeline->id }}" selected>{{ $pipeline->name }}</option>
                                                        @else
                                                            <option value="{{ $pipeline->id }}">{{ $pipeline->name }}</option>
                                                        @endif


                                                    @endforeach
                                                @else
                                                    @foreach ($pipelines as $pipeline)


                                                        <option value="{{ $pipeline->id }}">{{ $pipeline->name }}</option>



                                                    @endforeach
                                                @endisset
                                            </select>
                                            <label for="product-id">Pipeline</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <div class="form-material form-material-primary">
                                            @isset($pipelinestage)
                                                <input class="form-control" type="text" id="name" name="name" value="{{$pipelinestage->name}}">
                                            @else
                                                <input class="form-control" type="text" id="name" name="name" value="">
                                            @endisset
                                            <label for="product-id">Name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <div class="form-material form-material-primary">
                                            @isset($pipelinestage)
                                                <input class="form-control" type="text" id="sequence" name="sequence" value="{{$pipelinestage->name}}">
                                            @else
                                                <input class="form-control" type="text" id="sequence" name="sequence" value="">
                                            @endisset
                                            <label for="product-id">Sequence</label>
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

        </div>
    </div>
@endsection
