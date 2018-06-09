<template>
    <div>
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
</template>
<script>



export default {
    data() {
        return {
            profile:'',
            list: [],
            meta: [{total:0}],
            links: {
                first: null,
                last: null,
                next: null,
                prev: null,
            },

        };
    },



    methods: {
        setData(page) {
            this.profile=this.$route.params.profile;
            axios
            .get('/api/' + this.profile + '/back-office/list/locations/1?page=' + page  )
            .then(response => {

                this.list = response.data.data;
                this.links = response.data.links;
                this.meta = response.data.meta;

            }).catch(error => {

            });

        },
        pageChange (page) {
            var app = this;
            app.setData(page);
        }

    },
    mounted: function mounted()
    {
        var app = this;
        app.setData(1);
    }
}
</script>
