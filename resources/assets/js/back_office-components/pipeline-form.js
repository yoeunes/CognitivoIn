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
      stages:[],
      showStage:true,
      stage_id:0,
      stage_name:'',
      stage_sequence:''


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
      app.stage_id=data.id;
      app.stage_name=data.name;
      app.stage_sequence=data.sequence;
    },
    onStageSave: function(json,isnew)
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
          app.stages=[];
          for (var i = 0; i < response.data.length; i++) {
            app.stages.push(response.data[i]);
          }
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
      for (var i = 0; i < data.stages.length; i++) {
        app.stages.push(data.stages[i]);
      }
      app.stage=data.stages;
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
