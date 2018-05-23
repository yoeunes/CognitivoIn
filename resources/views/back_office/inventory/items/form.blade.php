<item-form ref="back_officeForm" inline-template>
    <div>
        <!-- User Profile -->
        <h2 class="content-heading text-black">General</h2>
        <div class="row items-push">
            <div class="col-lg-3">
                <p class="text-muted">
                    Your account’s vital info. Your nickname will be publicly visible.
                </p>
            </div>
            <div class="col-lg-7 offset-lg-1">
                <div class="form-group row">
                    <div class="col-12">
                        <label>SKU or Code</label>
                        <input type="text" class="form-control form-control-lg" v-model="sku">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-12">
                        <label for="crypto-settings-email">Name</label>
                        <input type="text" class="form-control form-control-lg" v-model="name">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-12">
                        <label for="crypto-settings-email">Short Description</label>
                        <textarea class="form-control" v-model="short_description" rows="3"></textarea>
                        appears on search pages to help understand what the product or service is.
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-12">
                        <label for="crypto-settings-email">Long Description</label>
                        <textarea class="form-control" v-model="long_description" rows="8"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <!-- END User Profile -->

        <!-- Personal Details -->
        <h2 class="content-heading text-black">Commercial</h2>
        <div class="row items-push">
            <div class="col-lg-3">
                <p class="text-muted">
                    This is how your item will be commercialized.
                </p>
            </div>

            <div class="col-lg-7 offset-lg-1">
                <div class="form-group row">
                    <div class="col-6">
                        <label>Selling Price</label>
                        <input type="text" class="form-control form-control-lg" v-model="unit_price">
                    </div>
                    <div class="col-6">
                        <label>Currency</label>
                        <input type="text" class="form-control form-control-lg" v-model="currency" disabled="">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-6">
                        <label>Sales Tax</label>
                        <select v-model="vat_id" required class="custom-select" >
                            <option v-for="vat in vats" :value="vat.id">@{{ vat.name }}</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <label>Selling Price with Tax</label>
                        <input type="text" class="form-control form-control-lg" v-model="currency">
                    </div>
                </div>

                {{-- <div class="form-group row">
                <div class="col-12">
                <button type="submit" class="btn btn-alt-primary">Update</button>
            </div>
        </div> --}}
    </div>
</div>
<!-- END Personal Details -->

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
</item-form>
