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
                            <div class="font-size-sm font-w600 text-uppercase text-muted">New Location</div>
                        </div>
                    </div>
                </a>
            </div>
            <table class="table table-borderless table-striped">
                <thead>
                    <tr>
                        <th>
                            #
                        </th>
                        <th class="d-none d-sm-table-cell">
                            @lang('global.Name')
                        </th>
                        <th>
                            @lang('global.City')
                        </th>
                        <th class="d-none d-md-table-cell">
                            @lang('global.State')
                        </th>
                        <th class="text-right">
                            @lang('global.Actions')
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <div class="">
                        <tr v-for="location in list">
                            <td>
                                @{{ location.id }}
                            </td>
                            <td class="d-none d-sm-table-cell">
                                <a href="#" @click="onEdit(location)">@{{ location.name }}</a>
                            </td>
                            <td>
                                @{{ location.city }}
                            </td>
                            <td>
                                @{{ location.state }}
                            </td>
                            <td class="text-right">
                                <div class="btn-group">
                                    <button v-on:click="onEdit(location)" type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    <button v-on:click="onDelete(location)" type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Delete">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </div>
                </tbody>
            </table>
            <b-pagination
            :total="meta.total"
            :current.sync="meta.current_page"
            :simple="false"
            :per-page="meta.per_page"
            @change="pageChange">
        </b-pagination>
    </div>
    <div v-if="showForm">

        <div>
            <!-- Branch Profile -->
            <h2 class="content-heading text-black">Shop Information</h2>
            <div class="row items-push">
                <div class="col-lg-3">
                    <p class="text-muted">
                        Shops and Locations are a great way to attract local customers.
                    </p>
                </div>
                <div class="col-lg-7 offset-lg-1">

                    <div class="form-group row">
                        <div class="col-12">
                            <label>Shop or Location Name</label>
                            <input type="text" class="form-control form-control-lg" v-model="name">
                        </div>
                    </div>

                    <br>

                    <hr>

                    <br>

                    <div class="form-group row">
                        <div class="col-12">
                            <label>Telephone</label>
                            <input type="tel" class="form-control form-control-lg" v-model="telephone">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label>Address</label>
                            <textarea class="form-control form-control-lg">@{{ address }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="crypto-settings-firstname">Zip</label>
                            <input type="text" class="form-control form-control-lg" v-model="zip">
                        </div>
                        <div class="col-6">
                            <label for="crypto-settings-lastname">City</label>
                            <input type="text" class="form-control form-control-lg" v-model="city">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="crypto-settings-firstname">State</label>
                            <input type="text" class="form-control form-control-lg" v-model="state">
                        </div>
                        <div class="col-6">
                            <label for="crypto-settings-lastname">Country</label>
                            <input type="text" class="form-control form-control-lg" v-model="country">
                        </div>
                    </div>
                </div>
            </div>

            <button v-on:click="onSave($data, false)" class="btn btn-primary min-width-125 js-click-ripple-enabled" data-toggle="click-ripple">
                <i class="fa fa-save"></i> @lang('global.Save')
            </button>
            <button v-on:click="onCancel()" class="btn btn-outline-secondary min-width-125 js-click-ripple-enabled" data-toggle="click-ripple">
                <i class="fa fa-close"></i> @lang('global.Cancel')
            </button>
            <!-- END Branch Profile -->

            <!-- Hour Details -->
            <h2 class="content-heading text-black">Working Hours</h2>
            <div class="row items-push">
                <div class="col-lg-3">
                    <p class="text-muted">
                        Mark your working hours to help customers know if your shop is open or not.
                    </p>
                    <button v-on:click="onSave($data, false)" class="btn btn-sm btn-alt-primary">
                        <i class="fa fa-plus"></i> @lang('global.AddRow')
                    </button>
                </div>
                <div class="col-lg-7 offset-lg-1">
                    <div class="form-group row">
                        <div class="col-4">
                            <label for="crypto-settings-firstname">Day</label>
                        </div>
                        <div class="col-4">
                            <label for="crypto-settings-lastname">Opening Time</label>
                        </div>
                        <div class="col-4">
                            <label for="crypto-settings-lastname">Closing Time</label>
                        </div>
                    </div>
                    <div class="form-group row" v-for="hour in hours">
                        <div class="col-4">
                            <input type="text" class="form-control form-control-lg" v-model="hour.day">
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control form-control-lg" v-model="hour.open_time">
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control form-control-lg" v-model="hour.close_time">
                        </div>
                    </div>
                </div>
            </div>

            <!-- END Hour Details -->
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
            id: 0,
            name:'',
            telephone: '',
            address: '',
            city:'',
            state:'',
            country:'',
            zip:'',
            hours: []

        };
    },


    methods: {
        onLoad(page) {
            this.profile=this.$route.params.profile;
            axios
            .get('/api/' + this.profile + '/back-office/list/locations/1?page=' + page  )
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

              axios.delete('/api/' + this.profile + '/back-office/locations/' + $data.id)
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

            axios.get('/api/' + app.profile + '/back-office/locations/' + $data.id + '/edit')
            .then(function (response) {

                app.id = response.data.id;
                app.name = response.data.name;
                app.telephone = response.data.telephone;
                app.address = response.data.address;
                app.zip = response.data.zip;
                app.city = response.data.city;
                app.state = response.data.state;
                app.country = response.data.country;


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
            app.id = null;
            app.name = '';
            app.telephone = '';
            app.address = '';
            app.zip = '';
            app.city = '';
            app.state = '';
            app.country = '';

            app.hours = [];
        },

        onSave($data)
        {
            console.log($data);
            var app = this;
            axios.post('/api/' + app.profile + '/back-office/locations/', $data)
            .then(() =>
            {
                app.onCancel();
                this.$toast.open({
                    message: 'Awsome! Your work has been saved',
                    type: 'is-success'
                })
                  app.onLoad(1);

            })
            .catch(ex => {
                console.log(ex.response);
                this.$toast.open({
                    duration: 5000,
                    message: 'Error trying to save record',
                    type: 'is-danger'
                })
            });
              app.onLoad(1);
        }

    },
    mounted: function mounted()
    {
        var app = this;
        app.onLoad(1);
    }
}
</script>
