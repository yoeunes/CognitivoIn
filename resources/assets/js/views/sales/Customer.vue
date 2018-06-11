<template>
    <div>
      <table>
          <thead>
              <tr>
                  <th>@lang('global.TaxID')</th>
                  <th>@lang('back-office.Customer')</th>
                  <th>@lang('global.Email')</th>
                  <th class="text-center">@lang('global.Actions')</th>
              </tr>
          </thead>
          <tbody>
              <tr v-for="customer in list">
                  <td>@{{ customer.customer_taxid }}</td>
                  <td>@{{ customer.customer_alias }}</td>
                  <td>@{{ customer.customer_email }}</td>
                  <td class="text-center">
                      <div class="btn-group">
                          <button v-on:click="onEdit(customer)" type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Edit">
                              <i class="fa fa-pencil"></i>
                          </button>
                          <button v-on:click="onDelete(customer)" type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Delete">
                              <i class="fa fa-times"></i>
                          </button>
                      </div>
                  </td>
              </tr>
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
