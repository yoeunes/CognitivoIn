<pipeline-form ref="back_officeForm" inline-template>
    <div>

        <!-- User Profile -->
        <h2 class="content-heading text-black"> Promotion Basics </h2>
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
        <h2 class="content-heading text-black">Promotion Conditions</h2>
        <div class="row items-push">
            <div class="col-lg-3">
                <p class="text-muted">
                    A Pipeline should have multiple stages that help you understand how far you have reached in a particular opportunity.
                </p>
            </div>
            <div class="col-lg-7 offset-lg-1">

            </div>
        </div>

        <!-- Personal Details -->
        <h2 class="content-heading text-black">Promotion Results</h2>
        <div class="row items-push">
            <div class="col-lg-3">
                <p class="text-muted">
                    A Pipeline should have multiple stages that help you understand how far you have reached in a particular opportunity.
                </p>
            </div>
            <div class="col-lg-7 offset-lg-1">

            </div>
        </div>

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
</pipeline-form>
