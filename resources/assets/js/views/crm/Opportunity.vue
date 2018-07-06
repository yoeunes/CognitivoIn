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
            <div class="font-size-sm font-w600 text-uppercase text-muted">New Opportunity</div>
          </div>
        </div>
      </a>
      <a class="block block-rounded block-link-shadow"  v-bind:href="'/reports/opportunities/we-paraguay/'+ start_date +'/' + end_date ">
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
            <div class="font-size-sm font-w600 text-uppercase text-muted">Report</div>
          </div>
        </div>
      </a>
    </div>

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
          <td v-if="opportunity.relationship !== null">{{ opportunity.relationship.customer_alias }}</td> <td v-else></td>
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
    app.start_date=moment().subtract(1, 'months').startOf('month').format("YYYY-MM-DD");
      app.end_date=moment().subtract(1, 'months').endOf('month').format("YYYY-MM-DD");
    app.onLoad(1);
  }

}
</script>
