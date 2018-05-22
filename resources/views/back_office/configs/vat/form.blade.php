<vat-form ref="back_officeForm" inline-template>
  <div>
  <div>
      <!-- Contract Profile -->
      <h2 class="content-heading text-black">Contract</h2>
      <div class="row items-push">
          <div class="col-lg-3">
              <p class="text-muted">
                Tax Information
              </p>
          </div>
          <div class="col-lg-7 offset-lg-1">
              <div class="form-group row">
                  <div class="col-12">
                      <label>Tax Name</label>
                      <input type="text" class="form-control form-control-lg" v-model="name">
                  </div>
              </div>
          </div>
      </div>
      <!-- END Contract Profile -->

      <!-- Details -->
      <h2 class="content-heading text-black">Details</h2>
      <div class="row items-push">
          <div class="col-lg-3">
              <p class="text-muted">
            Detail information
              </p>
              <button @click="addDetail()" class="btn btn-sm btn-alt-primary">
                  <i class="fa fa-plus"></i> @lang('global.AddRow')
              </button>
              <br>


          </div>
          <div class="col-lg-7 offset-lg-1">
              <div class="form-group row">
                  <div class="col-4">
                      <label for="crypto-settings-firstname">Percent</label>
                  </div>
                  <div class="col-4">
                      <label for="crypto-settings-lastname">coefficient</label>
                  </div>
                  <div class="col-4">
                      <label for="crypto-settings-lastname">Actions</label>
                  </div>
              </div>
              <div class="form-group row" v-for="detail in details">
                  <div class="col-4">
                      <input type="number" class="form-control form-control-lg" v-model="detail.percent">
                  </div>
                  <div class="col-4">
                      <input type="number" class="form-control form-control-lg" v-model="detail.coefficient">
                  </div>
                  <div class="col-4">
                      <button @click="removeDetail(detail)" type="button" name="button"><i class="fa fa-trash"></i></button>
                  </div>
              </div>
              <div class="form-group row">
                  <div class="col-12">
                      <p>
                          @{{ totalPercent }}% out of 100%.
                          <small> This marks the percentage of the value of your invoice that is set for payment. Try to get as close to 100% as you can, in case you can't, Cognitivo will add the remaining balance to the last detail. </small>
                      </p>
                  </div>
              </div>
          </div>
      </div>

      <button v-on:click="$parent.onSave($data, false)" class="btn btn-primary min-width-125 js-click-ripple-enabled" data-toggle="click-ripple">
          <i class="fa fa-save"></i> @lang('global.Save')
      </button>
      <button v-on:click="$parent.onCancel()" class="btn btn-outline-secondary min-width-125 js-click-ripple-enabled" data-toggle="click-ripple">
          <i class="fa fa-close"></i> @lang('global.Cancel')
      </button>
      <!-- END Details -->
  </div>
    {{-- <div>
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
    </div> --}}
  </div>
</vat-form>
