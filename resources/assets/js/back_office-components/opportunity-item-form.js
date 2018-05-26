
Vue.component('opportunity-item-form',
{
  data() {
    return {
      selected:null,
      isFetching:false,
      selectname:'',

      items:[],
    }
  },

  methods:
  {
    addItem: function(item)
    {

      var app = this;

      axios.post('/api/'+ app.$parent.$parent.profile +'/back-office/opportunities/' + this.$parent.id + '/items/', {
        item_id: item.id,
        relationship_id:app.$parent.relationship_id,
        unit_price:item.unit_price,
        vat_id:item.vat_id
      })
      .then(({ data }) =>
      {

        app.$parent.items.push({
          id: data.id,
          name: data.item.name,
          quantity: parseInt(data.quantity),
          unit_price : data.unit_price,
          vat_id : data.vat_id,
          opportunity_id: data.opportunity_id
        });


      })  .catch(ex => {
        console.log(ex.response);
        this.$swal('Error trying to load records.');
      });;
    },

    addQuantity: function(item)
    {

      var app = this;
      item.quantity=parseInt(item.quantity)+1;

      axios.put('/api/'+ app.$parent.$parent.profile +'/back-office/opportunities/'
      + this.$parent.id + '/items/' + item.id,{
        quantity:item.quantity
      })
      .then(({ data }) =>
      {



      })  .catch(ex => {
        console.log(ex.response);
        this.$swal('Error trying to load records.');
      });

    },
    removeQuantity: function(item)
    {

      var app = this;
      item.quantity=parseInt(item.quantity)-1;

      axios.put('/api/'+ app.$parent.$parent.profile +'/back-office/opportunities/'
      + this.$parent.id + '/items/' + item.id,{
        quantity:item.quantity
      })
      .then(({ data }) =>
      {



      })  .catch(ex => {
        console.log(ex.response);
        this.$swal('Error trying to load records.');
      });

    },

    deleteItem: function(item)
    {

      var app = this;
      axios.delete('/api/'+ app.$parent.$parent.profile +'/back-office/opportunities/'
      + this.$parent.id + '/items/' + item.id)
      .then(({ data }) =>
      {
        let index = this.$parent.items.findIndex(x => x.id === item.id);
        this.$parent.items.splice(index, 1);


      })  .catch(ex => {
        console.log(ex.response);
        this.$swal('Error trying to load records.');
      });
    },

    getItems: function(query)
    {
      var app = this;
      axios.get('/api/getItem/' + app.$parent.$parent.profile + '/' + query)
      .then(({ data }) =>
      {
        if (data.length > 0)
        {
          app.items=[];
          for (let i = 0; i < data.length; i++)
          {
            app.items.push(data[i]);
          }
        }
      })
      .catch(ex => {
        console.log(ex);
        this.$swal('Error trying to load records.');
      });
    },
  },

  mounted: function mounted()
  {

  }
});
