import Vue from 'vue';
import VueSweetAlert from 'vue-sweetalert';
import axios from 'axios';


Vue.component('pipeline-form',
{
  props: ['profile'],
  data() {
    return {

      id: 0,
      name:'',


    }
  },



  methods:
  {

    onEdit: function(data)
    {
      console.log(data)
      var app = this;
        app.id=data.id;
      app.name=data.name;

      app.$parent.$parent.$parent.showList = false;
    },

    onReset: function(isnew)
    {
      var app = this;
      app.id=null;
      app.name=null;

      if (isnew == false)
      {
        app.$parent.$parent.$parent.showList = true;
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
        url: '/back-office/'+ this.profile +'/sales/pipelines',
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
