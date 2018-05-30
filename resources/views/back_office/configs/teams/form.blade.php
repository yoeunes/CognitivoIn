<team-form ref="back_officeForm" inline-template>
    <div>
        <div class="block block-rounded block-themed">
            <div class="block-header bg-gd-primary">
                <h3 class="block-title">Basic Information</h3>
                <div class="block-options">
                    <button v-on:click="$parent.onSave($data,false)" class="btn btn-sm btn-alt-primary">
                        <i class="fa fa-save"></i> @lang('global.Save')
                    </button>
                    <button v-on:click="$parent.onSave($data,true)" class="btn btn-sm btn-alt-primary">
                        <i class="fa fa-plus"></i> @lang('global.Save-and-New')
                    </button>
                    <button v-on:click="$parent.cancel()" class="btn btn-sm btn-alt-danger">
                        <i class="fa fa-close"></i> @lang('global.Cancel')
                    </button>
                </div>
            </div>

            <div class="block-content block-content-full">
                <div class="form-group row">
                    <label class="col-12" for="name">Member</label>
                    <div class="col-md-9">
                        <b-field>
                            <b-autocomplete v-model="selectname" :data="profiles" placeholder="Search Members" field="name"
                            :loading="isFetching" @input="getProfiles" @select="option => addMember(option)">
                            <template slot-scope="props">
                                <strong>@{{props.option.name}}</strong> | @{{props.option.slug}}
                            </template>
                            <template slot="empty">
                                There are no items
                            </template>
                        </b-autocomplete>
                    </b-field>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-12" for="address">Role</label>
                <div class="col-md-9">

                    <select name="age" v-model="role">
                        <option value="1">Admin</option>
                        <option value="2">Manager</option>
                        <option value="3">Employee</option>
                        <option value="4">Member</option>
                        <option value="5">Follower</option>
                    </select>
                </div>
            </div>


        </div>
    </div>
</div>
</location-form>
