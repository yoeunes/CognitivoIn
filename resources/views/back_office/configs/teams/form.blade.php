<location-form ref="back_officeForm" inline-template>
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

                <div class="form-group row">
                    <label class="col-12" for="address">Address</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="address" name="address" v-model="address">
                        <div class="form-text text-muted">Further info about this input</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-12" for="city">City</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="city" name="city" v-model="city">
                        <div class="form-text text-muted">Further info about this input</div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12" for="state">State</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="state" name="state" v-model="state">
                        <div class="form-text text-muted">Further info about this input</div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12" for="country">Country</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="country" name="country" v-model="country">
                        <div class="form-text text-muted">Further info about this input</div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12" for="zip">Zip</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="zip" name="zip" v-model="zip">
                        <div class="form-text text-muted">Further info about this input</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</location-form>
