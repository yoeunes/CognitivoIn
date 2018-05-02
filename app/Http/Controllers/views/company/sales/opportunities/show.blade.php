
@extends('layouts.form')

@section('content')

<div class="content content-mini bg-white">
    <ol class="breadcrumb push">
        <li>
            <a class="link-effect" href="base_pages_projects_dashboard.html">Dashboard</a>
        </li>
        <li>
            Opportunity
        </li>
    </ol>
</div>
<!-- END Page Header -->

<!-- Page Content -->
<div  class="content content-boxed">

    <input type="hidden" id="slug" value="{{request()->route('profile')->slug}}"/>
    <input type="hidden" id="slugid" value="{{request()->route('profile')->id}}"/>

    <div class="row">
        <div class="col-sm-5 col-lg-3">
            <!-- Collapsible Project Options (using Bootstrap collapse functionality) -->
            <button class="btn btn-block btn-primary visible-xs push" data-toggle="collapse" data-target="#project-nav" type="button">Options</button>
            <div class="collapse navbar-collapse remove-padding" id="project-nav">
                <!-- Tasks Info -->
                <div class="block">
                    <div class="block-header bg-gray-lighter">
                        <h3 class="block-title">Tasks</h3>
                    </div>
                    <div class="block-content">
                        <ul class="list-group push">
                            <li class="list-group-item">
                                <span class="js-task-badge badge badge-primary pull-right animated bounceIn">3</span>
                                <i class="fa fa-fw fa-tasks push-5-r"></i> Active
                            </li>
                            <li class="list-group-item">
                                <span class="js-task-badge-starred badge badge-warning pull-right animated bounceIn">2</span>
                                <i class="fa fa-fw fa-star push-5-r"></i> Starred
                            </li>
                            <li class="list-group-item">
                                <span class="js-task-badge-completed badge badge-success pull-right animated bounceIn">3</span>
                                <i class="fa fa-fw fa-check push-5-r"></i> Completed
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- END Tasks Info -->

                <!-- People -->
                <router-view name="OpportunityProduct"></router-view>
                <!-- END People -->

                <!-- Project -->
                <div class="block">
                    <div class="block-header bg-gray-lighter">
                        <ul class="block-options">
                            <li>
                                <span>
                                    <i class="fa fa-circle text-primary"></i>
                                </span>
                            </li>
                        </ul>
                        <h3 class="block-title">Opportunity</h3>
                    </div>
                    <div class="block-content">
                        <h4 class="push-5">{{ $opportunity->relationship->customer_alias }}</h4>
                        <p class="push-10 text-muted">
                            <em>Deadline: {{ $opportunity->deadline_date }}</em>
                        </p>
                        <p>
                            {{ $opportunity->description }}
                        </p>
                    </div>
                </div>
                <!-- END Project -->
            </div>
            <!-- END Collapsible Project Options -->
        </div>
        <div class="col-sm-7 col-lg-9">
            <!-- Tasks functionality (initialized in js/pages/base_pages_projects_view.js) -->
            <div class="js-tasks">
                <!-- Add task -->
                <form id="js-task-form" action="{{ route('opportunity_activities.store', request()->route('profile')) }}" method="post">
                    {{ csrf_field() }}

                    <input type="hidden" id="opportunity_id" name="opportunity_id" value={{ $opportunity->id }} />
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" id="js-task-input" name="name" placeholder="Add task and press enter..">
                        <span class="input-group-addon">
                            <i class="fa fa-plus"></i>
                        </span>
                    </div>
                </form>
                <!-- END Add task -->

                <router-view name="OpportunityStatus"></router-view>

                <!-- END Tasks -->
            </div>
        </div>
    </div>
    <!-- END Page Content -->
    {{-- </main> --}}

@endsection
