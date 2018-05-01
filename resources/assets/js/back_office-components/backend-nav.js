//import Vue from 'vue';

Vue.component('backend-nav',{
    //template:'<infinity  baseurl="commercial/items" inline-template><div><div v-if="$parent.showList">@include("back_office/items/list")</div><div v-else>@include("back_office/items/form")</div></div></infinity>',
    // props: ['profile'],
    data () {
        return {
            html: '<h1>Loading...</h1>',
            showItem:0
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
            // this.$http.get('/back-office/items').then(response => {
            //     this.html = response.bodyText;
            //     console.log(response)
            // });
        },
        Customers()
        {
            this.$http.get('/back-office/sales/customers').then(response => {
                this.html = response.data;
            });
        },
        Opportunities()
        {
            this.$http.get('/back-office/sales/opportunities').then(response => {
                this.html = response.data;
            });
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
