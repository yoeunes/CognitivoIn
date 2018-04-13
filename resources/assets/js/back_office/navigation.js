
Vue.component('backend-nav',
{
    el: 'body',
    data () {
        return {
            html: '<h1>Loading...</h1>'
        };
    },
    methods:
    {
        showCustomers(){
            this.$http.get('/PaymentDue/Cognitivo').then(response => {
                this.html = response.data;
            });
        },
        showItems(){
            this.$http.get('/route').then(response => {
                this.html = response.data;
            });
        },
        showOpportunities(){
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
        this.$http.get('/route').then(response => {
            this.html = response.data;
        });
    }
});
