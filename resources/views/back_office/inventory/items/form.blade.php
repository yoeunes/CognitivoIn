<item-form profile="{{ request()->route('profile') }}" inline-template>
            <div>
                <form action="be_pages_ecom_product_edit.html" method="post" onsubmit="return false;">
                    <div class="block block-rounded block-themed">
                        <div class="block-header bg-gd-primary">
                            <h3 class="block-title">Basic Info</h3>
                            <div class="block-options">
                                <button type="submit" class="btn btn-sm btn-alt-primary">
                                    <i class="fa fa-save mr-5"></i>Save
                                </button>
                            </div>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="form-group row">
                                <label class="col-12">Product ID</label>
                                <div class="col-12">
                                    <div class="form-control-plaintext">2599</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12" for="ecom-product-name">Name</label>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="ecom-product-name" name="ecom-product-name" placeholder="Product Name" value="Dark Souls III">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12" for="example-select2">Category</label>
                                <div class="col-12">
                                    <!-- Select2 (.js-select2 class is initialized in Codebase() -> uiHelperSelect2()) -->
                                    <!-- For more info and examples you can check out https://github.com/select2/select2 -->
                                    <select class="js-select2 form-control js-select2-enabled select2-hidden-accessible" id="example-select2" name="example-select2" style="width: 100%;" data-placeholder="Choose one.." tabindex="-1" aria-hidden="true">
                                        <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                        <option value="1" selected="">Video Games</option>
                                        <option value="2">Electronics</option>
                                        <option value="3">Mobile Phones</option>
                                        <option value="4">House</option>
                                        <option value="5">Hobby</option>
                                        <option value="6">Auto - Moto</option>
                                        <option value="7">Kids</option>
                                        <option value="8">Health</option>
                                        <option value="9">Fashion</option>
                                    </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-example-select2-container"><span class="select2-selection__rendered" id="select2-example-select2-container" title="Video Games">Video Games</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12">Description</label>
                                <div class="col-12">
                                    <!-- CKEditor (js-ckeditor id is initialized in Codebase() -> uiHelperCkeditor()) -->
                                    <!-- For more info and examples you can check out http://ckeditor.com -->

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12" for="ecom-product-description-short">Short Description</label>
                                <div class="col-12">
                                    <textarea class="form-control" id="ecom-product-description-short" name="ecom-product-description-short" placeholder="Description visible on preview.." rows="6">Dark Souls III is an action role-playing video game developed by FromSoftware and published by Bandai Namco Entertainment for PlayStation 4, Xbox One, and Microsoft Windows.</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12" for="ecom-product-stock">Stock</label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-fw fa-archive"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="ecom-product-stock" name="ecom-product-stock" placeholder="0" value="85">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12" for="ecom-product-price">Price</label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-fw fa-usd"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="ecom-product-price" name="ecom-product-price" placeholder="Price in USD.." value="69,00">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>


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
</item-form>
