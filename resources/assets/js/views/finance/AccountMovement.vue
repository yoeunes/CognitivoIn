<template>
  <div>
    <table class="table table-borderless table-striped">
      <thead>
        <tr>

          <th class="text-right">Name</th>
          <th class="text-right">Debit</th>
          <th class="text-right">Credit</th>
          <th class="text-right">comment</th>
        </tr>
      </thead>
      <tbody>
        <div class="">
          <tr v-for="data in list">
            <td class="d-none d-sm-table-cell">
              {{ data.account.name }}
            </td>
            <td>
              {{ data.debit }}
            </td>
            <td>
              {{ data.credit }}
            </td>
            <td>
              {{ data.comment }}
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
    onLoad(page) {
      this.profile=this.$route.params.profile;

      axios
      .get('/api/' + this.profile + '/back-office/list/account-movement/1?page=' + page  )
      .then(response => {

        this.list = response.data.data;
        this.meta = response.data.meta;


      }).catch(error => {

      });

    },
    created () {
      console.log('a');
    },
    pageChange (page) {
      var app = this;
      app.onLoad(page);
    }



  },
  mounted: function mounted()
  {
    console.log(this.$router);
    var app = this;
    app.onLoad(1);
  }

}
</script>
