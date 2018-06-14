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
                            <div class="font-size-sm font-w600 text-uppercase text-muted">New Contract</div>
                        </div>
                    </div>
                </a>
            </div>
            <table class="table table-borderless table-striped">
                <thead>
                    <tr>
                        <th style="width: 100px;">ID</th>
                        <th class="d-none d-sm-table-cell">@lang('global.Name')</th>

                    </tr>
                </thead>
                <tbody>
                    <div class="">
                        <tr v-for="contract in list">
                            <td>
                                <a class="font-w600" href="be_pages_ecom_product_edit.html">@{{ contract.id }}</a>
                            </td>
                            <td class="d-none d-sm-table-cell">
                                {{ contract.name }}
                            </td>

                            <td class="text-right">

                                <button v-on:click="onEdit(contract)" type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Edit">
                                    <i class="fa fa-pencil"></i>
                                </button>


                                <button v-on:click="onDelete(contract)" type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Delete">
                                    <i class="fa fa-times"></i>
                                </button>
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
            <!-- Contract Profile -->
            <h2 class="content-heading text-black">Contract</h2>
            <div class="row items-push">
                <div class="col-lg-3">
                    <p class="text-muted">
                        Contracts specify the relationship you will have with your customer or supplier. Contracts are linked during orders and give information on payment expiration dates.
                    </p>
                </div>
                <div class="col-lg-7 offset-lg-1">
                    <div class="form-group row">
                        <div class="col-12">
                            <label>Contract Name</label>
                            <input type="text" class="form-control form-control-lg" v-model="name">
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Contract Profile -->

            <!-- Details -->
            <h2 class="content-heading text-black">Details</h2>
            <div class="row items-push">
                <div class="col-lg-3">
                    <p class="text-muted">
                        Contract Details specify how many payment breakdowns an order will have. If the order should be paid in one single payment, then just add one row. But for each payment add a new row with the percent of the order that should be paid.
                    </p>
                    <button @click="addDetail()" class="btn btn-sm btn-alt-primary">
                        <i class="fa fa-plus"></i> @lang('global.AddRow')
                    </button>
                    <br>

                    <p>
                        <span class="lead">Templates</span>
                        <br>
                        <a href="#" @click="template(1, 30)"> 1 payment in 30 Days </a>
                        <br>
                        <a href="#" @click="template(12, 365)"> 12 payment in 12 Months </a>
                    </p>
                </div>
                <div class="col-lg-7 offset-lg-1">
                    <div class="form-group row">
                        <div class="col-4">
                            <label for="crypto-settings-firstname">Percent</label>
                        </div>
                        <div class="col-4">
                            <label for="crypto-settings-lastname">Offset in Days</label>
                        </div>
                        <div class="col-4">
                            <label for="crypto-settings-lastname">Actions</label>
                        </div>
                    </div>
                    <div class="form-group row" v-for="detail in details">
                        <div class="col-4">
                            <input type="number" class="form-control form-control-lg" v-model="detail.percent">
                        </div>
                        <div class="col-4">
                            <input type="number" class="form-control form-control-lg" v-model="detail.offset">
                        </div>
                        <div class="col-4">
                            <button @click="removeDetail(detail)" type="button" name="button"><i class="fa fa-trash"></i></button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <p>
                                @{{ totalPercent }}% out of 100%.
                                <small> This marks the percentage of the value of your invoice that is set for payment. Try to get as close to 100% as you can, in case you can't, Cognitivo will add the remaining balance to the last detail. </small>
                            </p>
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
            <!-- END Details -->
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
            name: '',
            details: [],

        };
    },


    computed:
    {
        totalPercent: function ()
        {
            var app = this;
            var total = 0;

            for (var i = 0; i < app.details.length; i++)
            { total = +app.details[i].percent + +total; }

            return (total * 100).toFixed(2);
        },
    },
    methods: {
        onLoad(page) {
          console.log('Load')
            this.profile=this.$route.params.profile;
            axios
            .get('/api/' + this.profile + '/back-office/list/contracts/1?page=' + page  )
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
        onEdit($data)
        {
            var app = this;
            app.showForm=true;

            axios.get('/api/' + app.profile + '/back-office/contracts/' + $data.id + '/edit')
            .then(function (response) {

                app.id = response.data.id;
                app.name = response.data.name;
                app.details = [];

                for (var i = 0; i < response.data.details.length; i++)
                {
                    app.details.push(response.data.details[i]);
                }
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
            app.name = '';
            app.details = [];
        },
        addDetail: function()
        {
            var app = this;

            app.details.push({
                id: 0,
                percent: 1,
                offset: 0,
            });
        },

        removeDetail: function(detail)
        {
            var app = this;

            let index = this.details.indexOf(detail);
            this.details.splice(index, 1);
        },

        template: function(quota, interval)
        {
            var app = this;

            //clean details
            app.details = [];

            for (var i = 1; i < (quota + 1); i++) {
                app.details.push({
                    id: 0,
                    percent: (1 / quota).toFixed(4),
                    offset: Math.floor((interval / quota) * i),
                });
            }
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

            axios.delete('/api/' + this.profile + '/back-office/contracts/' + $data.id)
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
        onSave($data)
        {
            var app = this;
            axios.post('/api/' + app.profile + '/back-office/contracts/', $data)
            .then(() =>
            {
                app.onCancel();
                this.$toast.open({
                    message: 'Awsome! Your work has been saved',
                    type: 'is-success'
                })


            })
            .catch(ex => {
                console.log(ex.response);
                this.$toast.open({
                    duration: 5000,
                    message: 'Error trying to save record',
                    type: 'is-danger'
                })
            });
        }

    },
    mounted: function mounted()
    {
        var app = this;
        app.onLoad(1);
    }
}
</script>
