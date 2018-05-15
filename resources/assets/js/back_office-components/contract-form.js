import Vue from 'vue';
import VueSweetAlert from 'vue-sweetalert';
import axios from 'axios';


Vue.component('contract-form',
{

  props: ['profile'],
  data() {
    return {

      id: 0,
      name:'',
      contractdetails:[],
      showDetail:true,
      detail_id:0,
      offset:'',
      percent:''


    }
  },



  methods:
  {
    onCreate()
    {
      var app = this;
      app.showDetail = false;
    },
    onEditDetail(data)
    {
      var app = this;
      app.showDetail = false;
      app.offset=data.coefficient;
      app.percent=data.percent;
      app.detail_id=data.id;
    },
    onDetailSave: function(json,isnew)
    {
      var app = this;
      var api = null;



      axios({
        method: 'post',
        url: '/back-office/'+ this.profile +'/sales/contractdetail',
        responseType: 'json',
        data: json

      }).then(function (response)
      {

        if (response.status = 200 )
        {
          app.showDetail = true;
          app.contractdetails=[];

          for (var i = 0; i < response.data.length; i++) {
            app.contractdetails.push(response.data[i]);
            
            app.id=response.data[i].contract_id;
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

      var app = this;
      app.id=data.id;
      app.name=data.name;
      app.contractdetails=[];
      for (var i = 0; i < data.details.length; i++) {
        app.contractdetails.push(data.details[i]);
      }

      app.$parent.showList = false;
    },

    onReset: function(isnew)
    {
      var app = this;
      app.id=null;
      app.name='';
      if (isnew == false)
      {
        app.$parent.showList  = true;
      }
    },

    //Takes Json and uploads it into Sales Invoice API for inserting. Since this is a new, it should directly insert without checking.
    //For updates code will be different and should use the ID's palced int he Json.
    onSave: function(json,isnew)
    {
      var app = this;
      var api = null;
      app.$parent.onSave('/back-office/'+ this.profile +'/sales/contracts',json);

    }











  },

  mounted: function mounted()
  {



  }
});
