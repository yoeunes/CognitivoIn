<item-form inline-template>
<div>
        <div class="row">
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="form-material form-material-primary">

                        <input class="form-control" type="text" v-model="sku">
                        <label for="product-id">SKU</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="form-material form-material-primary">
                        <input class="form-control" type="text" v-model="name">

                        <label for="product-name">Item (Product or Service) name</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="form-material form-material-primary">
                        <input class="form-control" type="text" v-model="short_description">

                        <label for="product-short-description">Short Description</label>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="form-material form-material-primary">
                        <input class="form-control" type="text" v-model="long_description">

                        <label for="product-short-description">Long Description</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="form-material form-material-primary">
                        <input class="form-control" type="text" v-model="long_description">

                        <label for="product-price">Price in USD ($)</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <label class="css-input switch switch-sm switch-primary">

                        <input type="checkbox" v-model="is_active"><span></span>

                    </label>
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
</item-form>
