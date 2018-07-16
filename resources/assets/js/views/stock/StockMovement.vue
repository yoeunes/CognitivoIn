<template>
  <div>
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
                    <div class="font-size-sm font-w600 text-uppercase text-muted">New Stock Movement</div>
                </div>
            </div>
        </a>
    </div>
    <table class="table table-borderless table-striped">
      <thead>
        <tr>
          <th style="width: 100px;">ID</th>
          <th class="d-none d-sm-table-cell">SKU</th>
          <th>Name</th>
          <th class="text-right">Debit</th>
          <th class="text-right">Credit</th>
          <th class="text-right">comment</th>
        </tr>
      </thead>
      <tbody>
        <div class="">
          <tr v-for="data in list">
            <td class="d-none d-sm-table-cell">
              {{ data.item.sku }}
            </td>
            <td class="d-none d-sm-table-cell">
              {{ data.item.name }}
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
      .get('/api/' + this.profile + '/back-office/list/itemmovement/1?page=' + page  )
      .then(response => {

        this.list = response.data.data;
        this.meta = response.data.meta;


      }).catch(error => {

      });

    },
    onCreate () {
      var app = this;
      app.$router.push({ name: "stockmovement.form", params: { profile:this.profile,id: 0 } });
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
