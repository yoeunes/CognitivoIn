import Vue from 'vue';
import VueSweetAlert from 'vue-sweetalert';
import axios from 'axios';


Vue.component('item-form',
{

  props: ['currency'],
  data() {
    return {

      id: 0,
      profile_id:'',
      name:'',
      sku: '',
      short_description:'',
      long_description:'',
      currency_id:'',
      unit_price:'',
      unit_cost: '',
      is_active: true,
      currencies:[],

    }
  },



  methods:
  {

    onEdit: function(data)
    {
      console.log(data)
      var app = this;
      app.id = data.id;
      app.profile_id = data.profile_id,
      app.name = data.name,
      app.sku = data.sku,
      app.short_description = data.short_description,
      app.long_description = data.long_description,
      app.currency_id = data.currency_id,
      app.unit_price = data.unit_price,
      app.unit_cost = data.unit_cost,
      app.is_active = data.is_active,
      app.$parent.$parent.showList = false;
    },

    onReset: function(isnew)
    {
      var app = this;

      app.id = null;
      app.profile_id = null;
      app.name = null;
      app.sku = null;
      app.short_description = null;
      app.long_description = null;
      app.currency_id = null;
      app.unit_price = null;
      app.unit_cost = null;
      if (isnew == false)
      {
        app.$parent.$parent.showList = true;
      }
    },

    //Takes Json and uploads it into Sales INvoice API for inserting. Since this is a new, it should directly insert without checking.
    //For updates code will be different and should use the ID's palced int he Json.
    onSave: function(json,isnew)
    {
      var app = this;
      var api = null;



      axios({
        method: 'post',
        url: '/back-office/cognitivo/sales/items',
        responseType: 'json',
        data: json

      }).then(function (response)
      {
        if (response.status = 200 )
        {
          app.onReset(isnew);
        }
        else
        {
          alert('Something Went Wrong...')
        }
      })
      .catch(function (error)
      {
        console.log(error);
        console.log(error.response);
      });
    }


},

mounted: function mounted()
{


  
}
});
