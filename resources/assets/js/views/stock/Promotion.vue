<template>
  <div>
    <button v-on:click="onBack()" class="btn btn-sm btn-alt-danger">
      <i class="fa fa-arrow-left"></i>
    </button>
    <button v-on:click="onBack()" class="btn btn-sm btn-alt-danger">
      <i class="fa fa-arrow-right"></i>
    </button>
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
            <div class="font-size-sm font-w600 text-uppercase text-muted">New Promotion</div>
          </div>
        </div>
      </a>
    </div>
    <table class="table table-borderless table-striped">
      <thead>
        <tr>
          <th style="width: 100px;">ID</th>
          <th class="d-none d-sm-table-cell">Type</th>
          <th class="d-none d-md-table-cell">Start Date</th>
          <th class="d-none d-md-table-cell">End Date</th>
        </tr>
      </thead>
      <tbody>
        <div class="">
          <tr v-for="item in list">
            <td>
              <a class="font-w600" href="#" @click="onEdit(item, false)">{{ item.id }}</a>
            </td>
            <td class="d-none d-sm-table-cell">
              {{ item.type }}
            </td>
            <td class="d-none d-sm-table-cell">
              {{ item.start_date }}
            </td>
            <td>
              {{ item.end_date }}
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
      .get('/api/' + this.profile + '/back-office/list/itempromotions/1?page=' + page  )
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
    },
    onCreate () {
      var app = this;
      app.$router.push({ name: "promotion.form", params: { id: 0 } });
    },
    onBack()
    {

      if ( this.$router.history.stack[this.$router.history.index-1].params.id!=null) {
        this.$router.push({ name: this.$router.history.stack[this.$router.history.index-1].name,params: { id:this.$router.history.stack[this.$router.history.index-1].params.id} });
      }
      else {
        this.$router.push({ name: this.$router.history.stack[this.$router.history.index-1].name });
      }

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

        axios.delete('/api/' + this.profile + '/back-office/itempromotions/' + $data.id)
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
    console.log(this.$router);
    var app = this;
    app.onLoad(1);
  }

}
</script>
