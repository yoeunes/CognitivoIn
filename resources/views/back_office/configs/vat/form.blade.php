<vat-form profile="{{ request()->route('profile')->slug }}" inline-template>
  <div>





    <div class="block block-rounded block-themed">

      <div class="block-header bg-gd-primary">
        <h3 class="block-title">Basic Information</h3>
        <div class="block-options">
          <button v-on:click="onSave($data,false)" class="btn btn-sm btn-alt-primary">
            <i class="fa fa-save"></i> @lang('global.Save')
          </button>
          <button v-on:click="onSave($data,true)" class="btn btn-sm btn-alt-primary">
            <i class="fa fa-plus"></i> @lang('global.Save-and-New')
          </button>
          <button v-on:click="$parent.cancel()" class="btn btn-sm btn-alt-danger">
            <i class="fa fa-close"></i> @lang('global.Cancel')
          </button>
        </div>
      </div>

      <div class="block-content block-content-full">
        <div class="form-group row">
          <label class="col-12" for="name">Name</label>
          <div class="col-md-9">
            <input type="text" class="form-control" id="name" name="name" v-model="name">
            <div class="form-text text-muted">Further info about this input</div>
          </div>
        </div>



      </div>


      <div class="row" v-if="showDetail">
        <div >
          <a class="block block-link-hover3 text-center" @click="onCreate()">
            <div class="block-content block-content-full">
              <div class="h1 font-w700 text-success"><i class="fa fa-plus"></i></div>
            </div>
            <div class="block-content block-content-full block-content-mini bg-gray-lighter text-success font-w600">Add New Detail</div>
          </a>
        </div>
        <div class="col-5">
          <p class="m--font-boldest m--font-transform-u">@lang('global.coefficient')</p>
        </div>
        <div class="col-5">
          <p class="m--font-boldest m--font-transform-u">@lang('global.percent')</p>
        </div>
        <div class="row m--margin-bottom-5" v-for="detail in vatdetails">

          <div class="col-1">
            <p> @{{ detail.coefficient }} </p>
          </div>
          <div class="col-1">
            <p> @{{ detail.percent }} </p>
          </div>


          <div class="col-1">
            <div role="group" aria-label="...">

              <a @click="onEditDetail(detail)" class="m-btn btn btn-secondary"><i class="la la-pencil m--font-brand"></i></a>
              <a @click="onDeleteDetail(detail)" class="m-btn btn btn-secondary"><i class="la la-trash m--font-danger"></i></a>

            </div>
          </div>
        </div>
      </div>

      <div class="row" v-else>

        <div class="form-group">
          <div class="col-xs-12">
            <div class="form-material form-material-primary">
              <input class="form-control" type="text" v-model="coefficient">

              <label for="product-name">coefficient</label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <div class="form-material form-material-primary">
              <input class="form-control" type="text" v-model="percent">

              <label for="product-name">Percent</label>
            </div>
          </div>
        </div>

        <button v-on:click="onDetailSave($data,false)" class="btn btn-primary">
          @lang('global.SaveDetail')
        </button>

      </div>

    </div>
  </div>
</vat-form>
