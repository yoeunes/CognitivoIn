
Vue.component('opportunity-item-form',
{
  data() {
    return {
      items:[],
      filteredItems:[],
    }
  },

  methods:
  {
    addItem: function()
    {

      //code for adding tasks
      var app = this;
      var $itemID=0;
      for (var i = 0; i <  app.$parent.items.length; i++) {
        if (app.$parent.items[i].id==0) {
          $itemID=app.$parent.items[i].item_id;
        }
      }

      axios.post('/api/'+ app.$parent.$parent.profile +'/back-office/opportunities/' + this.$parent.id + '/items/', {item_id:$itemID})
      .then(({ data }) =>
      {
        for (var i = 0; i <  app.$parent.items.length; i++) {
            app.$parent.items.splice(i,1);
          app.$parent.items.push({
            id: data.id,
            name: data.item.name,
            item_id: data.profile_id,
            opportunity_id: data.opportunity_id,
          });
        }

      })  .catch(ex => {
        console.log(ex.response);
        this.$swal('Error trying to load records.');
      });;
    },
    getItems: function()
    {
      var app=this;
      axios.get('/api/getItems/' +  app.$parent.$parent.profile)
      .then(({ data }) =>
      {

        if (data.length > 0)
        {
          for (let i = 0; i < data.length; i++)
          {
            app.items.push({id:0,name:data[i].name,item_id:data[i].id});
          }


        }

      })
      .catch(ex => {
        console.log(ex);
        this.$swal('Error trying to load records.');
      });
    },
    getFilteredItems(text) {
      var app=this;
      this.filteredItems = app.items.filter((option) => {
        return option.name
        .toString()
        .toLowerCase()
        .indexOf(text.toLowerCase()) >= 0

      })
    }
  },

  mounted: function mounted()
  {
    var app=this;
    app.getItems();
  }
});
