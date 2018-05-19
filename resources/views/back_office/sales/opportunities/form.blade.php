<opportunity-form ref="back_officeForm" inline-template>
    <div>
        <div class="row items-push">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="form-group">
                    <div class="col-xs-12">
                        <label for="project-name">Customer</label>
                        <select v-model="relationship_id" required class="custom-select" >
                            <option v-for="customer in customers" :value="customer.id">@{{ customer.name }}</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <label for="project-category">Stage</label>
                        <select v-model="stage_id" required class="custom-select" >
                            <option v-for="stage in stages" :value="stage.id">@{{ stage.name }}</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <label for="project-description">Description (Optional)</label>
                        <textarea class="form-control input-lg"  rows="4" placeholder="A few words about the Opportunity.." v-model="description"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-10 col-lg-8">
                        <!-- Bootstrap Datetimepicker (.js-datetimepicker class is initialized in App() -> uiHelperDatetimepicker()) -->
                        <!-- For more info and examples you can check out https://github.com/Eonasdan/bootstrap-datetimepicker -->
                        <label for="project-name">Deadline</label>
                        <div class="js-datetimepicker input-group date" data-format="YYYY/MM/DD">
                            <input class="form-control input-lg" type="date" placeholder="Do you have a deadline?" v-model="deadline_date">
                            <span class="input-group-addon">
                                <span class="fa fa-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <label for="project-description">Value</label>
                        <input type="number" class="form-control input-lg" v-model="value"></input>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
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
            </div>
        </div>
    </div>
</opportunity-format>
