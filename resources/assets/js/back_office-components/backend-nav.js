//import Vue from 'vue';

Vue.component('backend-nav',{

  // props: ['profile'],
  data () {
    return {
      html: '<h1>Loading...</h1>',
      showItem:0,
      showCustomer:0,
      showPipeline:0,
      showPipelineStage:0,
      showOpportunity:0
    };
  },
  methods:
  {
    Dashboard: function ()
    {
      this.$http.get('/back-office/dashboard').then(response => {
        this.html = response.data;
      });
    },
    Profile: function ()
    {
      this.$http.get('/back-office/profile').then(response => {
        this.html = response.data;
      });
    },
    Stores: function ()
    {
      this.$http.get('/back-office/locations').then(response => {
        this.html = response.data;
      });
    },
    Items: function ()
    {

      this.showItem=1;
      this.showCustomer=0;
      this.showPipeline=0;
      this.showPipelineStage=0;
      this.showOpportunity=0;
      // this.$http.get('/back-office/items').then(response => {
      //     this.html = response.bodyText;
      //     console.log(response)
      // });
    },
    Customers()
    {

      this.showCustomer=1;
      this.showItem=0;
      this.showPipeline=0;
      this.showPipelineStage=0;
      this.showOpportunity=0;
      // this.$http.get('/back-office/sales/customers').then(response => {
      //   this.html = response.data;
      // });
    },
    Pipeline()
    {
      this.showPipeline=1;
      this.showCustomer=0;
      this.showItem=0;
      this.showPipelineStage=0;
      this.showOpportunity=0;
      // this.$http.get('/back-office/sales/customers').then(response => {
      //   this.html = response.data;
      // });
    },
    PipelineStage()
    {
      this.showPipeline=0;
      this.showCustomer=0;
      this.showItem=0;
      this.showPipelineStage=1;
      this.showOpportunity=0;
      // this.$http.get('/back-office/sales/customers').then(response => {
      //   this.html = response.data;
      // });
    },
    Opportunities()
    {
      this.showPipeline=0;
      this.showCustomer=0;
      this.showItem=0;
      this.showPipelineStage=0;
      this.showOpportunity=1;
    },
    Orders: function (detail)
    {
      this.$http.get('/back-office/sales/orders').then(response => {
        this.html = response.data;
      });
    }
  },
  mounted() {
    //do something after mounting vue instance
    this.html = '<h1> Loading... </h1>';
  }
});
