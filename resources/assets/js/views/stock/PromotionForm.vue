<template>
  <div>
    <button v-on:click="onBack()" class="btn btn-sm btn-alt-danger">
      <i class="fa fa-close"></i> @lang('global.Back')
    </button>
    <button v-on:click="onForward()" class="btn btn-sm btn-alt-danger">
      <i class="fa fa-close"></i> @lang('global.Back')
    </button>
    <item-form ref="back_officeForm" inline-template>
      <div>
        <!-- User Profile -->
        <h2 class="content-heading text-black">General</h2>
        <div class="row items-push">
          <div class="col-lg-3">
            <p class="text-muted">
              Your account’s vital info. Your nickname will be publicly visible.
            </p>
          </div>
          <div class="col-lg-7 offset-lg-1">
            <div class="form-group row">
              <div class="col-12">
                <label>Type</label>
                <input type="text" class="form-control form-control-lg" v-model="type">
              </div>
            </div>

            <div class="form-group row">
              <div class="col-12">
                <label for="crypto-settings-email">input</label>
                <b-field>
                    <b-autocomplete v-model="input_value" :data="items" placeholder="Search Item" field="name"
                    :loading="isFetching" @input="getItems" @select="option => addItem(option)">
                    <template slot-scope="props">
                        <strong>@{{props.option.name}}</strong> | @{{props.option.code}}
                    </template>
                    <template slot="empty">
                        There are no items
                    </template>
                </b-autocomplete>
            </b-field>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-12">
                <label for="crypto-settings-email">output</label>
                <b-field>
                    <b-autocomplete v-model="output_value" :data="items" placeholder="Search Item" field="name"
                    :loading="isFetching" @input="getItems" @select="option => addItem(option)">
                    <template slot-scope="props">
                        <strong>@{{props.option.name}}</strong> | @{{props.option.code}}
                    </template>
                    <template slot="empty">
                        There are no items
                    </template>
                </b-autocomplete>
            </b-field>
              </div>
            </div>

          </div>
        </div>
        <!-- END User Profile -->



        <div class="block-options">
          <button v-on:click="$parent.onSave($data,false)" class="btn btn-sm btn-alt-primary">
            <i class="fa fa-save"></i> @lang('global.Save')
          </button>
          <button v-on:click="$parent.onSave($data,true)" class="btn btn-sm btn-alt-primary">
            <i class="fa fa-plus"></i> @lang('global.Save-and-New')
          </button>
          <button v-on:click="$parent.onCancel()" class="btn btn-sm btn-alt-danger">
            <i class="fa fa-close"></i> @lang('global.Cancel')
          </button>
        </div>
      </div>
    </item-form>
  </div>
</template>

<script>


export default {
  data() {
    return {
      profile:'',



    };
  },



  methods: {

    onSave($data)
    {

      var app = this;
      axios.post('/api/' + app.profile + '/back-office/itempromotions', $data)
      .then(() =>
      {
        this.$toast.open({
          message: 'Awsome! Your work has been saved',
          type: 'is-success'
        })

        this.$router.push({ name: "item.index" });
      })
      .catch(ex => {
        console.log(ex.response);
        this.$toast.open({
          duration: 5000,
          message: 'Error trying to save record',
          type: 'is-danger'
        })
      });
    },
    onCancel()
    {
      console.log(this)
      this.$router.push({ name: "itempromotion.index" });
    },
    onBack()
    {

      this.$router.push({ name: this.$router.history.stack[this.$router.history.index-1].name });
    }



  },


  mounted: function mounted()
  {
console.log(this.$router);
    var app = this;
    app.profile=this.$route.params.profile;
    app.id=this.$route.params.id;
    if (app.id>0) {



      axios.get('/api/' + app.profile + '/back-office/itempromotions/' + app.id + '/edit')
      .then(function (response) {
        console.log(app);
      //  app.$children[0].onEdit(response.data)
      })
      .catch(ex => {
        console.log(ex);

        app.$toast.open({
          duration: 5000,
          message: 'Error trying to edit this record',
          type: 'is-danger'
        })
      });
    }

  }

}
</script>
