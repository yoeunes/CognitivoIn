@extends('layouts.app')

@section('content')
    <!-- My Block -->
    <div class="block">
        <div class="block-content">
            @yield('content')
        </div>
    </div>
    <!-- END My Block -->
@endsection
