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
            <div class="font-size-sm font-w600 text-uppercase text-muted">New Account Movement</div>
          </div>
        </div>
      </a>
    </div>
    <b-table :data="list" hoverable>
      <template slot-scope="props">
        <b-table-column field="name" v-bind:label="lang('global.Name')">
          {{ props.row.item.name }}
        </b-table-column>
        <b-table-column field="debit" v-bind:label="lang('global.Debit')">
          {{ props.row.debit }}
        </b-table-column>
        <b-table-column field="credit" v-bind:label="lang('global.Credit')">
          {{ props.row.credit }}
        </b-table-column>
        <b-table-column field="comment" v-bind:label="lang('global.Comment')">
          {{ props.row.comment }}
        </b-table-column>



      </template>
    </b-table>
  
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
    onCreate () {
      var app = this;
      app.$router.push({ name: "account_movement.form", params: { profile:this.profile,id: 0 } });
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
