<contract-form ref="back_officeForm" inline-template>
    <div>
        <!-- Contract Profile -->
        <h2 class="content-heading text-black">Contract</h2>
        <div class="row items-push">
            <div class="col-lg-3">
                <p class="text-muted">
                    Contracts specify the relationship you will have with your customer or supplier. Contracts are linked during orders and give information on payment expiration dates.
                </p>
            </div>
            <div class="col-lg-7 offset-lg-1">
                <div class="form-group row">
                    <div class="col-12">
                        <label>Contract Name</label>
                        <input type="text" class="form-control form-control-lg" v-model="name">
                    </div>
                </div>
            </div>
        </div>
        <!-- END Contract Profile -->

        <!-- Details -->
        <h2 class="content-heading text-black">Details</h2>
        <div class="row items-push">
            <div class="col-lg-3">
                <p class="text-muted">
                    Contract Details specify how many payment breakdowns an order will have. If the order should be paid in one single payment, then just add one row. But for each payment add a new row with the percent of the order that should be paid.
                </p>
                <button @click="addDetail()" class="btn btn-sm btn-alt-primary">
                    <i class="fa fa-plus"></i> @lang('global.AddRow')
                </button>
                <br>

                <p>
                    <span class="lead">Templates</span>
                    <br>
                    <a href="#" @click="template(1, 30)"> 1 payment in 30 Days </a>
                    <br>
                    <a href="#" @click="template(12, 365)"> 12 payment in 12 Months </a>
                </p>
            </div>
            <div class="col-lg-7 offset-lg-1">
                <div class="form-group row">
                    <div class="col-4">
                        <label for="crypto-settings-firstname">Percent</label>
                    </div>
                    <div class="col-4">
                        <label for="crypto-settings-lastname">Offset in Days</label>
                    </div>
                    <div class="col-4">
                        <label for="crypto-settings-lastname">Actions</label>
                    </div>
                </div>
                <div class="form-group row" v-for="detail in details">
                    <div class="col-4">
                        <input type="number" class="form-control form-control-lg" v-model="detail.percent">
                    </div>
                    <div class="col-4">
                        <input type="number" class="form-control form-control-lg" v-model="detail.offset">
                    </div>
                    <div class="col-4">
                        <button @click="removeDetail(detail)" type="button" name="button"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <p>
                            @{{ totalPercent }}% out of 100%.
                            <small> This marks the percentage of the value of your invoice that is set for payment. Try to get as close to 100% as you can, in case you can't, Cognitivo will add the remaining balance to the last detail. </small>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <button v-on:click="$parent.onSave($data, false)" class="btn btn-primary min-width-125 js-click-ripple-enabled" data-toggle="click-ripple">
            <i class="fa fa-save"></i> @lang('global.Save')
        </button>
        <button v-on:click="$parent.onCancel()" class="btn btn-outline-secondary min-width-125 js-click-ripple-enabled" data-toggle="click-ripple">
            <i class="fa fa-close"></i> @lang('global.Cancel')
        </button>
        <!-- END Details -->
    </div>
</contract-form>
