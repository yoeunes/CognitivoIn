<item-form profile="{{ request()->route('profile') }}" inline-template>
    <div>
        <div class="block block-rounded block-themed">
            <div class="block-header bg-gd-primary">
                <h3 class="block-title">Basic Info</h3>
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

                <div class="form-group">
                    <div class="form-material floating col-8">
                        <input type="text" class="form-control" id="sku" name="sku" v-model="sku">
                        <label for="sku">SKU</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-material floating col-8">
                        <input type="text" class="form-control" id="name" name="name" v-model="name">
                        <label for="name">Name</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-material floating col-3">
                        <input type="text" class="form-control" id="unit_price" name="unit_price" v-model="unit_price">
                        <label for="unit_price">Base Selling Price</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-material floating">
                        <textarea class="form-control" id="short_description" name="short_description" v-model="short_description" rows="3"></textarea>
                        <label for="short_description">Short Description</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-material floating col-8">
                        <textarea class="form-control" id="long_description" name="long_description" v-model="long_description" rows="8"></textarea>
                        <label for="long_description">Long Description</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</item-form>
