
/**
* First we will load all of this project's JavaScript dependencies which
* includes Vue and other libraries. It is a great starting point when
* building robust, powerful web applications using Vue and Laravel.
*/

window.Vue = require('vue');

import Vue from 'vue';
import VueSweetalert2 from 'vue-sweetalert2';
import VueRouter from 'vue-router';
import VueResource from 'vue-resource';
// import SearchBoxCustomer from './components/searchbox.vue';
// import SearchBoxItem from './components/searchboxItem.vue';
// import SearchBoxProfile from './components/searchboxProfile.vue';
import Buefy from 'buefy';
import 'buefy/lib/buefy.css';

require('./bootstrap');
require('./components/bootstrap');

window.Vue.use(VueResource);
window.Vue.use(VueRouter);

// Vue.use(require('vue-shortkey'))
Vue.use(VueSweetalert2);
Vue.use(Buefy);
// Vue.use(Buefy, {
//     defaultIconPack: 'fas',
// })

/**
* Next, we will create a fresh Vue application instance and attach it to
* the page. Then, you may begin adding components to this application
* or customize the JavaScript scaffolding to fit your unique needs.
*/

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);

// const routes = [
//     {
//         path: '/',
//         components: {
//             SearchBoxCustomer:SearchBoxCustomer,
//             SearchBoxItem:SearchBoxItem,
//             SearchBoxProfile:SearchBoxProfile
//         }
//     },
// ];

const router = new VueRouter({
    mode: 'history',
    routes: [
        //This will cause 404 Errors to be redirected to proper site.
        { path: '*', component: NotFoundComponent },

        //{ path: '/:profile/', name: 'dashboard', component: Dashboard },
        { path: '/:profile/dashboard', name: 'dashboard', component: Dashboard },

        { path: '/:profile/crm/pipelines', name: 'pipeline.index', component: Pipelines },
        { path: '/:profile/crm/pipeline/:id', name: 'pipeline.form', component: PipelineForm },
        { path: '/:profile/crm/opportunities', name: 'opportunity.index', component: Opportunities },
        { path: '/:profile/crm/opportunity/:id', name: 'opportunity.form', component: OpportunityForm },

        { path: '/:profile/sales/customers', name: 'customer.index', component: Customers },
        { path: '/:profile/sales/customer/:id', name: 'customer.form', component: CustomerForm },
        { path: '/:profile/sales/carts', name: 'carts', component: Carts },
        { path: '/:profile/sales/orders', name: 'order.index', component: Orders },
        { path: '/:profile/sales/order/:id', name: 'order.form', component: OrderForm },

        { path: '/:profile/purchases/suppliers', name: 'supplier.index', component: Suppliers },
        { path: '/:profile/purchases/supplier/:id', name: 'supplier.form', component: SupplierForm },

        { path: '/:profile/stocks/items', name: 'item.index', component: Items },
        { path: '/:profile/stocks/item/:id', name: 'item.form', component: ItemForm },

        { path: '/:profile/finances/items', name: 'item.index', component: Items },
        { path: '/:profile/finances/item/:id', name: 'item.form', component: ItemForm },
    ]
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
}).$mount('#app');

// TODO: should we make two vue components.
// const back_office = new Vue({
//     el: '#app',
//     components: { App },
//     router,
// }).$mount('#back-office');
