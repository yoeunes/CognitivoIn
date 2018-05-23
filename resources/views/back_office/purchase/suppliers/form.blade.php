<customer-form ref="back_officeForm" inline-template>
    <div>
        <div class="block block-rounded block-themed">
            <div class="block-header bg-gd-primary">
                <H3 class="block-title">Basic Information</H3>
                <div class="block-options">
                    <button v-on:click="$parent.onSave($data,false)" class="btn btn-sm btn-alt-primary">
                        <i class="fa fa-save"></i> @lang('global.Save')
                    </button>
                    <button v-on:click="$parent.onSave($data,true)" class="btn btn-sm btn-alt-primary">
                        <i class="fa fa-plus"></i> @lang('global.Save-and-New')
                    </button>
                    <button v-on:click="$parent.cancel()" class="btn btn-sm btn-alt-danger">
                        <i class="fa fa-close"></i> @lang('global.Cancel')
                    </button>
                </div>
            </div>

            <div class="block-content block-content-full">
                <div class="form-group row">
                    <label class="col-12" for="sku">Gov Code</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control"  v-model="customer_taxid">
                        <div class="form-text text-muted">Further info about this input</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-12" for="sku">Alias</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" v-model="customer_alias">
                        <div class="form-text text-muted">Further info about this input</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-12" for="sku">Address</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control"  v-model="customer_address">
                        <div class="form-text text-muted">Further info about this input</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-12" for="example-textarea-input">Telephone</label>
                    <div class="col-9">
                        <input type="text" class="form-control"  v-model="customer_telephone" />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-12" for="example-textarea-input">Email</label>
                    <div class="col-9">
                    <input type="text" class="form-control"  v-model="customer_email" />
                    </div>
                </div>
            </div>
        </div>

    </div>
</item-form>
