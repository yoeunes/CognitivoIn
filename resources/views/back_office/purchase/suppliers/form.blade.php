<relationship-form ref="back_officeForm" inline-template>
    <div>

        <!-- User Profile -->
        <h2 class="content-heading text-black"> Commercial </h2>
        <div class="row items-push">
            <div class="col-lg-3">
                <p class="text-muted">
                    Load the supplier commercial information, this information helps during order process.
                </p>
            </div>
            <div class="col-lg-7 offset-lg-1">

                <b-field label="Supplier Name">
                    <b-input v-model="supplier_alias"></b-input>
                </b-field>

                <b-field label="Government TaxID">
                    <b-input v-model="supplier_taxid"></b-input>
                </b-field>

                <b-field label="Credit Limit">
                    <b-input v-model="credit_limit"></b-input>
                </b-field>

                <b-field label="@lang('back-office.Default_Contract')" v-if="credit_limit != ''">
                    <select v-model="contract_ref" required class="custom-select" >
                        <option v-for="contract in contracts" :value="contract.id">@{{ contract.name }}</option>
                    </select>
                </b-field>
            </div>
        </div>
        <!-- END User Profile -->

        <!-- Personal Details -->
        <h2 class="content-heading text-black"> Contact </h2>
        <div class="row items-push">
            <div class="col-lg-3">
                <p class="text-muted">
                    Load contact information such as address, emails, and telephone numbers.
                </p>
            </div>
            <div class="col-lg-7 offset-lg-1">
                <b-field label="Telephone">
                    <b-input v-model="supplier_telephone"></b-input>
                </b-field>
                <b-field label="Email">
                    <b-input v-model="supplier_email"></b-input>
                </b-field>
                <b-field label="Address">
                    <b-input type="textarea" v-model="supplier_address"></b-input>
                </b-field>
            </div>
        </div>
        <!-- END Personal Details -->

        <div class="row">
            <button v-on:click="$parent.onSave($data, false)" class="btn btn-outline-primary min-width-125 js-click-ripple-enabled m" data-toggle="click-ripple">
                @lang('global.Save')
            </button>

            <button v-on:click="$parent.onSave($data, true)" class="btn btn-outline-primary min-width-125 js-click-ripple-enabled" data-toggle="click-ripple">
                @lang('global.Save-and-New')
            </button>

            <button v-on:click="$parent.onCancel()" class="btn btn-alt-secondary min-width-125 js-click-ripple-enabled" data-toggle="click-ripple">
                @lang('global.Cancel')
            </button>
        </div>
    </div>
</relationship-form>
