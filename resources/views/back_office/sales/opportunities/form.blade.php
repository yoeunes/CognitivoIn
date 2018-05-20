<opportunity-form ref="back_officeForm" inline-template>
    <div>
        <div class="content">
            <div class="block block-fx-shadow">
                <div class="block-content">
                    <!-- User Profile -->
                    <h2 class="content-heading text-black"> Opportunity </h2>
                    <div class="row items-push">
                        <div class="col-lg-3">
                            <p class="text-muted">
                                Opportunities are a great way to plan and remind yourself of potential sales. And how to convert those opportunities to actual sales.
                            </p>
                        </div>
                        <div class="col-lg-7 offset-lg-1">
                            <div class="form-group row">
                                <div class="col-12">
                                    <label>Opportunity Name</label>
                                    <input type="text" class="form-control form-control-lg" v-model="description" placeholder="Give your pipeline a nice name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label>Customer</label>
                                    <input type="text" class="form-control form-control-lg" v-model="relationship_id" placeholder="Give your pipeline a nice name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-6">
                                    <label>Pipeline</label>
                                    <input type="text" v-model="pipeline_id" class="form-control form-control-lg">
                                    {{-- <select v-model="stage_id" required class="custom-select" > <option v-for="stage in stages" :value="stage.id">@{{ stage.name }}</option> </select> --}}
                                </div>
                                <div class="col-6">
                                    <label>Pipeline Stage</label>
                                    <input type="text" v-model="pipeline_stage_id" class="form-control form-control-lg">
                                    {{-- <select v-model="stage_id" required class="custom-select" > <option v-for="stage in stages" :value="stage.id">@{{ stage.name }}</option></select> --}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-6">
                                    <label>Opportunity Value</label>
                                    <input type="text" v-model="value" class="form-control form-control-lg">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="js-datetimepicker input-group date" data-format="YYYY/MM/DD">
                                    <input class="form-control input-lg" type="date" placeholder="Do you have a deadline?" v-model="deadline_date">
                                    <span class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- END User Profile -->
                    </div>
                </div>
            </div>

            <div class="row">
                <button v-on:click="$parent.onSave($data, false)" class="btn btn-outline-primary min-width-125 js-click-ripple-enabled m" data-toggle="click-ripple">
                    @lang('global.Save')
                </button>

                <button v-on:click="$parent.onCancel()" class="btn btn-alt-secondary min-width-125 js-click-ripple-enabled" data-toggle="click-ripple">
                    @lang('global.Cancel')
                </button>
            </div>

        </div>
    </opportunity-format>
