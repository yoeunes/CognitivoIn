@extends('layouts.form')

@section('content')
  <div class="content">
    <div class="col-sm-6 col-md-3">
      <a class="block block-link-hover3 text-center" href="{{ route('carts.create', request()->route('profile')) }}">
        <div class="block-content block-content-full">
          <div class="h1 font-w700" data-toggle="countTo" data-to="120"></div>
        </div>
        <div class="block-content block-content-full block-content-mini bg-gray-lighter text-muted font-w600">Create</div>
      </a>
    </div>
    <div class="row">
      <div class="col-sm-6 col-md-3">
        <a class="block block-link-hover3 text-center" href="javascript:void(0)">
          <div class="block-content block-content-full">
            <div class="h1 font-w700 text-primary" data-toggle="countTo" data-to="35"></div>
          </div>
          <div class="block-content block-content-full block-content-mini bg-gray-lighter text-muted font-w600">Pending</div>
        </a>
      </div>
      <div class="col-sm-6 col-md-3">
        <a class="block block-link-hover3 text-center" href="javascript:void(0)">
          <div class="block-content block-content-full">
            <div class="h1 font-w700" data-toggle="countTo" data-to="260"></div>
          </div>
          <div class="block-content block-content-full block-content-mini bg-gray-lighter text-muted font-w600">This Month</div>
        </a>
      </div>
      <div class="col-sm-6 col-md-3">
        <a class="block block-link-hover3 text-center" href="javascript:void(0)">
          <div class="block-content block-content-full">
            <div class="h1 font-w700" data-toggle="countTo" data-to="57890"></div>
          </div>
          <div class="block-content block-content-full block-content-mini bg-gray-lighter text-muted font-w600">Last Month</div>
        </a>
      </div>
    </div>
      <div class="block">
    
          <router-view name="PendingOrder">  <tr>
              </router-view>

      </table>
    </div>
  </div>
@endsection
@section('javascript')
  <script>
  jQuery(function () {
    // Init page helpers (Table Tools helper)
    App.initHelpers('table-tools');
  });
</script>
@endsection
