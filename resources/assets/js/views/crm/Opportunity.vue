<template>
    <div>
        <div class="row">

            <div class="col-xs-6 col-sm-4 col-lg-2">
                <a class="block block-link-hover3 text-center" href="#" @click="onCreate()">
                    <div class="block-content block-content-full">
                        <i class="si si-plus fa-4x text-success"></i>
                        <div class="font-w600 push-15-t">New Opportunity</div>
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

        <!--
        <b-table :data="data" paginated per-page="5" :opened-detailed="defaultOpenedDetails" detailed detail-key="id" @details-open="(row, index) => $toast.open(`Expanded ${row.user.first_name}`)" >

        <template slot-scope="props">
            <b-table-column field="id" label="ID" width="40" numeric>
                {{ props.row.id }}
            </b-table-column>

            <b-table-column field="user.first_name" label="First Name" sortable>
                {{ props.row.user.first_name }}
            </b-table-column>

            <b-table-column field="user.last_name" label="Last Name" sortable>
                {{ props.row.user.last_name }}
            </b-table-column>

            <b-table-column field="date" label="Date" sortable centered>
                <span class="tag is-success">
                    {{ new Date(props.row.date).toLocaleDateString() }}
                </span>
            </b-table-column>

            <b-table-column label="Gender">
                <b-icon pack="fa"
                :icon="props.row.gender === 'Male' ? 'mars' : 'venus'">
            </b-icon>
            {{ props.row.gender }}
        </b-table-column>
    </template>

    <template slot="detail" slot-scope="props">
        <article class="media">
            <figure class="media-left">
                <p class="image is-64x64">
                    <img src="static/img/placeholder-128x128.png">
                </p>
            </figure>
            <div class="media-content">
                <div class="content">
                    <p>
                        <strong>{{ props.row.user.first_name }} {{ props.row.user.last_name }}</strong>
                        <small>@{{ props.row.user.first_name }}</small>
                        <small>31m</small>
                        <br>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Proin ornare magna eros, eu pellentesque tortor vestibulum ut.
                        Maecenas non massa sem. Etiam finibus odio quis feugiat facilisis.
                    </p>
                </div>
            </div>
        </article>
    </template>
</b-table> -->


<table>
    <thead>
        <tr>
            <td>#</td>
            <th>Opportunity Name</th>
            <th>Customer</th>
            <th>Value</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="opportunity in list">
            <td>{{ opportunity.id }}</td>
            <td><a @click="onShow(opportunity)" href="#">{{ opportunity.name }}</a></td>
            <td v-if="opportunity.relationship !== null">{{ opportunity.relationship.customer_alias }}</td>
            <td v-else></td>
            <td>{{ opportunity.value }}</td>
            <td class="text-center">
                <div class="btn-group">
                    <router-link :to="{ name: 'opportunity.show',params: { profile:profile,id:opportunity.id,user_id:userid} }">
                        <button  type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Edit">
                            <i class="fa fa-eye"></i>
                        </button>
                    </router-link>
                    <router-link :to="{ name: 'opportunity.form',params: { profile:profile,id:opportunity.id,user_id:userid} }">
                        <button  type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Edit">
                            <i class="fa fa-pencil"></i>
                        </button>
                    </router-link>

                    <button v-on:click="onDelete(opportunity)" type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Delete">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </td>
        </tr>
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
