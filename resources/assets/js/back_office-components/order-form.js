import Items from './ItemComponent.vue';

Vue.component('order-form',
{
  components:{
    'item': Items
  },

  data: function () {
    return {
      id: 0,
      relationship_id:'',
      customer_name:'',
      customer_address:'',
      customer_telephone:'',
      customer_email:'',
      customers:[],
      //itemscomponent:[],
      details:[]
    }
  },

  methods: {
    onEdit: function(data)
    {
      var app = this;

      app.id=data.id;
      app.relationship_id=data.relationship_id,
      app.customer_name=data.customer_name,
      app.customer_address=data.customer_address,
      app.customer_telephone=data.customer_telephone,
      app.customer_email=data.customer_email,
      app.details = [];
      for (var i = 0; i < data.details.length; i++)
      {
        app.details.push(
          {
            id:data.details[i].id,
            price: data.details[i].unit_price,
            cost: data.details[i].unit_cost,
            sku: data.details[i].item_sku,
            sub_total: data.details[i].unit_price * data.details[i].quantity,
            name:  data.details[i].item_name,
            quantity: data.details[i].quantity,
            item_id: data.details[i].item_id

          });
        }
      },
      addQuantity: function (detail)
      {

        var app = this;
        detail.quantity = detail.quantity + 1;
        var orderdata = null;
        if (app.details != null) {
          for(let i = 0; i < app.details.length; i++)
          {

            if (app.details[i].sku == detail.sku)
            {
              orderdata = app.details[i];

              break;
            }
          }
        }

        if (orderdata == null)
        {
          app.details.push(
            {
              id:0,

              price: detail.price,
              cost: detail.cost,
              sku: detail.sku,
              sub_total: detail.price * detail.quantity,
              name:  detail.name,
              quantity: detail.quantity,
              item_id: detail.item_id

            });
          }
          else
          {

            orderdata.quantity =   orderdata.quantity + detail.quantity;
            orderdata.sub_total = detail.quantity * detail.price;
              console.log(orderdata );
          }
        },

        removeQuantity: function (detail)
        {
          var app = this;
          var orderdata = null;
          var index = 0;
          if (app.details != null) {
            for(let i = 0; i < app.details.length; i++)
            {
              if (app.details[i].sku == detail.sku)
              {
                orderdata = app.details[i];
                index = i;
                break;
              }
            }
          }

          if (detail.quantity == 0)
          {
            detail.quantity = 0;
          }
          else
          {
            detail.quantity = detail.quantity - 1;

            if (detail.quantity == 0) {
              if (orderdata != null)
              {
                app.details.splice(index, 1)
              }
            }
            else
            {
              if (orderdata != null)
              {
                orderdata.quantity = detail.quantity;
                orderdata.sub_total = detail.quantity * detail.price;
              }
            }

            console.log(app.details);
          }
        },

        onContactChange: function ()
        {
          var app = this;
          if(app.relationship_id !== '')
          {
            axios.get('/api/'+ app.$parent.profile  + '/back-office/customers' + '/'  +  app.relationship_id + '/edit' )
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
      },

      computed:
      {
        // a computed getter
        grandTotal: function ()
        {
          // `this` points to the vm instance
          var app = this;
          var total = 0.0;

          if (app.details!=null)
          {
            for (let i = 0; i < app.details.length; i++)
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
        //this.itemscomponent = this.$children;
        var app = this;

        axios.get('/api/getCustomers/' + app.$parent.profile)
        .then(function (resp)
        {
          app.customers = resp.data;
        })
        .catch(function (resp)
        {
          alert(' Could not load Slug, "' + slug + '" on Order Component ');
        });

      }
    });
