<template>
  <div>
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
              <label>Category</label>
              <input type="radio" v-model="category" value="1" >Movement</input>
              <input type="radio" v-model="category" value="2">Debit</input>
              <input type="radio" v-model="category" value="3" >Credit</input>

            </div>
          </div>
          <div class="form-group row" >
            <div class="col-12">
              <label>Item</label>
              <b-field>
                <b-autocomplete v-model="item_name" :data="items" placeholder="Search Item" field="name" @select="option => addItem(option)"
                  @input="getItems" >
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
          <div class="form-group row" v-if="category==1 || category==2">
            <div class="col-12">
              <label>From Location</label>
              <select v-model="fromLocationid" required class="custom-select" >

                <option v-for="location in locations" :value="location.id">{{ location.name }}</option>


              </select>

            </div>
          </div>
          <div class="form-group row"  v-if="category==1 || category==3">
            <div class="col-12">
              <label>To Location</label>
              <select v-model="toLocationid" required class="custom-select" >

                <option v-for="location in locations" :value="location.id">{{ location.name }}</option>


              </select>

            </div>
          </div>


          <div class="form-group row">
            <div class="col-12">
              <label>Quantity</label>
              <input type="text" v-model="quantity"/>
            </div>

          </div>


        </div>
      </div>
      <!-- END User Profile -->



      <div class="block-options">
        <button v-on:click="onSave($data,false)" class="btn btn-sm btn-alt-primary">
          <i class="fa fa-save"></i> @lang('global.Save')
        </button>
        <button v-on:click="onSave($data,true)" class="btn btn-sm btn-alt-primary">
          <i class="fa fa-plus"></i> @lang('global.Save-and-New')
        </button>
        <button v-on:click="onCancel()" class="btn btn-sm btn-alt-danger">
          <i class="fa fa-close"></i> @lang('global.Cancel')
        </button>
      </div>
    </div>

  </div>
</template>

<script>


export default {
  data() {
    return {
      profile:'',
      type:'',
      item_id:'',
      item_name:'',
      toLocationid:'',
      fromLocationid:'',
      quantity:'',
      locations:[],
      items:[],
      category:''

    };
  },



  methods: {

    onSave($data)
    {

      var app = this;
      axios.post('/api/' + app.profile + '/back-office/stockmovment', $data)
      .then(() =>
      {
        this.$toast.open({
          message: 'Awsome! Your work has been saved',
          type: 'is-success'
        })

        this.$router.push({ name: "stockmovement.index" });
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
      this.$router.push({ name: "stockmovement.index" });
    },


    getItems: function(query)
    {
      var app = this;
      if (query!='') {
        axios.get('/api/' + app.profile + '/back-office/search/items/' + query)
        .then(({ data }) =>
        {
          if (data.length > 0)
          {
            app.items = [];
            for (let i = 0; i < data.length; i++)
            {
              app.items.push(data[i]);
            }
          }
        })
        .catch(ex => {
          console.log(ex);
          this.$toast.open({
            duration: 5000,
            message: 'Error trying to search items',
            type: 'is-danger'
          })
        });
      }
    },
    getLocations: function(query)
    {
      var app = this;
      if (query!='') {
        axios
        .get('/api/' + this.profile + '/back-office/list/locations/1'  )
        .then(response => {

            this.locations = response.data.data;


        }).catch(error => {

        });
      }
    },
    addItem: function(item)
    {
      var app = this;
      if (item!=null) {
        console.log(item.id);
        app.item_id = item.id;
        console.log(app);
      }

    }



  },


  mounted: function mounted()
  {

    var app = this;

    app.profile=this.$route.params.profile;
    app.getLocations();
    app.id=this.$route.params.id;


  }

}
</script>
