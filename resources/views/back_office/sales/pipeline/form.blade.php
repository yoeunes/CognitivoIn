<pipeline-form profile="{{ request()->route('profile')->slug }}" inline-template>
    <div>
        <div class="row">
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="form-material form-material-primary">
                        <input class="form-control" type="text" v-model="name">

                        <label for="product-name">Name</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">


            <button v-on:click="onAddStage($data, false)" class="btn btn-primary">
                @lang('global.AddStage')
            </button>
        </div>

        <div class="row">
            <table>
                <thead>
                    <tr>
                        <td>
                            <b>Number</b>
                        </td>
                        <td>
                            <b>Stage</b>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="stage in stages">
                        <td><input type="text" v-model="stage.stage_sequence"/></td>
                        <td><input type="text" v-model="stage.stage_name"/></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="row">
            <button v-on:click="onSaveStage($data, false)" class="btn btn-primary">
                @lang('global.SaveStage')
            </button>
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
