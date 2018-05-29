
@extends('company.sales.menu')

@section('title', 'opportunities')
@section('subTitle', 'Create')

@section('action')
    {{-- <a class="btn btn-default" href="{{ route('opportunities.create', request()->route('profile')) }}">
    <i class="fa fa-plus-circle text-success push-5-r"></i> New opportunity
</a> --}}
@endsection

@section('subContent')

    {{-- <div class="content content-mini bg-white">
    <ol class="breadcrumb push">
    <li>
    <a class="link-effect" href="base_pages_projects_dashboard.html">Dashboard</a>
</li>
<li>
Create
</li>
</ol>
</div> --}}
<div class="content content-boxed">
    <!-- Create Project -->
    <h2 class="content-heading text-center">What are you working on?</h2>
    <div class="block">
        <div class="block-content">

            <form class="form-horizontal push-30-t push-30" action="{{ route('opportunity_activities.update', [request()->route('profile'), $opportunityActivity]) }}" method="post" >
                {{ method_field('PUT') }}
                {{ csrf_field() }}

                <div class="row items-push">
                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="form-group">
                            <div class="col-xs-12">
                                <label for="project-description">Name</label>
                                <input type="name" class="form-control input-lg" id="name" name="name" value="{{$opportunityActivity->name}}"></input>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <label for="project-name">ActivityType</label>
                                <select class="form-control input-lg" required id="activity_type_id"    name="activity_type_id" >
                                    <option>Select an ActivityType</option>
                                    @foreach ($activitytypes as $activitytype)
                                        @if ($activitytype->id==$opportunityActivity->activity_type_id)
                                            <option value="{{ $activitytype->id }}" selected>{{ $activitytype->name }}</option>
                                        @else
                                            <option value="{{ $activitytype->id }}">{{ $activitytype->name }}</option>
                                        @endif

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-lg-8">
                                <!-- Bootstrap Datetimepicker (.js-datetimepicker class is initialized in App() -> uiHelperDatetimepicker()) -->
                                <!-- For more info and examples you can check out https://github.com/Eonasdan/bootstrap-datetimepicker -->
                                <label for="project-name">Reminder Date</label>
                                <div class="js-datetimepicker input-group date" data-format="YYYY/MM/DD">
                                    <input class="form-control input-lg" type="text" id="date_reminder" name="date_reminder" placeholder="Do you have a reminder?" value="{{$opportunityActivity->date_reminder}}">
                                    <span class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-lg-8">
                                <!-- Bootstrap Datetimepicker (.js-datetimepicker class is initialized in App() -> uiHelperDatetimepicker()) -->
                                <!-- For more info and examples you can check out https://github.com/Eonasdan/bootstrap-datetimepicker -->
                                <label for="project-name">Start Date</label>
                                <div class="js-datetimepicker input-group date" data-format="YYYY/MM/DD">
                                    <input class="form-control input-lg" type="text" id="date_started" name="date_started" placeholder="Do you have a start?" value="{{$opportunityActivity->date_started}}">
                                    <span class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-lg-8">
                                <!-- Bootstrap Datetimepicker (.js-datetimepicker class is initialized in App() -> uiHelperDatetimepicker()) -->
                                <!-- For more info and examples you can check out https://github.com/Eonasdan/bootstrap-datetimepicker -->
                                <label for="project-name">Ended Date</label>
                                <div class="js-datetimepicker input-group date" data-format="YYYY/MM/DD">
                                    <input class="form-control input-lg" type="text" id="date_ended" name="date_ended" placeholder="Do you have a ended?" value="{{$opportunityActivity->date_ended}}">
                                    <span class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <label for="project-name">Assigned</label>
                                <select class="form-control input-lg" required id="assigned_to"    name="assigned_to" >
                                    <option>Select an Assigned To</option>
                                    @foreach ($teams as $team)
                                        @if ($team->id==$opportunityActivity->assigned_to)
                                            <option value="{{ $team->id }}" selected>{{ $team->name }}</option>
                                        @else
                                            <option value="{{ $team->id }}">{{ $team->name }}</option>
                                        @endif

                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-xs-12">
                                <label for="project-description">Description (Optional)</label>
                                <textarea class="form-control input-lg" id="description" name="description" rows="4" placeholder="A few words about the Opportunity Activity..">{{$opportunityActivity->description}}</textarea>
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="col-xs-12">
                                <button class="btn btn-lg btn-success" type="submit">
                                    <i class="fa fa-pencil push-5-r"></i> Update Opportunity
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <!-- END Create Project -->
</div>
@endsection
@section('javascript')
    <script src="{{ asset('js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap-datetimepicker/moment.min.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
    jQuery(function () {
        // Init page helpers (BS Datetimepicker + BS Colorpicker plugins)
        App.initHelpers(['datetimepicker']);
    });
    </script>
@endsection
