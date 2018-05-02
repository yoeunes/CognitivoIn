@extends('layouts.web')

@section('content')

    <!-- Hero Content -->
    <div class="bg-image" style="background-image: url('/img/various/ecom_product6.png');">
        <div class="bg-primary-dark-op">
            <section class="content content-full content-boxed overflow-hidden">
                <!-- Section Content -->
                <div class="push-30-t push-30 text-center">
                    <h1 class="h2 text-white push-10 " data-toggle="appear" data-class="animated fadeInDown">{{$item->name}}</h1>
                    <h2 class="h5 text-white-op " data-toggle="appear" data-class="animated fadeInDown">{{$item->short_description}}</h2>
                </div>
                <!-- END Section Content -->
            </section>
        </div>
    </div>
    <!-- END Hero Content -->

    <!-- Side Content and Product -->
    <section class="content content-boxed">
        <div class="row">
            <div class="col-lg-3">
                <!-- Buttons which toggles side nav content content in smaller screens -->
                <!-- Toggle class helper (for .js-nav-content below), functionality initialized in App() -> uiToggleClass() -->
                <div class="block hidden-lg">
                    <div class="block-content">
                        <button class="btn btn-sm btn-block btn-default push" type="button" data-toggle="class-toggle" data-target=".js-nav-content" data-class="visible-lg">
                            <i class="fa fa-list-ul push-5-r"></i> Navigation
                        </button>
                    </div>
                </div>

                <!-- Side Content -->
                <div class="js-nav-content visible-lg">
                    <!-- Categories -->
                    <div class="block">
                        <div class="block-content">
                            <ul class="nav nav-pills nav-stacked push">
                                <li class="active">
                                    <a href="javascript:void(0)"><span class="badge pull-right">7k</span> Icons</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><span class="badge pull-right">2k</span> Apps</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><span class="badge pull-right">3k</span> Games</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><span class="badge pull-right">18k</span> Graphics</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><span class="badge pull-right">2k</span> Services</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><span class="badge pull-right">12k</span> UI Kits</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><span class="badge pull-right">6k</span> Themes</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- END Categories -->

                    <!-- Best Authors -->
                    <div class="block">
                        <a class="block block-link-hover3 block-transparent remove-margin-b" href="javascript:void(0)">
                            <div class="block-content block-content-full clearfix">
                                <div class="pull-right">
                                    <img class="img-avatar" src="/img/avatars/avatar.jpg" alt="">
                                </div>
                                <div class="pull-left push-10-t">
                                    <div class="font-w600 push-5">Julia Cole</div>
                                    <div class="text-muted">50k Sales</div>
                                </div>
                            </div>
                        </a>
                        <a class="block block-link-hover3 block-transparent remove-margin-b" href="javascript:void(0)">
                            <div class="block-content block-content-full clearfix">
                                <div class="pull-right">
                                    <img class="img-avatar" src="/img/avatars/avatar.jpg" alt="">
                                </div>
                                <div class="pull-left push-10-t">
                                    <div class="font-w600 push-5">Dennis Ross</div>
                                    <div class="text-muted">48k Sales</div>
                                </div>
                            </div>
                        </a>
                        <a class="block block-link-hover3 block-transparent remove-margin-b" href="javascript:void(0)">
                            <div class="block-content block-content-full clearfix">
                                <div class="pull-right">
                                    <img class="img-avatar" src="/img/avatars/avatar.jpg" alt="">
                                </div>
                                <div class="pull-left push-10-t">
                                    <div class="font-w600 push-5">Judy Alvarez</div>
                                    <div class="text-muted">35k Sales</div>
                                </div>
                            </div>
                        </a>
                        <a class="block block-link-hover3 block-transparent remove-margin-b" href="javascript:void(0)">
                            <div class="block-content block-content-full clearfix">
                                <div class="pull-right">
                                    <img class="img-avatar" src="/img/avatars/avatar.jpg" alt="">
                                </div>
                                <div class="pull-left push-10-t">
                                    <div class="font-w600 push-5">Ronald George</div>
                                    <div class="text-muted">31k Sales</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- END Best Authors -->
                </div>
                <!-- END Side Content -->
            </div>
            <div class="col-lg-9">
                <!-- Product -->
                <div class="block">
                    <div class="block-content">
                        <div class="row items-push">
                            <div class="col-sm-6">
                                <!-- Images -->
                                <div class="row js-gallery">
                                    <div class="col-xs-12 push-10">
                                        <a class="img-link" href="">
                                            <img class="img-responsive" src="" alt="">
                                            {{-- {{ $item->img->url() }} --}}
                                        </a>
                                    </div>
                                    @if ($item->images->count() > 0)
                                        @foreach ($item->images as $image)
                                            <div class="col-xs-4">
                                                <a class="img-link" href="{{ $image->img->url() }}">
                                                    <img class="img-responsive" src="{{ $image->img->url() }}" alt="">
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <!-- END Images -->
                            </div>
                            <div class="col-sm-6">
                                <h1>{{$item->name}}</h1>
                                <hr>
                                <p class="lead">{{$item->short_description}}</p>
                                <!-- Vital Info -->
                                <div class="clearfix">
                                    <div class="pull-right">
                                        <span class="h2 font-w700 text-success">{{$item->unit_price}}</span>
                                    </div>
                                    <span class="h5">
                                        <span class="font-w600 text-success">IN STOCK</span><br>
                                        {{-- <small>200 Available</small> TODO: Don't show Available, only show left if quantity is less than 10 --}}
                                    </span>
                                </div>
                                <hr>

                                <p>{{$item->long_description}}</p>
                                <!-- END Vital Info -->
                            </div>

                            @if ($item->creator)
                                <div class="col-xs-12">
                                    <!-- Author -->
                                    <div class="block block-rounded remove-margin-b">
                                        <div class="block-content block-content-full bg-gray-lighter clearfix">
                                            <div class="pull-right">
                                                <img class="img-avatar" src="" alt="">
                                            </div>
                                            <div class="pull-left push-5-t">
                                                <div class="push-10">
                                                    By <a class="font-w600" href="javascript:void(0)">{{ $item->creator->name }}</a>
                                                </div>
                                                <div>
                                                    <a class="btn btn-sm btn-default" href="javascript:void(0)"><i class="fa fa-plus push-5-r"></i> Follow</a>
                                                    <a class="btn btn-sm btn-default" href="javascript:void(0)"><i class="fa fa-envelope"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <!-- END Author -->

                            <div class="col-xs-12">
                                <!-- Extra Info -->
                                <div class="block">
                                    <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs">

                                        @if($item->properties->count())
                                            <li class="active">
                                                <a href="#ecom-product-info">Info</a>
                                            </li>
                                        @endif

                                        <li>
                                            <a href="#ecom-product-comments">Questions &amp; Answers</a>
                                        </li>

                                        @php

                                        $avg = floatval(number_format ($item->reviews()->avg('rating'), 2));
                                        $int = floor($avg);
                                        @endphp

                                        <li>
                                            <a href="#ecom-product-reviews"> Customer Reviews &nbsp;
                                                <small>
                                                    <span class="text-warning pull-right">
                                                        <i class="fa @if($int >= 1) fa-star @else fa-star-0 @endif">
                                                        </i>
                                                        {{ $avg }}
                                                    </span>
                                                </small>
                                            </a>
                                        </li>

                                    </ul>
                                    <div class="block-content tab-content">

                                        @if($item->properties->count())
                                            <!-- Info -->
                                            <div class="tab-pane pull-r-l active" id="ecom-product-info">
                                                <table class="table table-striped table-borderless remove-margin-b">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="2">File Formats</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($item->properties as $property)
                                                            <tr>
                                                                <td style="width: 20%;">Sketch</td>
                                                                <td>
                                                                    <i class="fa fa-check text-success"></i>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <table class="table table-striped table-borderless remove-margin-b">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="2">Extra</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($item->properties as $property)
                                                            <tr>
                                                                <td style="width: 20%;"><i class="fa fa-calendar text-muted push-5-r"></i> {{ $property->property }} </td>
                                                                <td> {{ $property->value }} </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- END Info -->
                                        @endif

                                        <!-- Comments -->
                                        <div class="tab-pane pull-r-l" id="ecom-product-comments">

                                            {{-- onsubmit="return false;" --}}
                                            <form class="form-horizontal remove-margin-b" action="{{ route('faq', [request()->route('profile'), request()->route('item')]) }}" method="post">
                                                {{ csrf_field() }}
                                                <input class="form-control" type="text" name="question" placeholder="Ask your questions here and get answers!">
                                            </form>

                                            @foreach ($item->faqs->where('item_faq_id', null) as $faq)
                                                <div class="media push-15">
                                                    <div class="media-left">
                                                        <a href="javascript:void(0)">
                                                            <img class="img-avatar img-avatar" src="" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="media-body font-s13">
                                                        <a class="font-w600" href="javascript:void(0)">{{ $faq->profile->name }}</a>
                                                        {{-- <mark class="font-w600 font-s13 text-danger">Purchased</mark> --}}
                                                        <div class="push-5">{{ $faq->comment }}</div>
                                                        <div class="font-s12">
                                                            {{-- <a href="javascript:void(0)">Like!</a> - --}}
                                                            @if ($faq->profile_id != Auth::user()->profile_id)
                                                                <a href="javascript:void(0)">Reply</a> -
                                                            @else
                                                                <a href="javascript:void(0)" class="text-danger">Delete</a> -
                                                            @endif

                                                            <span class="text-muted"><em>{{ $faq->created_at->diffForHumans() }} </em></span>
                                                        </div>

                                                        @foreach ($faq->responses as $response)
                                                            <div class="media push-10">
                                                                <div class="media-left">
                                                                    <a href="javascript:void(0)">
                                                                        <img class="img-avatar img-avatar" src="" alt="">
                                                                    </a>
                                                                </div>
                                                                <div class="media-body font-s13">
                                                                    <a class="font-w600" href="javascript:void(0)">{{ $response->profile->name }}</a>
                                                                    {{-- <mark class="font-w600 font-s13 text-success">Author</mark> --}}
                                                                    <div class="push-5">{{ $response->comment }}</div>
                                                                    <div class="font-s12">
                                                                        <span class="text-muted"><em>{{ $response->created_at->diffForHumans() }}</em></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                        <!-- END Comments -->

                                        <!-- Reviews -->
                                        <div class="tab-pane pull-r-l" id="ecom-product-reviews">
                                            <!-- Average Rating -->
                                            <div class="block block-rounded">
                                                {{-- <form class="form-horizontal remove-margin-b" action="{{ route('faq', [request()->route('profile'), request()->route('item')]) }}" method="post">
                                                    {{ csrf_field() }}

                                                    <input class="form-control" type="text" name="question" placeholder="Ask your questions here and get answers!">
                                                </form> --}}

                                                <div class="block-content bg-gray-lighter text-center">
                                                    <p class="h2 text-warning push-10">

                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <a href="{{ route('rate', [request()->route('profile'), request()->route('item'), $i]) }}">
                                                                @if ($int < $i)
                                                                    <i class="fa fa-star-o"></i>
                                                                @else
                                                                    <i class="fa fa-star"></i>
                                                                @endif
                                                            </a>
                                                        @endfor
                                                    </p>
                                                    <p>
                                                        Average <strong>{{ $avg }} out of 5</strong>. <br><small>{{ $item->reviews()->count() }} reviews in total.</small>
                                                    </p>
                                                </div>
                                            </div>
                                            <!-- END Average Rating -->

                                            <!-- Ratings -->
                                            @foreach ($item->reviews as $review)
                                                <div class="media push-15">
                                                    <div class="media-left">
                                                        <a href="javascript:void(0)">
                                                            <img class="img-avatar img-avatar" src="" alt="">
                                                        </a>
                                                    </div>

                                                    @php
                                                    $individualRate = $review->rating
                                                    @endphp

                                                    <div class="media-body font-s13">
                                                        <span class="text-warning">
                                                            <i class="fa @if($individualRate >= 1) fa-star @else fa-star-0 @endif"></i>
                                                                <i class="fa @if($individualRate >= 2) fa-star @else fa-star-0 @endif"></i>
                                                                    <i class="fa @if($individualRate >= 3) fa-star @else fa-star-0 @endif"></i>
                                                                        <i class="fa @if($individualRate >= 4) fa-star @else fa-star-0 @endif"></i>
                                                                            <i class="fa @if($individualRate >= 5) fa-star @else fa-star-0 @endif"></i>
                                                                            </span>
                                                                            <a class="font-w600" href="javascript:void(0)">{{ $review->profile->name }}</a>
                                                                            <div class="push-5">{{ $review->profile->review }}</div>
                                                                            <div class="font-s12">
                                                                                <span class="text-muted"><em>{{ $review->profile->created_at->diffForHumans() }}</em></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach

                                                                <!-- END Ratings -->
                                                            </div>
                                                            <!-- END Reviews -->
                                                        </div>
                                                    </div>
                                                    <!-- END Extra Info -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END Product -->
                                </div>
                            </div>
                        </section>

                    @endsection
