<pipelinestage-form profile="{{ request()->route('profile')->slug }}" inline-template>
<div>
        <div class="row">
          <div class="form-group">
                  <div class="col-xs-12">
                      <div class="form-material form-material-primary">
                          <select v-model="pipeline_id" required class="custom-select" >
                                <option v-for="pipeline in pipelines" :value="pipeline.id">@{{ pipeline.name }}</option>
                            </select>

                          <label for="product-name">name</label>
                      </div>
                  </div>
              </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="form-material form-material-primary">
                        <input class="form-control" type="text" v-model="name">

                        <label for="product-name">name</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="form-material form-material-primary">
                        <input class="form-control" type="text" v-model="sequence">

                        <label for="product-name">sequence</label>
                    </div>
                </div>
            </div>

            <button v-on:click="onSave($data,false)" class="btn btn-primary">
                @lang('global.Save')
            </button>
            <button v-on:click="onSave($data,true)" class="btn btn-primary">
                @lang('global.Save-and-New')
            </button>
            <button v-on:click="$parent.cancel()" class="btn btn-default">
                @lang('global.Cancel')
            </button>
        </div>
    </div>
</pipelinestage-form>
