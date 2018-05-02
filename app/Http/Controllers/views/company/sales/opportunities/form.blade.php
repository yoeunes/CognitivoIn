
@extends('company.sales.menu')

@section('title', 'opportunities')
@section('subTitle', 'Create')

@section('action')
  {{-- <a class="btn btn-default" href="{{ route('opportunities.create', request()->route('profile')) }}">
  <i class="fa fa-plus-circle text-success push-5-r"></i> New opportunity
</a> --}}
@endsection

@section('subContent')

  <div class="content content-boxed">
    <!-- Create Project -->
    <h2 class="content-heading text-center">What are you working on?</h2>
    <div class="block">
      <div class="block-content">

        <form class="form-horizontal push-30-t push-30" action="{{ route('opportunities.store', request()->route('profile')) }}" method="post" >
          {{ csrf_field() }}

          <div class="row items-push">
            <div class="col-sm-6 col-sm-offset-3">
              <div class="form-group">
                <div class="col-xs-12">
                  <label for="project-name">Customer</label>
                  <router-view name="SearchBox"   :current_company="{{request()->route('profile')}}" >

                  </router-view>
                  {{-- <select class="form-control input-lg" required id="dropDown" required   name="relationship_id" >
                    <option>Select an Customer</option>
                    @foreach ($customers as $customer)
                      <option value="{{ $customer->id }}">{{ $customer->customer_alias }}</option>
                    @endforeach
                  </select> --}}
                </div>
              </div>
              <div class="form-group">
                <div class="col-xs-12">
                  <label for="project-category">Stage</label>
                  <select class="form-control input-lg" required id="dropDown" required  name="stage_id" >
                    <option>Select a Stage</option>
                    @foreach ($stages as $stage)
                      <option value="{{ $stage->id }}">{{ $stage->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group">
                <div class="col-xs-12">
                  <label for="project-description">Description (Optional)</label>
                  <textarea class="form-control input-lg" id="description" name="description" rows="4" placeholder="A few words about the Opportunity.."></textarea>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-10 col-lg-8">
                  <!-- Bootstrap Datetimepicker (.js-datetimepicker class is initialized in App() -> uiHelperDatetimepicker()) -->
                  <!-- For more info and examples you can check out https://github.com/Eonasdan/bootstrap-datetimepicker -->
                  <label for="project-name">Deadline</label>
                  <div class="js-datetimepicker input-group date" data-format="YYYY/MM/DD">
                    <input class="form-control input-lg" type="text" id="project-deadline" name="project-deadline" placeholder="Do you have a deadline?">
                    <span class="input-group-addon">
                      <span class="fa fa-calendar"></span>
                    </span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-xs-12">
                  <label for="project-description">Value</label>
                  <input type="number" class="form-control input-lg" id="value" name="value"></input>
                </div>
              </div>
              <div class="form-group">
                <div class="col-xs-12">
                  <button class="btn btn-lg btn-success" type="submit">
                    <i class="fa fa-plus push-5-r"></i> Add Opportunity
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
