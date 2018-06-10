<template>
    <div>
        <table class="table table-borderless table-striped">
            <thead>
                <tr>
                    <th style="width: 100px;">ID</th>
                    <th class="d-none d-sm-table-cell">SKU</th>
                    <th>Name</th>
                    <th class="d-none d-md-table-cell">Price</th>
                    <th class="text-right">Value</th>
                </tr>
            </thead>
            <tbody>
                <div class="">
                    <tr v-for="item in list">
                        <td>
                            <a class="font-w600" href="#" @click="onEdit(item, false)">PID.424</a>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            {{ item.sku }}
                        </td>
                        <td class="d-none d-sm-table-cell">
                            {{ item.name }}
                        </td>
                        <td>
                            {{ item.unit_price }}
                        </td>
                        <td >
                            <button v-on:click="onEdit(customer)" type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Edit">
                                <i class="fa fa-pencil"></i>
                            </button>
                            <button v-on:click="onDelete(customer)" type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Delete">
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
</template>
<script>


export default {
    data() {
        return {
            profile:'',
            list: [],
            meta: [{total:0}],
        

        };
    },



    methods: {
        setData(page) {
            this.profile=this.$route.params.profile;
            axios
            .get('/api/' + this.profile + '/back-office/list/items/1?page=' + page  )
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
