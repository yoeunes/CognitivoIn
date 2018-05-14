import Vue from 'vue';
import VueSweetAlert from 'vue-sweetalert';
import axios from 'axios';
import Items from './ItemComponent.vue';

Vue.component('order-form',
{
    props: ['profile'],
  components:{
  'item':Items
},
data: function () {
  return {
    relationship_id:'',
    customer_name:'',
    customer_address:'',
    customer_telephone:'',
    customer_email:'',
    customers:[],
    itemscomponent:[],
    details:[]


  }
},

methods: {
  addQuantity: function (detail)
  {
    var app = this;
    detail.quantity=detail.quantity+1;
    var orderdata=null;
    if (app.details!=null) {
      for(let i = 0; i < app.details.length; i++)
      {
        if (app.details[i].sku==detail.sku)
        {
          orderdata=app.details[i];
          break;
        }

      }
    }


    if (orderdata==null) {


      app.details.push({ price:detail.price,cost:detail.cost,sku:detail.sku,sub_total:detail.price*detail.quantity
        ,name:detail.name,quantity:detail.quantity,item_id:detail.item_id,currency_id:detail.currency_id});



      }
      else {
        orderdata.quantity=detail.quantity;
        orderdata.sub_total=detail.quantity * detail.price;
      }

    },



    removeQuantity: function (detail)
    {
      var app = this;
      var orderdata=null;
      var index=0;
      if (app.details!=null) {
        for(let i = 0; i < app.details.length; i++)
        {
          if (app.details[i].sku==detail.sku)
          {
            orderdata=app.details[i];
            index=i;
            break;
          }

        }
      }

      if (detail.quantity==0)
      {

        detail.quantity=0;

      }
      else
      {
        detail.quantity=detail.quantity-1;
        if (detail.quantity==0) {
          if (orderdata!=null)
          {
            app.details.splice(index, 1)
          }
        }
        else {
          if (orderdata!=null)
          {
            orderdata.quantity=detail.quantity;
            orderdata.sub_total=detail.quantity * detail.price;

          }
        }

        console.log(app.details);

      }

    },
    onContactChange: function () {
      var app = this;
      if(app.relationship_id !== '')
      {
        axios.get('/api/'+ this.profile  + '/back-office/customers' + '/'  +  app.relationship_id + '/edit' )
        .then(function (resp) {

          app.customer_name = '('+ resp.data.customer_taxid + ') - ' +  resp.data.customer_alias  ;
          app.customer_address = resp.data.customer_address;
          app.customer_telephone = resp.data.customer_telephone;
          app.customer_email = resp.data.customer_email;
        })
        .catch(function (resp) {
          console.log(resp);
          alert("Could not execute onContactChange in Order Component");
        });
      }
    },

    onSave: function(json)
    {

      console.log('Started method onSave Order Component');

      axios({
        method: 'post',
        url: '/back-office/'+ this.profile +'/sales/orders',
        responseType: 'json',
        data: {
          'relationship_id': this.relationship_id,
          'details': this.details
        }

      }).then(function (response)
      {
        app.$parent.$parent.$parent.showList = true;
        //document.location = '/'  + slug + '/portal/sales/orders';
      })
      .catch(function (error)
      {
        console.log(error);
      });
    }
  },
  computed: {
    // a computed getter
    grandTotal: function () {

      // `this` points to the vm instance
      var app = this;
      var total = 0.0;



      if (app.details!=null)
      {

        for(let i = 0; i < app.details.length; i++)
        {
          total += parseFloat(app.details[i].quantity).toFixed(2) *
          parseFloat(app.details[i].price).toFixed(2);
        }
      }



      return parseFloat(total).toFixed(2);
    }
  },

  mounted()
  {

    this.itemscomponent=this.$children;
    var app = this;

      axios.get('/api/getCustomers/' + this.profile )
      .then(function (resp)
      {
        console.log(resp.data);
        app.customers = resp.data;
      })
      .catch(function (resp)
      {
        alert(' Could not load Slug, "' + slug + '" on Order Component ');
      });

  }
});
