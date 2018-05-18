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
      stages:[{
        stage_id:0,
        stage_name:'',
        stage_sequence:''
      }],
      showStage:true,



    }
  },



  methods:
  {
    onCreate()
    {
      var app = this;
      app.showStage = false;
    },
    onEditStage(data)
    {
      var app = this;
      app.showStage = false;

    },
    onAddStage: function()
    {
      var app = this;
      var api = null;
      app.stages.push({stage_id:0,stage_name:'',stage_sequence:''});


    },

    onSaveStage: function(json,isnew)
    {
      var app = this;
      var api = null;



      axios({
        method: 'post',
        url: '/back-office/'+ this.profile +'/sales/pipelinestages',
        responseType: 'json',
        data: json

      }).then(function (response)
      {
        if (response.status = 200 )
        {
          app.showStage = true;
          app.id=response.data[i].pipeline_id;
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

    onEdit: function(data)
    {
      console.log(data)
      var app = this;
      app.id=data.id;
      app.name=data.name;
      app.stages.slice(0,1);
      for (var i = 0; i < data.stages.length; i++) {
        app.stages.push({stage_id: data.stages[i].id,stage_name:data.stages[i].name,
          stage_sequence:data.stages[i].sequence});
      }

      app.$parent.showList = false;
    },

    onReset: function(isnew)
    {
      var app = this;
      app.id=null;
      app.name=null;

      if (isnew == false)
      {
        app.$parent.showList = true;
      }
    },

    //Takes Json and uploads it into Sales INvoice API for inserting. Since this is a new, it should directly insert without checking.
    //For updates code will be different and should use the ID's palced int he Json.
    onSave: function(json,isnew)
    {
      var app = this;
      var api = null;


      app.$parent.onSave('/back-office/'+ this.profile +'/sales/pipelines',json);

    }











  },

  mounted: function mounted()
  {



  }
});
