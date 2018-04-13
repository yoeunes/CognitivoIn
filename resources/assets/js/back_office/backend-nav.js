var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

Vue.component('backend-nav',{
    // props: ['profile'],
    data () {
        return {
            html: '<h1>Loading...</h1>'
        };
    },
    methods:
    {
        showCustomers()
        {
            this.$http.get('/PaymentDue/Cognitivo').then(response => {
                this.html = response.data;
            });
        },
        showItems()
        {
            this.$http.get('/route').then(response => {
                this.html = response.data;
            });
        },
        showOpportunities()
        {
            this.$http.get('/route').then(response => {
                this.html = response.data;
            });
        },
        showCarts: function (detail)
        {
            this.$http.get('/route').then(response => {
                this.html = response.data;
            });
        }
    },

    mounted() {
        this.$http.get('/').then(response => {
            this.html = response.data;
        });
    }
});
