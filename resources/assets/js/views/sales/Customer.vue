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
                            @{{ item.sku }}
                        </td>
                        <td class="d-none d-sm-table-cell">
                            @{{ item.name }}
                        </td>
                        <td>
                            @{{ item.unit_price }}
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
        :total="total"
        :current="current"
        :simple="false"
        :per-page="perPage"
        order="is-right"
        @change="pageChange">
    </b-pagination>
</div>
</template>
<script>

// const getItems = (page, callback,profile) => {
//     const params = { page };
//     axios
//     .get('/api/' + profile +'/back-office/list/items/1', { params })
//     .then(response => {
//         callback(null, response.data);
//     }).catch(error => {
//         callback(error, error.response.data);
//     });
// };

export default {
    props: ['profile'],
    data() {
        return {
            list: [],
            total: 5,
            current: 1,
            perPage: 2,

        };
    },

    methods: {
        pageChange (page) {
            this.current = page
            this.onLoad(page) // api call
        },
        onLoad()
        {
            var app=this;
            axios.get('/api/cognitivo/back-office/list/'  + app.current + '/customers/1')
        .then(({ data }) =>
        {
            console.log(data);
            if (data.length > 0)
            {
                app.list=[];
                for (let i = 0; i < data.length; i++)
                {
                    app.list.push(data[i]);
                }


            }
            else
            {

            }
        })
        .catch(ex => {
            //Stop loading with one ex.

            //Log ex for help
            console.log(ex);

        });
    }
},
mounted: function mounted()
{
    var app = this;
    app.onLoad();
}
}
</script>
