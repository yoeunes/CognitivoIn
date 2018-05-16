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

            <label for="product-name">Number</label>
            <input class="form-control" type="text" v-model="stage_sequence">

            <label for="product-name">Stage</label>
            <input class="form-control" type="text" v-model="stage_name">

            <button v-on:click="onStageSave($data,false)" class="btn btn-primary">
                @lang('global.SaveStage')
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
                        <td><p> @{{ stage.sequence }} </p></td>
                        <td><p> @{{ stage.name }} </p></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="row">
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
