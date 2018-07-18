<template>
    <div>
        <div v-if="!showForm">
            <div class="col-md-6 col-xl-3">
                <a class="block block-rounded block-link-shadow" @click="onCreate()" href="#">
                    <div class="block-content block-content-full block-sticky-options">
                        <div class="block-options">
                            <div class="block-options-item">
                                <i class="fa fa-archive fa-2x text-success-light"></i>
                            </div>
                        </div>
                        <div class="py-20 text-center">
                            <div class="font-size-h2 font-w700 mb-0 text-success">
                                <i class="fa fa-plus"></i>
                            </div>
                            <div class="font-size-sm font-w600 text-uppercase text-muted">New Member</div>
                        </div>
                    </div>
                </a>
            </div>
            <b-table :data="list" hoverable>
                      <template slot-scope="props">
                          <b-table-column field="name" v-bind:label="lang('global.Name')">
                              {{ props.row.profile.name }}
                          </b-table-column>

                          <b-table-column field="address" v-bind:label="lang('global.Address')">
                              {{ props.row.profile.address }}
                          </b-table-column>

                          <b-table-column field="role" v-bind:label="lang('global.Role')" v-if="props.row.role===1">
                             Admin
                          </b-table-column>
                          <b-table-column field="role" v-bind:label="lang('global.Role')" v-if="props.row.role===2">
                             Manager
                          </b-table-column>
                          <b-table-column field="role" v-bind:label="lang('global.Role')" v-if="props.row.role===3">
                             Employee
                          </b-table-column>
                          <b-table-column field="role" v-bind:label="lang('global.Role')" v-if="props.row.role===4">
                             Member
                          </b-table-column>
                          <b-table-column field="role" v-bind:label="lang('global.Role')" v-if="props.row.role===5">
                             Follower
                          </b-table-column>

                          <b-table-column custom-key="actions">
                              <button class="button is-small is-light" v-on:click="onEdit(props.row)">
                                  <i class="fa fa-pencil"></i>
                              </button>
                              <button v-on:click="onDelete(props.row)" type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Delete">
                                  <i class="fa fa-times"></i>
                              </button>
                          </b-table-column>
                      </template>
                  </b-table>

            <b-pagination :total="meta.total" :current.sync="meta.current_page" :simple="false" :per-page="meta.per_page" @change="pageChange"> </b-pagination>
        </div>
        <div v-if="showForm">
            <div class="block block-rounded block-themed">
                <div class="block-header bg-gd-primary">
                    <h3 class="block-title">Basic Information</h3>
                    <div class="block-options">
                        <button v-on:click="onSave($data,false)" class="btn btn-sm btn-alt-primary">
                            <i class="fa fa-save"></i> {{lang('global.Save')}}
                        </button>
                        <button v-on:click="onSave($data,true)" class="btn btn-sm btn-alt-primary">
                            <i class="fa fa-plus"></i> {{lang('global.Save-and-New')}}
                        </button>
                        <button v-on:click="cancel()" class="btn btn-sm btn-alt-danger">
                            <i class="fa fa-close"></i> {{lang('global.Cancel')}}
                        </button>
                    </div>
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
</template>
<script>

export default {
    data() {
        return {
            profile:'',
            list: [],
            meta: [{total:0}],
            showForm:false,
            id:0,
            selected:null,
            isFetching:false,
            selectname:'',
            profile_id:0,
            profiles:[],
            role:0,

        };
    },


    methods: {
        onLoad(page) {
            this.profile=this.$route.params.profile;
            axios
            .get('/api/' + this.profile + '/back-office/list/followers/1?page=' + page  )
            .then(response => {

                this.list = response.data.data;
                this.meta = response.data.meta;

            }).catch(error => {

            });

        },

        pageChange (page) {
            var app = this;
            app.onLoad(page);
        },
        onCreate()
        {
            var app = this;
            app.showForm=true;
        },
        onDelete($data)
        {
            var app = this;

            this.$swal({
                title: 'Delete Record',
                text: "Sure? This action is non-reversable",
                type: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            })
            .then(() => {

                axios.delete('/api/' + this.profile + '/back-office/followers/' + $data.id)
                .then(() => {

                    let index = this.list.findIndex(x => x.id === $data.id);
                    this.list.splice(index, 1);

                    this.$toast.open({
                        duration: 750,
                        message: 'The record has been deleted',
                        position: 'is-bottom-right',
                        type: 'is-danger'
                    })
                })
                .catch(ex => {
                    console.log(ex.response);
                    this.$toast.open({
                        duration: 5000,
                        message: 'Error trying to delete record',
                        type: 'is-danger'
                    })
                });
            });
        },
        onEdit($data)
        {
            var app = this;
            app.showForm=true;

            axios.get('/api/' + app.profile + '/back-office/followers/' + $data.id + '/edit')
            .then(function (response) {

                app.id = response.data.id;
                app.selectname = response.data.profile.name;
                app.profile_id = response.data.profile_id;
                app.role = response.data.role;


            })
            .catch(ex => {
                console.log(ex);

                app.$toast.open({
                    duration: 5000,
                    message: 'Error trying to edit this record',
                    type: 'is-danger'
                })
            });
            app.onLoad(1);
        },
        onCancel()
        {
            var app = this;
            app.showForm=false;
            app.id = null;
            app.profile_id = null;
            app.role = null;
            app.selectname = '';
            app.onLoad(1);
        },

        onSave($data)
        {
            var app = this;
            axios.post('/api/' + app.profile + '/back-office/followers', $data)
            .then(() =>
            {
                app.onCancel();
                this.$toast.open({
                    message: 'Awsome! Your work has been saved',
                    type: 'is-success'
                })


            })
            .catch(ex => {
                console.log(ex);
                this.$toast.open({
                    duration: 5000,
                    message: 'Error trying to save record',
                    type: 'is-danger'
                })
            });
        },
        getProfiles: function(query)
        {
            if (query.length > 2) {
                var app = this;
                axios.get('/api/' + app.profile + '/back-office/search/profiles/' + query)
                .then(({ data }) =>
                {
                    if (data.length > 0)
                    {
                        app.profiles = [];
                        for (let i = 0; i < data.length; i++)
                        {
                            app.profiles.push(data[i]);
                        }
                    }
                })
                .catch(ex => {
                    console.log(ex);
                    this.$swal('Error trying to load records.');
                });
            }
        },
        addMember: function(member)
        {
            var app = this;
            app.profile_id = member.id;
        }

    },
    mounted: function mounted()
    {
        var app = this;
        app.onLoad(1);
    }
}
</script>
