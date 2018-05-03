import Vue from 'vue';
import VueSweetAlert from 'vue-sweetalert';
import axios from 'axios';


Vue.component('pipelinestage-form',
{


  data() {
    return {

      id: 0,
      name:'',
      sequence:'',
      pipeline_id:'',
      pipelines:[]


    }
  },



  methods:
  {

    onEdit: function(data)
    {
      console.log(data)
      var app = this;
      app.name=data.name;
      app.sequence=data.sequence;
      app.pipeline_id=data.pipeline_id;
      app.$parent.$parent.showList = false;
    },

    onReset: function(isnew)
    {
      var app = this;

      app.name=null;
      app.sequence=null;
      app.pipeline_id=null;
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
        url: '/back-office/cognitivo/sales/pipelinestages',
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
    },
    getPipelines: function(data)
    {
      var app = this;
      axios.get('/api/cognitivo/back-office/list-pipelines/all/',
    )
    .then(({ data }) =>
    {
      app.pipelines = [];
      for(let i = 0; i < data.length; i++)
      {
        app.pipelines.push({ name:data[i]['name'], id:data[i]['id'] });
      }
    });

  }











},

mounted: function mounted()
{



}
});
