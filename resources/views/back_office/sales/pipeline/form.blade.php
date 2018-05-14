<pipeline-form profile="{{ request()->route('profile')->slug }}" inline-template>
    <div>
        <div class="row">

            <div class="form-group">
                <div class="col-xs-12">
                    <div class="form-material form-material-primary">
                        <input class="form-control" type="text" v-model="name">

                        <label for="product-name">name</label>
                    </div>
                </div>
            </div>
            <div class="row" v-if="showStage">
                <div >
                    <a class="block block-link-hover3 text-center" @click="onCreate()">
                        <div class="block-content block-content-full">
                            <div class="h1 font-w700 text-success"><i class="fa fa-plus"></i></div>
                        </div>
                        <div class="block-content block-content-full block-content-mini bg-gray-lighter text-success font-w600">Add New Stage</div>
                    </a>
                </div>
                <div class="col-5">
                    <p class="m--font-boldest m--font-transform-u">@lang('global.name')</p>
                </div>
                <div class="col-5">
                    <p class="m--font-boldest m--font-transform-u">@lang('global.sequence')</p>
                </div>
                <div class="row m--margin-bottom-5" v-for="stage in stages">

                    <div class="col-1">
                        <p> @{{ stage.name }} </p>
                    </div>
                    <div class="col-1">
                        <p> @{{ stage.sequence }} </p>
                    </div>


                    <div class="col-1">
                        <div role="group" aria-label="...">

                            <a @click="onEditStage(stage)" class="m-btn btn btn-secondary"><i class="la la-pencil m--font-brand"></i></a>
                            <a @click="onDeleteStage(stage)" class="m-btn btn btn-secondary"><i class="la la-trash m--font-danger"></i></a>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row" v-else>

                <div class="form-group">
                    <div class="col-xs-12">
                        <div class="form-material form-material-primary">
                            <input class="form-control" type="text" v-model="stage_name">

                            <label for="product-name">name</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <div class="form-material form-material-primary">
                            <input class="form-control" type="text" v-model="stage_sequence">

                            <label for="product-name">sequence</label>
                        </div>
                    </div>
                </div>

                <button v-on:click="onStageSave($data,false)" class="btn btn-primary">
                    @lang('global.SaveStage')
                </button>

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
</pipeline-form>
