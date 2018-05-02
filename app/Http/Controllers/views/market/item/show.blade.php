@extends('layouts.web')

@section('content')
    <div id="addtocart">
        <section class="content content-boxed">
            <input type="hidden" id="slug" value="{{request()->route('profile')->slug}}"/>
            <input type="hidden" id="slugid" value="{{request()->route('profile')->id}}"/>
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
                                    <li>
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
                                        <div class="font-w600 push-5">Evelyn Willis</div>
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
                                        <div class="font-w600 push-5">Joshua Munoz</div>
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
                                        <div class="font-w600 push-5">Evelyn Willis</div>
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
                                        <div class="font-w600 push-5">Walter Fox</div>
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
                    <!-- Sort and Show Filters -->
                    <div class="form-inline clearfix">
                        <select id="ecom-results-show" name="ecom-results-show" class="form-control push pull-right" size="1">
                            <option value="0" disabled selected>SHOW</option>
                            <option value="9">9</option>
                            <option value="18">18</option>
                            <option value="36">36</option>
                            <option value="72">72</option>
                        </select>
                        <select id="ecom-results-sort" name="ecom-results-sort" class="form-control push" size="1">
                            <option value="0" disabled selected>SORT BY</option>
                            <option value="1">Popularity</option>
                            <option value="2">Name (A to Z)</option>
                            <option value="3">Name (Z to A)</option>
                            <option value="4">Price (Lowest to Highest)</option>
                            <option value="5">Price (Highest to Lowest)</option>
                            <option value="6">Sales (Lowest to Highest)</option>
                            <option value="7">Sales (Highest to Lowest)</option>
                        </select>
                    </div>
                    <!-- END Sort and Show Filters -->

                    <!-- Products -->
                    <div class="row">
                        <router-view name="StoreItem"></router-view>

                        <div class="col-xs-12 push">
                            <ul class="pager">
                                <li class="next">
                                    <a href="javascript:void(0)">Next <i class="fa fa-arrow-right"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- END Products -->
                </div>
            </div>
        </section>
    </div>

@endsection
