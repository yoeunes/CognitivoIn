import Vue from 'vue';

Vue.use(require('vue-resource'));

new Vue({
    el: 'body',

    data: {
        html: '<p>Loading...</p>'
    },
    methods(){
        showCustomers(){
            this.$http.get('/route').then(response => {
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
        showCarts(){
            this.$http.get('/route').then(response => {
                this.html = response.data;
            });
        }
    },
    ready() {
        this.$http.get('/route').then(response => {
            this.html = response.data;
        });
    }
});
