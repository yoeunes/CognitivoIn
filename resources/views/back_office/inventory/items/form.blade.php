<item-form profile="{{ request()->route('profile')->slug }}" inline-template>
    <div>
        <div class="block block-rounded block-themed">
            <div class="block-header bg-gd-primary">
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
            </div>

            <div class="block-content block-content-full">
                <div class="form-group row">
                    <label class="col-12" for="sku">Code</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="sku" name="sku" v-model="sku">
                        <div class="form-text text-muted">Further info about this input</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-12" for="sku">Name</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="name" name="name" v-model="name">
                        <div class="form-text text-muted">Further info about this input</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-12" for="sku">Selling Price</label>
                    <div class="col-md-9">
                        <input type="number" class="form-control" id="unit_price" name="unit_price" v-model="unit_price">
                        <div class="form-text text-muted">Further info about this input</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-12" for="example-textarea-input">Short Description</label>
                    <div class="col-9">
                        <textarea class="form-control" id="short_description" name="short_description" v-model="short_description" rows="3"></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-12" for="example-textarea-input">Long Description</label>
                    <div class="col-9">
                        <textarea class="form-control" id="long_description" name="long_description" v-model="long_description" rows="8"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</item-form>