<template>
    <div>
        <div class="row">
            <div class="col-xs-6 col-sm-4 col-lg-2">
                <a class="block block-link-hover2 text-center" href="#" @click="onCreate()">
                    <div class="block-content block-content-full bg-success">
                        <!-- <i class="si si-plus fa-4x text-white"></i> -->
                        <b-icon
                            icon="plus-circle"
                            size="is-large">
                        </b-icon>

                        <div class="font-w600 text-white-op push-15-t">{{ lang('global.Create') }}</div>
                    </div>
                </a>
            </div>

            <div class="col-xs-6 col-sm-4 col-lg-2">
                <a class="block block-link-hover3 text-center" target="_blank" v-bind:href="'/reports/opportunities/' + profile +'/'+ start_date +'/' + end_date ">
                    <div class="block-content block-content-full">
                        <i class="si si-pie-chart fa-4x text-primary-darker"></i>
                        <div class="font-w600 push-15-t">Opportunity</div>
                    </div>
                </a>
            </div>

            <div class="col-xs-6 col-sm-4 col-lg-2">
                <a class="block block-link-hover3 text-center" target="_blank" v-bind:href="'/reports/opportunitiesTask/' + profile +'/'+ start_date +'/' + end_date ">
                    <div class="block-content block-content-full">
                        <i class="si si-list fa-4x text-primary-darker"></i>
                        <div class="font-w600 push-15-t">My Todo</div>
                    </div>
                </a>
            </div>
        </div>

        <b-table :data="list" hoverable>
            <template slot-scope="props">
                <b-table-column field="name" v-bind:label="lang('global.Name')">
                    {{ props.row.name }}
                </b-table-column>

                <b-table-column field="relationship.customer_alias" v-bind:label="lang('back-office.Customer', 1)">
                    {{ props.row.relationship.customer_alias }}
                </b-table-column>

                <b-table-column field="value" v-bind:label="lang('back-office.Value')">
                    {{ props.row.value }}
                </b-table-column>

                <b-table-column custom-key="actions">
                    <router-link :to="{ name: 'opportunity.show',params: { profile:profile,id:props.row.id,user_id:userid} }">
                        <button  type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Edit">
                            <i class="fa fa-eye"></i>
                        </button>
                    </router-link>
                    <router-link :to="{ name: 'opportunity.form',params: { profile:profile,id:props.row.id,user_id:userid} }">
                        <button  type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Edit">
                            <i class="fa fa-pencil"></i>
                        </button>
                    </router-link>

                    <button v-on:click="onDelete(props.row)" type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Delete">
                        <i class="fa fa-times"></i>
                    </button>
                </b-table-column>
            </template>
        </b-table>
        <b-pagination :total="meta.total" :current.sync="meta.current_page" :simple="false" :per-page="meta.per_page" @change="pageChange"></b-pagination>

    </div>
</template>
<script>


export default {
    data() {
        return {
            profile:'',
            start_date:'',
            end_date:'',
            userid:'',
            list: [],
            meta: [{total:0}],
        };
    },

    methods: {
        onLoad(page) {
            this.profile=this.$route.params.profile;
            this.userid=this.$route.params.userid;
            axios
            .get('/api/' + this.profile + '/back-office/list/opportunities/1?page=' + page  )
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
        onCreate () {
            var app = this;
            app.$router.push({ name: "opportunity.form", params: { id: 0,user_id:app.userid } });
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

                axios.delete('/api/' + this.profile + '/back-office/opportunities/' + $data.id)
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

    },
    mounted: function mounted()
    {
        var app = this;
        app.start_date=moment().subtract(1, 'months').format("YYYY-MM-DD");
        app.end_date=moment().format("YYYY-MM-DD");
        app.onLoad(1);
    }

}
</script>
