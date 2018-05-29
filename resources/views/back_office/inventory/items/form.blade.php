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

                <b-field label="Short Description">
                    <b-input maxlength="128" v-model="short_description" type="textarea"></b-input>
                </b-field>

                <b-field label="Long Description">
                    <b-input maxlength="200" v-model="long_description" type="textarea"></b-input>
                </b-field>

                <div class="field">
                    <b-switch v-model="is_global">This product is a Global</b-switch>
                </div>
                <b-field label="Global Product" v-if="is_global == false">
                    <b-input v-model="id_item"></b-input>
                </b-field>

                <div class="field">
                    <b-switch v-model="is_stockable">This product is a Stockable</b-switch>
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
                        
                        <b-field label="Currency">
                            <b-input placeholder="Currency" v-model="currency" type="text" maxlength="3" has-counter>
                            </b-input>
                        </b-field>
                    </div>

                    <div class="col-6">
                        <label>Selling Price</label>
                        <input type="text" class="form-control form-control-lg" v-model="unit_price">
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
                        <input type="text" class="form-control form-control-lg" v-model="unit_priceVAT">
                    </div>
                </div>
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
