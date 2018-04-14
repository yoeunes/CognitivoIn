//import Vue from 'vue';

Vue.component('backend-nav',{
    // props: ['profile'],
    data () {
        return {
            html: '<h1>Loading...</h1>'
        };
    },
    methods:
    {
        viewDashboard: function ()
        {
            this.$http.get('/back-office/dashboard').then(response => {
                   this.html = response.data;
               });
        },
        viewProfile: function ()
        {
            this.$http.get('/back-office/profile').then(response => {
                this.html = response.data;
            });
        },
        viewStores: function ()
        {
            this.$http.get('/back-office/locations').then(response => {
                this.html = response.data;
            });
        },
        viewItems: function ()
        {
            this.$http.get('/back-office/items').then(response => {
                this.html = response.data;
            });
        },
        viewCustomers()
        {
            this.$http.get('/back-office/sales/customers').then(response => {
                this.html = response.data;
            });
        },
        viewOpportunities()
        {
            this.$http.get('/back-office/sales/opportunities').then(response => {
                this.html = response.data;
            });
        },
        viewOrders: function (detail)
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
