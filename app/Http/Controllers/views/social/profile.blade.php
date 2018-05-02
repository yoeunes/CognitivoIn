@extends('layouts.web')

@section('content')

    <div class="content bg-image" style="background-image: url('/img/photos/photo8@2x.jpg');">
        <div class="push-15 clearfix">
            <div class="push-15-r pull-left animated fadeIn">
                {{-- <img class="img-avatar img-avatar-thumb" src="/img/avatars/avatar.jpg" alt=""> --}}
            </div>
            <h1 class="h2 text-white push-5-t animated zoomIn">{{ $profile->name }}</h1>
            <h2 class="h5 text-white-op animated zoomIn">{{ $profile->slug }}</h2>
        </div>
    </div>

    <div class="content bg-white border-b">
        <div class="row items-push text-uppercase">
            <div class="col-xs-6 col-6">
                <div class="font-w700 text-gray-darker animated fadeIn">{{ $profile->type == 1 ? 'About Me' : 'About Us' }}</div>
                <span>
                    {{ $profile->short_description ??
                        ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ac augue quis nibh malesuada commodo. Aenean mollis, arcu at consequat laoreet, ante mi tincidunt velit, vel molestie mi libero a nulla. Nunc felis sem, fermentum eu tincidunt a, euismod at quam. Mauris quis lorem urna. Sed porttitor vitae erat sed dictum. Sed condimentum faucibus eros, at auctor nunc faucibus quis. Vivamus gravida felis vel. '
                    }}
                </span>
            </div>
            <div class="col-xs-3 col-3">

            </div>
            <div class="col-xs-1 col-1">
                <div class="font-w700 text-gray-darker animated fadeIn">Following</div>
                <a class="h2 font-w300 text-primary animated flipInX" href="javascript:void(0)">{{ $profile->followings()->count() }}</a>
            </div>
            <div class="col-xs-1 col-1">
                <div class="font-w700 text-gray-darker animated fadeIn">Followers</div>
                <a class="h2 font-w300 text-primary animated flipInX" href="javascript:void(0)">{{ $profile->followers()->count() }}</a>
            </div>
            <div class="col-xs-1 col-1">
{{--
                @if ($profile->isFollowedBy(Auth::user()))
                    <button type="button" name="button">Stop Following</button>
                @else
                    <button type="button" name="button">Follow</button>
                @endif --}}

                <router-view name="Follow"  :user="{{ Auth::user()->profile_id }}" :profile=" {{ $profile->id }}"/>


                {{-- <div class="font-w700 text-gray-darker animated fadeIn">739 Ratings</div>
                <div class="text-warning push-10-t animated flipInX">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-half-o"></i>
                <span class="text-muted">(4.9)</span>
            </div> --}}
        </div>
    </div>
</div>

<div class="content content-boxed">
    <div class="row">
        <div class="col-sm-7 col-lg-8">
            <!-- Timeline -->
            <div class="block">
                <div class="block-header bg-gray-lighter">
                </div>
                <div class="block-content">
                    <ul class="list list-timeline pull-t">
                        <!-- Facebook Notification -->
                        <li>
                            <div class="list-timeline-time">3 hrs ago</div>
                            <i class="fa fa-facebook list-timeline-icon bg-default"></i>
                            <div class="list-timeline-content">
                                <p class="font-w600">+ 290 Page Likes</p>
                                <p class="font-s13">This is great, keep it up!</p>
                            </div>
                        </li>
                        <!-- END Facebook Notification -->

                        <!-- Generic Notification -->
                        <li>
                            <div class="list-timeline-time">4 hrs ago</div>
                            <i class="fa fa-briefcase list-timeline-icon bg-modern"></i>
                            <div class="list-timeline-content">
                                <p class="font-w600">3 New Products were added!</p>
                                <div class="push-10-t">
                                    <a class="item item-rounded push-10-r bg-info" data-toggle="tooltip" title="" href="javascript:void(0)" data-original-title="MyPanel">
                                        <i class="si si-rocket text-white-op"></i>
                                    </a>
                                    <a class="item item-rounded push-10-r bg-amethyst" data-toggle="tooltip" title="" href="javascript:void(0)" data-original-title="Project Time">
                                        <i class="si si-calendar text-white-op"></i>
                                    </a>
                                    <a class="item item-rounded push-10-r bg-city" data-toggle="tooltip" title="" href="javascript:void(0)" data-original-title="iDashboard">
                                        <i class="si si-speedometer text-white-op"></i>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <!-- END Generic Notification -->

                        <!-- Twitter Notification -->
                        <li>
                            <div class="list-timeline-time">12 hrs ago</div>
                            <i class="fa fa-twitter list-timeline-icon bg-info"></i>
                            <div class="list-timeline-content">
                                <p class="font-w600">+ 1150 Followers</p>
                                <p class="font-s13">You’re getting more and more followers, keep it up!</p>
                            </div>
                        </li>
                        <!-- END Twitter Notification -->

                        <!-- System Notification -->
                        <li>
                            <div class="list-timeline-time">1 day ago</div>
                            <i class="fa fa-database list-timeline-icon bg-smooth"></i>
                            <div class="list-timeline-content">
                                <p class="font-w600">Database backup completed!</p>
                                <p class="font-s13">Download the <a href="javascript:void(0)">latest backup</a>.</p>
                            </div>
                        </li>
                        <!-- END System Notification -->

                        <!-- Social Notification -->
                        <li>
                            <div class="list-timeline-time">2 days ago</div>
                            <i class="fa fa-user-plus list-timeline-icon bg-success"></i>
                            <div class="list-timeline-content">
                                <p class="font-w600">+ 5 Friend Requests</p>
                                <ul class="nav-users push-10-t push">
                                    <li>
                                        <a href="base_pages_profile.html">
                                            <img class="img-avatar" src="/img/avatars/avatar2.jpg" alt="">
                                            <i class="fa fa-circle text-success"></i> Helen Silva
                                            <div class="font-w400 text-muted"><small>Web Designer</small></div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="base_pages_profile.html">
                                            <img class="img-avatar" src="/img/avatars/avatar11.jpg" alt="">
                                            <i class="fa fa-circle text-success"></i> Roger Hart
                                            <div class="font-w400 text-muted"><small>Graphic Designer</small></div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="base_pages_profile.html">
                                            <img class="img-avatar" src="/img/avatars/avatar6.jpg" alt="">
                                            <i class="fa fa-circle text-warning"></i> Linda Moore
                                            <div class="font-w400 text-muted"><small>Photographer</small></div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="base_pages_profile.html">
                                            <img class="img-avatar" src="/img/avatars/avatar11.jpg" alt="">
                                            <i class="fa fa-circle text-warning"></i> Roger Hart
                                            <div class="font-w400 text-muted"><small>Copywriter</small></div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="base_pages_profile.html">
                                            <img class="img-avatar" src="/img/avatars/avatar10.jpg" alt="">
                                            <i class="fa fa-circle text-danger"></i> Walter Fox
                                            <div class="font-w400 text-muted"><small>UI Designer</small></div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- END Social Notification -->

                        <!-- System Notification -->
                        <li>
                            <div class="list-timeline-time">1 week ago</div>
                            <i class="fa fa-cog list-timeline-icon bg-primary-dark"></i>
                            <div class="list-timeline-content">
                                <p class="font-w600">System updated to v2.02</p>
                                <p class="font-s13">Check the complete changelog at the <a href="javascript:void(0)">activity page</a>.</p>
                            </div>
                        </li>
                        <!-- END System Notification -->

                        <!-- Generic Notification -->
                        <li>
                            <div class="list-timeline-time">2 weeks ago</div>
                            <i class="fa fa-briefcase list-timeline-icon bg-modern"></i>
                            <div class="list-timeline-content">
                                <p class="font-w600">1 New Product was added!</p>
                                <div class="push-10-t">
                                    <a class="item item-rounded push-10-r bg-modern" data-toggle="tooltip" title="" href="javascript:void(0)" data-original-title="eSettings">
                                        <i class="si si-settings text-white-op"></i>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <!-- END Generic Notification -->

                        <!-- System Notification -->
                        <li>
                            <div class="list-timeline-time">2 months ago</div>
                            <i class="fa fa-cog list-timeline-icon bg-primary-dark"></i>
                            <div class="list-timeline-content">
                                <p class="font-w600">System updated to v2.01</p>
                                <p class="font-s13">Check the complete changelog at the <a href="javascript:void(0)">activity page</a>.</p>
                            </div>
                        </li>
                        <!-- END System Notification -->
                    </ul>
                </div>
            </div>
            <!-- END Timeline -->
        </div>
        @if ($profile->type == 2)
            <div class="col-sm-5 col-lg-4">
                <!-- Products -->
                <div class="block">
                    <div class="block-header bg-gray-lighter">
                        <ul class="block-options">
                            <li>
                                <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                            </li>
                        </ul>
                        <h3 class="block-title"><i class="fa fa-fw fa-briefcase"></i> Products</h3>
                    </div>
                    <div class="block-content">
                        <ul class="list list-simple list-li-clearfix">
                            <li>
                                <a class="item item-rounded pull-left push-10-r bg-info" href="javascript:void(0)">
                                    <i class="si si-rocket text-white-op"></i>
                                </a>
                                <h5 class="push-10-t">MyPanel</h5>
                                <div class="font-s13">Responsive App Template</div>
                            </li>
                            <li>
                                <a class="item item-rounded pull-left push-10-r bg-amethyst" href="javascript:void(0)">
                                    <i class="si si-calendar text-white-op"></i>
                                </a>
                                <h5 class="push-10-t">Project Time</h5>
                                <div class="font-s13">Web application</div>
                            </li>
                            <li>
                                <a class="item item-rounded pull-left push-10-r bg-danger" href="javascript:void(0)">
                                    <i class="si si-speedometer text-white-op"></i>
                                </a>
                                <h5 class="push-10-t">iDashboard</h5>
                                <div class="font-s13">Bootstrap Admin Template</div>
                            </li>
                        </ul>
                        <div class="text-center push">
                            <small><a href="javascript:void(0)">View More..</a></small>
                        </div>
                    </div>
                </div>
                <!-- END Products -->

                <!-- Ratings -->
                <div class="block">
                    <div class="block-header bg-gray-lighter">
                        <ul class="block-options">
                            <li>
                                <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                            </li>
                        </ul>
                        <h3 class="block-title"><i class="fa fa-fw fa-pencil"></i> Ratings</h3>
                    </div>
                    <div class="block-content">
                        <ul class="list list-simple">
                            <li>
                                <div class="push-5 clearfix">
                                    <div class="text-warning pull-right">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <a class="font-w600" href="base_pages_profile.html">John Parker</a>
                                    <span class="text-muted">(5/5)</span>
                                </div>
                                <div class="font-s13">Flawless design execution! I'm really impressed with the product, it really helped me build my app so fast! Thank you!</div>
                            </li>
                            <li>
                                <div class="push-5 clearfix">
                                    <div class="text-warning pull-right">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <a class="font-w600" href="base_pages_profile.html">Jack Greene</a>
                                    <span class="text-muted">(5/5)</span>
                                </div>
                                <div class="font-s13">Great value for money and awesome support! Would buy again and again! Thanks!</div>
                            </li>
                            <li>
                                <div class="push-5 clearfix">
                                    <div class="text-warning pull-right">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <a class="font-w600" href="base_pages_profile.html">Joshua Munoz</a>
                                    <span class="text-muted">(5/5)</span>
                                </div>
                                <div class="font-s13">Working great in all my devices, quality and quantity in a great package! Thank you!</div>
                            </li>
                        </ul>
                        <div class="text-center push">
                            <small><a href="javascript:void(0)">Read More..</a></small>
                        </div>
                    </div>
                </div>
                <!-- END Ratings -->

                <!-- Followers -->
                <div class="block">
                    <div class="block-header bg-gray-lighter">
                        <ul class="block-options">
                            <li>
                                <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                            </li>
                        </ul>
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-share-alt"></i> Followers
                        </h3>
                    </div>
                    <div class="block-content">
                        <ul class="nav-users push">
                            @foreach ($profile->followers()->inRandomOrder()->get() as $follower)
                                <li>
                                    <a href="{{ route('profile.show', $follower) }}">
                                        <img class="img-avatar" src="{{ $follower->avatar_file_name }}" alt="">
                                        <i class="fa fa-circle text-success"></i> {{ $follower->name }}
                                        <div class="font-w400 text-muted">
                                            <small>{{ $follower->taxid }}</small>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="text-center push">
                            <small><a href="javascript:void(0)">Load More..</a></small>
                        </div>
                    </div>
                </div>
                <!-- END Followers -->
            </div>
        @else
            <div class="col-sm-5 col-lg-4">

                <!-- Followers -->
                <div class="block">
                    <div class="block-header bg-gray-lighter">
                        <ul class="block-options">
                            <li>
                                <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                            </li>
                        </ul>
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-share-alt"></i> Followers
                        </h3>
                    </div>
                    <div class="block-content">
                        <ul class="nav-users push">
                            @foreach ($profile->followers()->inRandomOrder()->get() as $follower)
                                <li>
                                    <a href="{{ route('profile.show', $follower) }}">
                                        <img class="img-avatar" src="{{ $follower->avatar_file_name }}" alt="">
                                        <i class="fa fa-circle text-success"></i> {{ $follower->name }}
                                        <div class="font-w400 text-muted">
                                            <small>{{ $follower->taxid }}</small>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="text-center push">
                            <small><a href="javascript:void(0)">Load More..</a></small>
                        </div>
                    </div>
                </div>
                <!-- END Followers -->
            </div>
        @endif

    </div>
</div>

@endsection
