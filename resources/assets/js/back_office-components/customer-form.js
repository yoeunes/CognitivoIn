import Vue from 'vue';
import VueSweetAlert from 'vue-sweetalert';
import axios from 'axios';


Vue.component('customer-form',
{


  data() {
    return {

      id: 0,
      customer_alias:'',
      customer_taxid: '',
      customer_address:'',
      customer_telephone:'',
      customer_email:'',
      customer_telephone:'',
      supplier_alias:'',
      supplier_taxid: '',
      supplier_address:'',
      supplier_telephone:'',
      supplier_email:'',
      supplier_telephone:''

    }
  },



  methods:
  {

    onEdit: function(data)
    {
      console.log(data)
      var app = this;
      app.customer_alias=data.customer_alias;
      app.customer_taxid=data.customer_taxid;
      app.customer_address=data.customer_address;
      app.customer_telephone=data.customer_telephone;
      app.customer_email=data.customer_email;
      app.customer_telephone=data.customer_telephone;
      app.supplier_alias=data.supplier_alias;
      app.supplier_taxid=data.supplier_taxid;
      app.supplier_address=data.supplier_address;
      app.supplier_telephone=data.supplier_telephone;
      app.supplier_email=data.supplier_email;
      app.supplier_telephone=data.supplier_telephone;
      app.$parent.$parent.showList = false;
    },

    onReset: function(isnew)
    {
      var app = this;

      app.customer_alias=null;
      app.customer_taxid=null;
      app.customer_address=null;
      app.customer_telephone=null;
      app.customer_email=null;
      app.customer_telephone=null;
      app.supplier_alias=null;
      app.supplier_taxid=null;
      app.supplier_address=null;
      app.supplier_telephone=null;
      app.supplier_email=null;
      app.supplier_telephone=null;
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
        url: '/back-office/cognitivo/sales/customers',
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








  }


},

mounted: function mounted()
{



}
});
