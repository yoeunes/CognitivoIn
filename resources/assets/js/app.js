
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
import SearchBoxCustomer from './components/searchbox.vue';
import SearchBoxItem from './components/searchboxItem.vue';
import SearchBoxProfile from './components/searchboxProfile.vue';
import Buefy from 'buefy';
import 'buefy/lib/buefy.css';


require('./bootstrap');
require('./components/bootstrap');

window.Vue.use(VueResource);
window.Vue.use(VueRouter);
Vue.use(require('vue-shortkey'))
Vue.use(VueSweetalert2);
Vue.use(Buefy);

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

const routes = [
    {
        path: '/',
        components: {
            SearchBoxCustomer:SearchBoxCustomer,
            SearchBoxItem:SearchBoxItem,
            SearchBoxProfile:SearchBoxProfile

        }
    },
];

const router = new VueRouter({ routes });

const app = new Vue({ router }).$mount('#app');
