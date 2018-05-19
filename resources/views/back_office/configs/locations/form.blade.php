<location-form ref="backendForm" inline-template>
    <div>
        <!-- Branch Profile -->
        <h2 class="content-heading text-black">Shop Information</h2>
        <div class="row items-push">
            <div class="col-lg-3">
                <p class="text-muted">
                    Shops and Locations are a great way to attract local customers.
                </p>
            </div>
            <div class="col-lg-7 offset-lg-1">

                <div class="form-group row">
                    <div class="col-12">
                        <label>Shop or Location Name</label>
                        <input type="text" class="form-control form-control-lg" v-model="name">
                    </div>
                </div>

                <br>

                <hr>

                <br>

                <div class="form-group row">
                    <div class="col-12">
                        <label>Telephone</label>
                        <input type="tel" class="form-control form-control-lg" v-model="telephone">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <label>Address</label>
                        <textarea class="form-control form-control-lg">@{{ address }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-6">
                        <label for="crypto-settings-firstname">Zip</label>
                        <input type="text" class="form-control form-control-lg" v-model="zip">
                    </div>
                    <div class="col-6">
                        <label for="crypto-settings-lastname">City</label>
                        <input type="text" class="form-control form-control-lg" v-model="city">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-6">
                        <label for="crypto-settings-firstname">State</label>
                        <input type="text" class="form-control form-control-lg" v-model="state">
                    </div>
                    <div class="col-6">
                        <label for="crypto-settings-lastname">Country</label>
                        <input type="text" class="form-control form-control-lg" v-model="country">
                    </div>
                </div>
            </div>
        </div>

        <button v-on:click="onSave($data, false)" class="btn btn-primary min-width-125 js-click-ripple-enabled" data-toggle="click-ripple">
            <i class="fa fa-save"></i> @lang('global.Save')
        </button>
        <button v-on:click="$parent.onCancel()" class="btn btn-outline-secondary min-width-125 js-click-ripple-enabled" data-toggle="click-ripple">
            <i class="fa fa-close"></i> @lang('global.Cancel')
        </button>
        <!-- END Branch Profile -->

        <!-- Hour Details -->
        <h2 class="content-heading text-black">Working Hours</h2>
        <div class="row items-push">
            <div class="col-lg-3">
                <p class="text-muted">
                    Mark your working hours to help customers know if your shop is open or not.
                </p>
                <button v-on:click="onSave($data, false)" class="btn btn-sm btn-alt-primary">
                    <i class="fa fa-plus"></i> @lang('global.AddRow')
                </button>
            </div>
            <div class="col-lg-7 offset-lg-1">
                <div class="form-group row">
                    <div class="col-4">
                        <label for="crypto-settings-firstname">Day</label>
                    </div>
                    <div class="col-4">
                        <label for="crypto-settings-lastname">Opening Time</label>
                    </div>
                    <div class="col-4">
                        <label for="crypto-settings-lastname">Closing Time</label>
                    </div>
                </div>
                <div class="form-group row" v-for="hour in hours">
                    <div class="col-4">
                        <input type="text" class="form-control form-control-lg" v-model="hour.day">
                    </div>
                    <div class="col-4">
                        <input type="text" class="form-control form-control-lg" v-model="hour.open_time">
                    </div>
                    <div class="col-4">
                        <input type="text" class="form-control form-control-lg" v-model="hour.close_time">
                    </div>
                </div>
            </div>
        </div>

        <!-- END Hour Details -->
    </div>
</location-form>
