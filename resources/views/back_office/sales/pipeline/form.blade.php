<pipeline-form ref="back_officeForm" inline-template>
    <div>
        <div class="content">
            <div class="block block-fx-shadow">
                <div class="block-content">
                    <!-- User Profile -->
                    <h2 class="content-heading text-black"> Opportunity Pipeline </h2>
                    <div class="row items-push">
                        <div class="col-lg-3">
                            <p class="text-muted">
                                Pipelines are a great way to group your opportunities into general habbits.
                            </p>
                        </div>
                        <div class="col-lg-7 offset-lg-1">
                            <div class="form-group row">
                                <div class="col-12">
                                    <label>Pipeline Name</label>
                                    <input type="text" class="form-control form-control-lg" v-model="name" placeholder="Give your pipeline a nice name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label>Is Active</label>
                                    <input type="checkbox" class="form-control form-control-lg" v-model="is_active">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END User Profile -->

                    <!-- Personal Details -->
                    <h2 class="content-heading text-black">Pipeline Stages</h2>
                    <div class="row items-push">
                        <div class="col-lg-3">
                            <p class="text-muted">
                                A Pipeline should have multiple stages that help you understand how far you have reached in a particular opportunity.
                            </p>
                            <button v-on:click="onAddStage()" class="btn btn-default">
                                @lang('global.Add Stage')
                            </button>
                        </div>
                        <div class="col-lg-7 offset-lg-1">
                            <table>
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <th>Stage Name</th>
                                        <th>Completion</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="stage in orderedStages">
                                        <td>@{{ stage.stage_sequence }}</td>
                                        <td><input type="text" v-model="stage.stage_name"/></td>
                                        <td>
                                            <div class="js-rating" data-score="5" data-number="10" style="cursor: pointer;">
                                                <i data-alt="1" class="fa fa-fw fa-star text-muted" title="Just Bad!"></i>&nbsp;
                                                <i data-alt="2" class="fa fa-fw fa-star text-muted" title="Almost There!"></i>&nbsp;
                                                <i data-alt="3" class="fa fa-fw fa-star text-muted" title="It’s ok!"></i>&nbsp;
                                                <i data-alt="4" class="fa fa-fw fa-star text-muted" title="That’s nice!"></i>&nbsp;
                                                <i data-alt="5" class="fa fa-fw fa-star text-muted" title="Incredible!"></i>&nbsp;
                                                <i data-alt="6" class="fa fa-fw fa-star text-muted" title="6"></i>&nbsp;
                                                <i data-alt="7" class="fa fa-fw fa-star text-muted" title="7"></i>&nbsp;
                                                <i data-alt="8" class="fa fa-fw fa-star text-muted" title="8"></i>&nbsp;
                                                <i data-alt="9" class="fa fa-fw fa-star text-muted" title="9"></i>&nbsp;
                                                <i data-alt="10" class="fa fa-fw fa-star text-muted" title="10"></i>
                                                <input name="score" type="hidden" v-model="stage.completedAsInteger">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button v-on:click="stageDown(stage)" type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Delete">
                                                    <i class="fa fa-arrow-up"></i>
                                                </button>
                                                <button v-on:click="stageUp(stage)" type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Delete">
                                                    <i class="fa fa-arrow-down"></i>
                                                </button>
                                                <button v-on:click="stageCancel(stage)" type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Delete">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Personal Details -->
                </div>
            </div>
        </div>

        <div class="row">
            <button v-on:click="$parent.onSave($data, false)" class="btn btn-outline-primary min-width-125 js-click-ripple-enabled m" data-toggle="click-ripple">
                @lang('global.Save')
            </button>

            <button v-on:click="onSave($data, true)" class="btn btn-outline-primary min-width-125 js-click-ripple-enabled" data-toggle="click-ripple">
                @lang('global.Save-and-New')
            </button>

            <button v-on:click="$parent.cancel()" class="btn btn-alt-secondary min-width-125 js-click-ripple-enabled" data-toggle="click-ripple">
                @lang('global.Cancel')
            </button>
        </div>
    </div>
</pipeline-form>
