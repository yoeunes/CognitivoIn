
@extends('layouts.form')

@section('content')

  <div class="row">
    @isset($team)

      <form class="form-horizontal push-30-t push-30" action="{{ route('teams.destroy', [request()->route('profile'), $team]) }}" method="post" >
        {{ method_field('DELETE') }}
        {{ csrf_field() }}

        <div class="col-xs-12 col-sm-4">
          <button type="submit" class="block block-link-hover3 text-center">
            <div class="block-content block-content-full">
              <div class="h1 font-w700 text-danger"><i class="fa fa-times"></i></div>
            </div>
            <div class="block-content block-content-full block-content-mini bg-gray-lighter text-danger font-w600">Delete Team</div>
          </button>
        </div>
      </form>
    @endisset
  </div>
  <div class="block">
    <div class="block-header bg-gray-lighter">
      <h3 class="block-title">Info</h3>
    </div>
    <div class="block-content block-content-full">
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2 col-lg-6 col-lg-offset-3">
          @isset($team)
            <form class="form-horizontal push-30-t push-30" action="{{ route('teams.update', [request()->route('profile'), $team]) }}" method="post" >
              {{ method_field('PUT') }}
            @else
              <form class="form-horizontal push-30-t push-30" action="{{ route('teams.store', request()->route('profile')) }}" method="post" >
              @endif
              {{ csrf_field() }}
              <div class="form-group">
                <div class="col-xs-12">
                  <div class="form-material form-material-primary">
                    @isset($team)
                      <input class="form-control" type="text" id="name" name="name" value="{{$team->name}}">
                    @else
                      <input class="form-control" type="text" id="name" name="name" value="">
                    @endisset
                    <label for="product-id">Name</label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-xs-12">
                  <div class="form-material form-material-primary">
                    @isset($team)
                      <input class="form-control" type="text" id="alias" name="alias" value="{{$team->alias}}">
                    @else
                      <input class="form-control" type="text" id="alias" name="alias" value="">
                    @endisset

                    <label for="product-name">Alias</label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-xs-12">
                  <div class="form-material form-material-primary">
                    @isset($team)
                      <textarea class="form-control" type="text" id="short_description" name="short_description" rows="3" >{{$team->short_description}}</textarea>
                    @else
                      <textarea class="form-control" id="short_description" name="short_description" rows="3"></textarea>
                    @endisset

                    <label for="product-short-description">Short Description</label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-xs-12">
                  <div class="form-material form-material-primary">
                    @isset($team)
                      <textarea class="form-control" type="text" id="long_description" name="long_description" rows="3" >{{$team->long_description}}</textarea>
                    @else
                      <textarea class="form-control" id="long_description" name="long_description" rows="3"></textarea>
                    @endisset

                    <label for="product-short-description">Long Description</label>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-xs-12">
                  <label class="css-input switch switch-sm switch-primary">
                    @isset($team)
                      <input type="checkbox" id="is_active" name="is_active" checked="{{$team->is_active}}"><span></span>
                    @else
                      <input type="checkbox" id="is_active" name="is_active" checked=""><span></span>
                    @endisset
                  </label>
                </div>
              </div>
              <div class="form-group">
                <div class="col-xs-12">
                  <button class="btn btn-primary" type="submit">Save</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="block">
      <div class="block-header bg-gray-lighter">
        <h3 class="block-title">Images</h3>
      </div>
      <div class="block-content block-content-full">
        <div class="row">
          <div class="col-sm-8 col-sm-offset-2 col-lg-6 col-lg-offset-3">
            <form class="dropzone push-30-t push-30 dz-clickable" action="base_pages_ecom_product_edit.php"><div class="dz-default dz-message"><span>Drop files here to upload</span></div></form>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
