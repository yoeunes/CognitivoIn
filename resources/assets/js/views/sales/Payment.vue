<template>
    <div>
        <div>

            <!-- User Profile -->
            <h2 class="content-heading text-black">@lang('back-office.Commercial')</h2>
            <div class="row items-push">

                <div class="col-lg-7 offset-lg-1">
                    <b-field label="@lang('back-office.Account')" >
                        <select v-model="account_id" required class="custom-select" >
                            <option v-for="account in accounts" :value="account.id">{{ account.name }}</option>
                        </select>
                    </b-field>

                    <b-field label="@lang('back-office.Name')">
                        <b-input v-model="amount"></b-input>
                    </b-field>


                </div>
            </div>
            <!-- END User Profile -->


            <div class="row">
                <button v-on:click="onSave($data, false)" class="btn btn-outline-primary min-width-125 js-click-ripple-enabled m" data-toggle="click-ripple">
                    @lang('global.Save')
                </button>

                <button v-on:click="onSave($data, true)" class="btn btn-outline-primary min-width-125 js-click-ripple-enabled" data-toggle="click-ripple">
                    @lang('global.Save-and-New')
                </button>

                <button v-on:click="onCancel()" class="btn btn-alt-secondary min-width-125 js-click-ripple-enabled" data-toggle="click-ripple">
                    @lang('global.Cancel')
                </button>
            </div>
        </div>

    </div>
</template>

<script>


export default {
    data() {
        return {
            profile:'',
            id:'',
            account_id:'',
            amount:'',
            accounts:[]


        };
    },



    methods: {

        onSave($data)
        {
            var app = this;
            axios.post('/api/' + app.profile + '/back-office/customers', $data)
            .then(() =>
            {
                this.$toast.open({
                    message: 'Awsome! Your work has been saved',
                    type: 'is-success'
                })

                this.$router.push({ name: "order.index" });
            })
            .catch(ex => {
                console.log(ex.response);
                this.$toast.open({
                    duration: 5000,
                    message: 'Error trying to save record',
                    type: 'is-danger'
                })
            });
        },
        onCancel()
        {
            console.log(this)
            this.$router.push({ name: "order.index" });
        }

    },
    mounted: function mounted()
    {

        var app = this;
        app.profile=this.$route.params.profile;
        app.id=this.$route.params.id;
        if (app.id>0) {


            // axios.get('/api/' + app.profile + '/back-office/orders/' + app.id + '/edit')
            // .then(function (response) {
            //   console.log(response.data);
            //
            // })
            // .catch(ex => {
            //   console.log(ex);
            //
            //   app.$toast.open({
            //     duration: 5000,
            //     message: 'Error trying to edit this record',
            //     type: 'is-danger'
            //   })
            // });
        }
        axios.get('/api/' + this.profile + '/back-office/accounts')
        .then(function (response) {
            console.log(app);
            app.accounts=response.data;
        })
        .catch(ex => {
            console.log(ex);

            app.$toast.open({
                duration: 5000,
                message: 'Error trying to edit this record',
                type: 'is-danger'
            })
        });

    }

}
</script>
