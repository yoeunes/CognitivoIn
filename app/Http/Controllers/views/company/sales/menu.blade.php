

@extends('layouts.form')

@section('content')

    <div class="bg-image" style="background-image: url('/img/photos/photo28@2x.jpg');">
        <div class="content content-full bg-primary-dark-op">
            <div class="row">

                {{-- <div class="content content-mini"> --}}
                    {{-- <ol class="breadcrumb text-white">
                        <li>
                            <a class="link-effect" href="base_pages_projects_dashboard.html">Sales Platform</a>
                        </li>
                        <li>
                            <a class="link-effect" href="base_pages_projects_dashboard.html">Opportunities</a>
                        </li>
                        <li>
                            Create
                        </li>
                    </ol> --}}
                {{-- </div> --}}

                <div class="col-xs-6">
                    <h4 class="text-white">
                        @yield('title') /
                        <small class="hidden-xs">
                            <span class="text-white-op">
                                @yield('subTitle')
                            </span>
                        </small>
                    </h4>
                </div>
                <div class="col-xs-6 text-right">
                    @yield('action')
                </div>
            </div>
        </div>
    </div>

    @yield('subContent')

@endsection
