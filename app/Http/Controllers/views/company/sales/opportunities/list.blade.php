
@extends('company.sales.menu')

@section('title', 'opportunities')

@section('action')
    <a class="btn btn-default" href="{{ route('opportunities.create', request()->route('profile')) }}">
        <i class="fa fa-plus-circle text-success push-5-r"></i> New opportunity
    </a>
@endsection

@section('subContent')
    <div class="content content-boxed">

        @foreach ($pipelines as $pipeline)
            <h2 class="content-heading">{{ $pipeline->name }}</h2>

            <div class="row">
                @foreach ($opportunities as $opportunity)

                    {{-- {{ $opportunity }} --}}
                    <div class="col-sm-6 col-lg-4">
                        <div class="block block-rounded block-themed">
                            <div class="block-header bg-primary">
                                <h3 class="h4 font-w600 push-5">
                                    <a class="text-white" href="{{ route('opportunities.show', [request()->route('profile'), $opportunity->id]) }}">
                                        {{ $opportunity->customer_alias }}
                                    </a>
                                </h3>
                                <h4 class="h5 text-white-op">
                                    {{ $opportunity->value }} | {{ $opportunity->description }}
                                </h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
