<location-form profile="{{ request()->route('profile')->slug }}" inline-template>
    <div>
        <div class="block block-rounded block-themed">
            {{-- <div class="block-header bg-gd-primary">
                <H3 class="block-title">Basic Information</H3>
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
            </div> --}}

            <div class="block-content block-content-full">

                {{-- <div class="form-group row">
                    <label class="col-12" >Name</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="name" name="name" v-model="name">
                        <div class="form-text text-muted">Further info about this input</div>
                    </div>
                </div> --}}

                <div class="form-group row">
                    <label class="col-12" >Address</label>
                    <div class="col-md-9">
                        <textarea  class="form-control"  v-model="address">
                        <div class="form-text text-muted">Further info about this input</div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12" >City</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="name" name="name" v-model="city">
                        <div class="form-text text-muted">Further info about this input</div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12" >State</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="name" name="name" v-model="state">
                        <div class="form-text text-muted">Further info about this input</div>
                    </div>
                </div>



            </div>
        </div>




    </div>
</location-form>
