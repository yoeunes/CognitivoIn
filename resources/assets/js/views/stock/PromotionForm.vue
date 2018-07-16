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
              <input type="radio" v-model="category" value="1" >Item</input>
              <input type="radio" v-model="category" value="2">Location</input>
            </div>
          </div>
          <div class="form-group row" v-if="category==1">
            <div class="col-12">
              <label>Type</label>
              <select v-model="type" required class="custom-select" >

                <option v-for="type in Itemtypes" :value="type.id">{{ type.name }}</option>


              </select>

            </div>
          </div>
          <div class="form-group row" v-if="category==2">
            <div class="col-12">
              <label>Type</label>
              <select v-model="type" required class="custom-select" >

                <option v-for="type in Locationtypes" :value="type.id">{{ type.name }}</option>


              </select>

            </div>
          </div>

          <div class="form-group row">
            <div class="col-12">
              <label for="crypto-settings-email">input</label>
              <b-field>
                <b-autocomplete v-model="input_name" :data="items" placeholder="Search Item" field="name" @select="option => addInput(option)"
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
          <div class="form-group row">
            <div class="col-12">
              <label for="crypto-settings-email">output</label>
              <b-field>
                <b-autocomplete v-model="output_name" :data="items" placeholder="Search Item" field="name" @select="option => addOutput(option)"
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
          <div class="form-group row">
            <div class="col-6">
              <label>Input Quantity</label>
              <input type="text" v-model="input_value"/>
            </div>

          </div>
          <div class="form-group row">
            <div class="col-6">
              <label>Output Quantity</label>
              <input type="text" v-model="output_value"/>
            </div>

          </div>
          <div class="form-group row">
            <div class="col-6">
              <label>Start Date</label>
              <div class="js-datetimepicker input-group date" data-format="YYYY/MM/DD">
                <input class="form-control input-lg" type="date" placeholder="Do you have a deadline?" v-model="start_date">
                <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
                </span>
              </div>
            </div>

          </div>
          <div class="form-group row">
            <div class="col-6">
              <label>End Date</label>
              <div class="js-datetimepicker input-group date" data-format="YYYY/MM/DD">
                <input class="form-control input-lg" type="date" placeholder="Do you have a deadline?" v-model="end_date">
                <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
                </span>
              </div>
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
      input_id:'',
      input_name:'',
      output_id:'',
      output_name:'',
      input_value:'',
      output_value:'',
      start_date:'',
      end_date:'',
      items:[],
      Itemtypes:[],
      Locationtypes:[],
      category:''

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
    getTypes: function(query)
    {
      var app = this;

      axios.get('/api/' + app.profile + '/PromotionTypeByItem')
      .then(({ data }) =>
      {
        console.log(data.length);
        if (data.length > 0)
        {
          app.Itemtypes = [];
          for (let i = 0; i < data.length; i++)
          {
            app.Itemtypes.push({id:data[i].id,name:data[i].name});
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
      axios.get('/api/' + app.profile + '/PromotionTypeByLocation')
      .then(({ data }) =>
      {
        console.log(data.length);
        if (data.length > 0)
        {
          app.Locationtypes = [];
          for (let i = 0; i < data.length; i++)
          {
            app.Locationtypes.push({id:data[i].id,name:data[i].name});
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
    },
    addInput: function(item)
    {
      var app = this;
      if (item!=null) {
        console.log(item.id);
        app.input_id = item.id;
        console.log(app);
      }

    },
    addOutput: function(item)
    {
      var app = this;
      if (item!=null) {
        app.output_id = item.id;

      }

    }



  },


  mounted: function mounted()
  {

    var app = this;

    app.profile=this.$route.params.profile;
    app.getTypes();
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
