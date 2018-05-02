@extends('layouts.web')

@section('content')

        <!-- User Header -->
        {{-- <div class="block">
            <!-- Basic Info -->
            <div class="bg-image" style="background-image: url('/img/photos/photo25@2x.jpg');">
                <div class="block-content bg-primary-dark-op clearfix">
                    <div class="pull-left push">
                        <img class="img-avatar img-avatar-thumb" src="/img/avatars/avatar.jpg" alt="">
                    </div>
                    <div class="pull-left push-15-t push-15-l">
                        <h2 class="h4 font-w600 text-white push-5">{{ $profile->name }}</h2>
                        <h3 class="h5 text-white-op"><em>{{ $profile->created_at }}</em></h3>
                    </div>
                </div>
            </div>
            <!-- END Basic Info -->
        </div> --}}
        <!-- END User Header -->

        <!-- Main Content -->
        <div class="row content">
            <div class="col-sm-4 col-lg-3">
                <!-- Social Menu -->
                <div class="block">
                    <div class="block-content">
                        <div class="font-w600 font-s12 text-uppercase text-muted push-10">Home</div>
                        <ul class="nav nav-pills nav-stacked push">
                            <li class="active">
                                <a href="{{ route('news') }}"><i class="fa fa-fw fa-newspaper-o push-5-r"></i> News Feed</a>
                            </li>
                            <li>
                                <a href="{{ route('messages.index') }}"><span class="badge pull-right">3</span><i class="fa fa-fw fa-envelope push-5-r"></i> Messages</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><i class="fa fa-fw fa-pencil push-5-r"></i> Events</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><i class="fa fa-fw fa-photo push-5-r"></i> Photos</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><i class="fa fa-fw fa-search push-5-r"></i> Browse</a>
                            </li>
                        </ul>
                        <div class="font-w600 font-s12 text-uppercase text-muted push-10">Pages</div>
                        <ul class="nav nav-pills nav-stacked font-s13 push">
                            <li>
                                <a href="javascript:void(0)"><span class="badge pull-right">1</span>Nature Lovers</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><span class="badge pull-right">6</span>Gaming Studio</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><span class="badge pull-right">9</span>Funny &amp; More</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><span class="badge pull-right">4</span>Funny Stories</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><span class="badge pull-right">5</span>Dreamers</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><span class="badge pull-right">1</span>Video Games</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><span class="badge pull-right">2</span>Photographers</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- END Social Menu -->
            </div>
            <div class="col-sm-8 col-lg-6">
                <!-- Social Timeline -->
                <!-- Update 1 -->
                <div class="block">
                    <div class="block-header">
                        <ul class="block-options">
                            <li class="dropdown">
                                <button type="button" data-toggle="dropdown">
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right font-s13">
                                    <li>
                                        <a tabindex="-1" href="javascript:void(0)">
                                            <i class="fa fa-times text-danger push-5-r"></i>
                                            Hide similar posts
                                        </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="javascript:void(0)">
                                            <i class="fa fa-thumbs-down text-warning push-5-r"></i>
                                            Stop following this user
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a tabindex="-1" href="javascript:void(0)">
                                            <i class="fa fa-warning push-5-r"></i>
                                            Report this post
                                        </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="javascript:void(0)">
                                            <i class="fa fa-bookmark push-5-r"></i>
                                            Bookmark this post
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <div class="clearfix">
                            <div class="pull-left push-15-r">
                                <img class="img-avatar img-avatar48" src="/img/avatars/avatar1.jpg" alt="">
                            </div>
                            <div class="push-5-t">
                                <a class="font-w600" href="javascript:void(0)">Helen Silva</a><br>
                                <span class="font-s12 text-muted">2 hours ago</span>
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full">
                        <p class="push-10 pull-t">We had an awesome time! Roadtrip for ever!</p>
                        <img class="img-responsive" src="/img/photos/photo19.jpg" alt="">
                        <hr>
                        <div class="row text-center font-s13">
                            <div class="col-xs-4">
                                <a class="font-w600 text-gray-dark" href="javascript:void(0)">
                                    <i class="fa fa-thumbs-up push-5-r"></i>
                                    <span class="hidden-xs">Like!</span>
                                </a>
                            </div>
                            <div class="col-xs-4">
                                <a class="font-w600 text-gray-dark" href="javascript:void(0)">
                                    <i class="fa fa-comment push-5-r"></i>
                                    <span class="hidden-xs">Comment</span>
                                </a>
                            </div>
                            <div class="col-xs-4">
                                <a class="font-w600 text-gray-dark" href="javascript:void(0)">
                                    <i class="fa fa-share-alt push-5-r"></i>
                                    <span class="hidden-xs">Share</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full bg-gray-lighter">
                        <!-- Comments -->
                        <div class="media push-15">
                            <div class="media-left">
                                <a href="javascript:void(0)">
                                    <img class="img-avatar img-avatar32" src="/img/avatars/avatar3.jpg" alt="">
                                </a>
                            </div>
                            <div class="media-body font-s13">
                                <a class="font-w600" href="javascript:void(0)">Megan Dean</a>
                                <div class="push-5">It was awesome! Looking forward for the new roadtrip!</div>
                                <div class="font-s12">
                                    <a href="javascript:void(0)">Like!</a> -
                                    <a href="javascript:void(0)">Reply</a> -
                                    <span class="text-muted"><em>10 min ago</em></span>
                                </div>
                                <div class="media push-10">
                                    <div class="media-left">
                                        <a href="javascript:void(0)">
                                            <img class="img-avatar img-avatar32" src="/img/avatars/avatar2.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body font-s13">
                                        <a class="font-w600" href="javascript:void(0)">Ann Parker</a>
                                        <div class="push-5">Yes!!</div>
                                        <div class="font-s12">
                                            <a href="javascript:void(0)">Like!</a> -
                                            <a href="javascript:void(0)">Reply</a> -
                                            <span class="text-muted"><em>15 min ago</em></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="media push-15">
                            <div class="media-left">
                                <a href="javascript:void(0)">
                                    <img class="img-avatar img-avatar32" src="/img/avatars/avatar12.jpg" alt="">
                                </a>
                            </div>
                            <div class="media-body font-s13">
                                <a class="font-w600" href="javascript:void(0)">Bruce Edwards</a>
                                <div class="push-5">Really nice!</div>
                                <div class="font-s12">
                                    <a href="javascript:void(0)">Like!</a> -
                                    <a href="javascript:void(0)">Reply</a> -
                                    <span class="text-muted"><em>20 min ago</em></span>
                                </div>
                            </div>
                        </div>
                        <!-- END Comments -->

                        <!-- Post Comment -->
                        <form class="form-horizontal" action="base_ui_timeline_social.html" method="post" onsubmit="return false;">
                            <input class="form-control" type="text" placeholder="Write a comment..">
                        </form>
                        <!-- END Post Comment -->
                    </div>
                </div>
                <!-- END Update 1 -->

                <!-- Update 2 -->
                <div class="block">
                    <div class="block-header">
                        <ul class="block-options">
                            <li class="dropdown">
                                <button type="button" data-toggle="dropdown">
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right font-s13">
                                    <li>
                                        <a tabindex="-1" href="javascript:void(0)">
                                            <i class="fa fa-times text-danger push-5-r"></i>
                                            Hide similar posts
                                        </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="javascript:void(0)">
                                            <i class="fa fa-thumbs-down text-warning push-5-r"></i>
                                            Stop following this user
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a tabindex="-1" href="javascript:void(0)">
                                            <i class="fa fa-warning push-5-r"></i>
                                            Report this post
                                        </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="javascript:void(0)">
                                            <i class="fa fa-bookmark push-5-r"></i>
                                            Bookmark this post
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <div class="clearfix">
                            <div class="pull-left push-15-r">
                                <img class="img-avatar img-avatar48" src="/img/avatars/avatar9.jpg" alt="">
                            </div>
                            <div class="push-5-t">
                                <a class="font-w600" href="javascript:void(0)">Jack Greene</a><br>
                                <span class="font-s12 text-muted">5 hours ago</span>
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full">
                        <p class="push-10 pull-t">Finally, the project is almost finished! Can't wait to show you what we've created!</p>
                        <hr>
                        <div class="row text-center font-s13">
                            <div class="col-xs-4">
                                <a class="font-w600 text-gray-dark" href="javascript:void(0)">
                                    <i class="fa fa-thumbs-up push-5-r"></i>
                                    <span class="hidden-xs">Like!</span>
                                </a>
                            </div>
                            <div class="col-xs-4">
                                <a class="font-w600 text-gray-dark" href="javascript:void(0)">
                                    <i class="fa fa-comment push-5-r"></i>
                                    <span class="hidden-xs">Comment</span>
                                </a>
                            </div>
                            <div class="col-xs-4">
                                <a class="font-w600 text-gray-dark" href="javascript:void(0)">
                                    <i class="fa fa-share-alt push-5-r"></i>
                                    <span class="hidden-xs">Share</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full bg-gray-lighter">
                        <!-- Post Comment -->
                        <form class="form-horizontal" action="base_ui_timeline_social.html" method="post" onsubmit="return false;">
                            <input class="form-control" type="text" placeholder="Write a comment..">
                        </form>
                        <!-- END Post Comment -->
                    </div>
                </div>
                <!-- END Update 2 -->

                <!-- Update 3 -->
                <div class="block">
                    <div class="block-header">
                        <ul class="block-options">
                            <li class="dropdown">
                                <button type="button" data-toggle="dropdown">
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right font-s13">
                                    <li>
                                        <a tabindex="-1" href="javascript:void(0)">
                                            <i class="fa fa-times text-danger push-5-r"></i>
                                            Hide similar posts
                                        </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="javascript:void(0)">
                                            <i class="fa fa-thumbs-down text-warning push-5-r"></i>
                                            Stop following this user
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a tabindex="-1" href="javascript:void(0)">
                                            <i class="fa fa-warning push-5-r"></i>
                                            Report this post
                                        </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="javascript:void(0)">
                                            <i class="fa fa-bookmark push-5-r"></i>
                                            Bookmark this post
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <div class="clearfix">
                            <div class="pull-left push-15-r">
                                <img class="img-avatar img-avatar48" src="/img/avatars/avatar13.jpg" alt="">
                            </div>
                            <div class="push-5-t">
                                <a class="font-w600" href="javascript:void(0)">George Stone</a><br>
                                <span class="font-s12 text-muted">1 day ago</span>
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full">
                        <p class="push-10 pull-t">Photos from our last trip! We had a great time!</p>
                        <!-- Gallery (.js-gallery class is initialized in App() -> uiHelperMagnific()) -->
                        <!-- For more info and examples you can check out http://dimsemenov.com/plugins/magnific-popup/ -->
                        <div class="row js-gallery">
                            <div class="col-xs-6">
                                <a class="img-link" href="/img/photos/photo25@2x.jpg">
                                    <img class="img-responsive" src="/img/photos/photo25.jpg" alt="">
                                </a>
                            </div>
                            <div class="col-xs-6">
                                <a class="img-link" href="/img/photos/photo27@2x.jpg">
                                    <img class="img-responsive" src="/img/photos/photo27.jpg" alt="">
                                </a>
                            </div>
                        </div>
                        <hr>
                        <div class="row text-center font-s13">
                            <div class="col-xs-4">
                                <a class="font-w600 text-gray-dark" href="javascript:void(0)">
                                    <i class="fa fa-thumbs-up push-5-r"></i>
                                    <span class="hidden-xs">Like!</span>
                                </a>
                            </div>
                            <div class="col-xs-4">
                                <a class="font-w600 text-gray-dark" href="javascript:void(0)">
                                    <i class="fa fa-comment push-5-r"></i>
                                    <span class="hidden-xs">Comment</span>
                                </a>
                            </div>
                            <div class="col-xs-4">
                                <a class="font-w600 text-gray-dark" href="javascript:void(0)">
                                    <i class="fa fa-share-alt push-5-r"></i>
                                    <span class="hidden-xs">Share</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full bg-gray-lighter">
                        <!-- Comments -->
                        <div class="media push-15">
                            <div class="media-left">
                                <a href="javascript:void(0)">
                                    <img class="img-avatar img-avatar32" src="/img/avatars/avatar4.jpg" alt="">
                                </a>
                            </div>
                            <div class="media-body font-s13">
                                <a class="font-w600" href="javascript:void(0)">Ashley Welch</a>
                                <div class="push-5">Awesome photos!</div>
                                <div class="font-s12">
                                    <a href="javascript:void(0)">Like!</a> -
                                    <a href="javascript:void(0)">Reply</a> -
                                    <span class="text-muted"><em>1 day ago</em></span>
                                </div>
                            </div>
                        </div>
                        <!-- END Comments -->

                        <!-- Post Comment -->
                        <form class="form-horizontal" action="base_ui_timeline_social.html" method="post" onsubmit="return false;">
                            <input class="form-control" type="text" placeholder="Write a comment..">
                        </form>
                        <!-- END Post Comment -->
                    </div>
                </div>
                <!-- END Update 3 -->

                <!-- Update 4 -->
                <div class="block">
                    <div class="block-header">
                        <ul class="block-options">
                            <li class="dropdown">
                                <button type="button" data-toggle="dropdown">
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right font-s13">
                                    <li>
                                        <a tabindex="-1" href="javascript:void(0)">
                                            <i class="fa fa-times text-danger push-5-r"></i>
                                            Hide similar posts
                                        </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="javascript:void(0)">
                                            <i class="fa fa-thumbs-down text-warning push-5-r"></i>
                                            Stop following this user
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a tabindex="-1" href="javascript:void(0)">
                                            <i class="fa fa-warning push-5-r"></i>
                                            Report this post
                                        </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="javascript:void(0)">
                                            <i class="fa fa-bookmark push-5-r"></i>
                                            Bookmark this post
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <div class="clearfix">
                            <div class="pull-left push-15-r">
                                <img class="img-avatar img-avatar48" src="/img/avatars/avatar5.jpg" alt="">
                            </div>
                            <div class="push-5-t">
                                <a class="font-w600" href="javascript:void(0)">Tiffany Kim</a><br>
                                <span class="font-s12 text-muted">3 days ago</span>
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full">
                        <p class="push-10 pull-t">Get started with HTML!</p>
                        <pre class="pre-sh"><code class="html hljs xml"><span class="hljs-meta">&lt;!doctype html&gt;</span>
                            <span class="hljs-tag">&lt;<span class="hljs-name">html</span>&gt;</span>
                            <span class="hljs-tag">&lt;<span class="hljs-name">head</span>&gt;</span>
                            <span class="hljs-tag">&lt;<span class="hljs-name">meta</span> <span class="hljs-attr">charset</span>=<span class="hljs-string">"utf-8"</span>&gt;</span>

                            <span class="hljs-tag">&lt;<span class="hljs-name">title</span>&gt;</span>Title<span class="hljs-tag">&lt;/<span class="hljs-name">title</span>&gt;</span>
                            <span class="hljs-tag">&lt;/<span class="hljs-name">head</span>&gt;</span>
                            <span class="hljs-tag">&lt;<span class="hljs-name">body</span>&gt;</span>
                            <span class="hljs-comment">&lt;!-- Your content --&gt;</span>
                            <span class="hljs-tag">&lt;/<span class="hljs-name">body</span>&gt;</span>
                            <span class="hljs-tag">&lt;/<span class="hljs-name">html</span>&gt;</span></code></pre>
                            <hr>
                            <div class="row text-center font-s13">
                                <div class="col-xs-4">
                                    <a class="font-w600 text-gray-dark" href="javascript:void(0)">
                                        <i class="fa fa-thumbs-up push-5-r"></i>
                                        <span class="hidden-xs">Like!</span>
                                    </a>
                                </div>
                                <div class="col-xs-4">
                                    <a class="font-w600 text-gray-dark" href="javascript:void(0)">
                                        <i class="fa fa-comment push-5-r"></i>
                                        <span class="hidden-xs">Comment</span>
                                    </a>
                                </div>
                                <div class="col-xs-4">
                                    <a class="font-w600 text-gray-dark" href="javascript:void(0)">
                                        <i class="fa fa-share-alt push-5-r"></i>
                                        <span class="hidden-xs">Share</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="block-content block-content-full bg-gray-lighter">
                            <!-- Post Comment -->
                            <form class="form-horizontal" action="base_ui_timeline_social.html" method="post" onsubmit="return false;">
                                <input class="form-control" type="text" placeholder="Write a comment..">
                            </form>
                            <!-- END Post Comment -->
                        </div>
                    </div>
                    <!-- END Update 4 -->
                    <!-- END Social Timeline -->
                </div>
                <div class="col-sm-12 col-lg-3">
                    <!-- Suggestions -->
                    <div class="block block-bordered block-rounded">
                        <div class="block-content">
                            <div class="push-10">
                                <img class="img-responsive" src="/img/photos/photo2.jpg" alt="">
                            </div>
                            <div class="push-10 clearfix">
                                <a class="btn btn-default pull-right push-10-l" href="javascript:void(0)"><i class="fa fa-plus"></i></a>
                                <a class="font-w600" href="javascript:void(0)">Best Travel Photos</a>
                                <div class="font-s12 text-muted">19k Members</div>
                            </div>
                        </div>
                    </div>
                    <div class="block block-bordered block-rounded">
                        <div class="block-content">
                            <div class="push-10">
                                <img class="img-responsive" src="/img/photos/photo6.jpg" alt="">
                            </div>
                            <div class="push-10 clearfix">
                                <a class="btn btn-default pull-right push-10-l" href="javascript:void(0)"><i class="fa fa-plus"></i></a>
                                <a class="font-w600" href="javascript:void(0)">Mountain Lovers</a>
                                <div class="font-s12 text-muted">59k Members</div>
                            </div>
                        </div>
                    </div>
                    <!-- END Suggestions -->
                </div>
            </div>
        </div>

    @endsection
