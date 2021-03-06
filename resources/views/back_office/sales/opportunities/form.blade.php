<div>
    <div class="content">
        <div class="block block-fx-shadow">
            <div class="block-content">
                <!-- User Profile -->
                <h2 class="content-heading text-black"> @lang('back-office.Opportunities') </h2>
                <div class="row items-push">
                    <div class="col-lg-3">
                        <p class="text-muted">
                            Opportunities are a great way to plan and remind yourself of potential sales. And how to convert those opportunities to actual sales.
                        </p>
                    </div>
                    <div class="col-lg-7 offset-lg-1">
                        <b-field label="Opportunity Name" expanded>
                            <b-input maxlength="200" v-model="name" placeholder="So whats this oportunity about?"></b-input>
                        </b-field>
                        <b-field label="Description" expanded>
                            <b-input maxlength="200" v-model="description" placeholder="So whats this oportunity about?" type="textarea"></b-input>
                        </b-field>
                        <div class="form-group row">
                            <div class="col-12">
                                <label>@lang('back-office.Customer')</label>
                                <b-field>
                                    <b-autocomplete v-model="selectname" :data="customers" placeholder="Search Customer" field="customer_alias"
                                    :loading="isFetching" @input="getCustomers" @select="option => addCustomer(option)">
                                    <template slot-scope="props">
                                        <strong>@{{props.option.customer_taxid}}</strong> | @{{props.option.customer_alias}}
                                    </template>
                                    <template slot="empty">
                                        There are no customers
                                    </template>
                                </b-autocomplete>
                            </b-field>
                                
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label>@lang('back-office.Pipeline')</label>

                            <select v-model="pipeline_id" required class="custom-select" >
                                <option v-for="pipeline in pipelines" :value="pipeline.id">@{{ pipeline.name }}</option> </select>
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-6">
                                <label>Opportunity Value</label>
                                <input type="text" v-model="value" class="form-control form-control-lg">
                            </div>
                        </div>
                        <div class="form-group row">
                            <b-field label="Currency">
                                <b-input placeholder="Currency" v-model="currency" type="text" maxlength="3" has-counter>
                                </b-input>
                            </b-field>
                        </div>
                        <div class="form-group row">
                            <div class="col-6">
                                <label>Deadline Date</label>
                                <div class="js-datetimepicker input-group date" data-format="YYYY/MM/DD">
                                    <input class="form-control input-lg" type="date" placeholder="Do you have a deadline?" v-model="deadline_date">
                                    <span class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- END User Profile -->
                </div>
            </div>
        </div>
        <div class="row">
            <button v-on:click="$parent.onSave($data)" class="btn btn-outline-primary min-width-125 js-click-ripple-enabled m" data-toggle="click-ripple">
                @lang('global.Save')
            </button>

            <button v-on:click="$parent.onCancel()" class="btn btn-alt-secondary min-width-125 js-click-ripple-enabled" data-toggle="click-ripple">
                @lang('global.Cancel')
            </button>
        </div>
    </div>
</div>
