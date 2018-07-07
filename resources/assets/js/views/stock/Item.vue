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
            <div class="font-size-sm font-w600 text-uppercase text-muted">New Product</div>
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
              <div class="btn-group">


                <router-link :to="{ name: 'item.form',params: { profile:profile,id:item.id} }">
                  <button  type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Edit">
                    <i class="fa fa-pencil"></i>
                  </button>
                </router-link>

                <button v-on:click="onDelete(item)" type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Delete">
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


    };
  },



  methods: {
    onLoad(page) {
      this.profile=this.$route.params.profile;

      axios
      .get('/api/' + this.profile + '/back-office/list/items/1?page=' + page  )
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
      app.$router.push({ name: "item.form", params: { id: 0 } });
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

        axios.delete('/api/' + this.profile + '/back-office/items/' + $data.id)
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
