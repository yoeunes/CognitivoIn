import Vue from 'vue';

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
            this.$http.get('/api/back-office/dashboard').then(response => {
                this.html = response.data;
            });

            // axios.get('/api/back-office/dashboard')
            // .then(function (response) {
            //     this.html = response;
            // });
        },
        viewProfile: function ()
        {
            this.$http.get('/api/back-office/profiles').then(response => {
                this.html = response.data;
            });
        },
        viewStores: function ()
        {
            this.$http.get('/api/back-office/stores').then(response => {
                this.html = response.data;
            });
        },
        viewItems: function ()
        {
            this.$http.get('/api/back-office/items').then(response => {
                this.html = response.data;
            });
        },
        viewCustomers()
        {
            this.$http.get('api/sales/customers').then(response => {
                this.html = response.data;
            });
        },
        viewItems()
        {
            this.$http.get('/route').then(response => {
                this.html = response.data;
            });
        },
        viewOpportunities()
        {
            this.$http.get('/route').then(response => {
                this.html = response.data;
            });
        },
        viewCarts: function (detail)
        {
            this.$http.get('/route').then(response => {
                this.html = response.data;
            });
        }
    },
    mounted() {
        //do something after mounting vue instance
        this.html = '<h1>Loading...</h1>';
    }
});
