
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
import Buefy from 'buefy';
import Reports from './components/reports.vue';
import 'buefy/lib/buefy.css';

require('./bootstrap');
require('./components/bootstrap');

window.Vue.use(VueResource);
window.Vue.use(VueRouter);
Vue.use(require('vue-shortkey'))
Vue.use(VueSweetalert2);
Vue.use(Buefy);

/**
Back-Office views to be used for Ajax Loaded sites.
*/

import Dashboard from './views/Dashboard';
import NotFoundComponent from './views/NotFoundComponent';

import ProfileForm from './views/config/ProfileForm';
import Location from './views/config/Location';
import SalesTax from './views/config/SalesTax';
import Contract from './views/config/Contract';
import TeamMember from './views/config/TeamMember';

import Crm_Dashboard from './views/crm/Dashboard';
import Pipelines from './views/crm/Pipeline';
import Opportunities from './views/crm/Opportunity';
import OpportunityForm from './views/crm/OpportunityForm';
import OpportunityShow from './views/crm/OpportunityShow';

import Sales_Dashboard from './views/sales/Dashboard';
import Customers from './views/sales/Customer';
import CustomerForm from './views/sales/CustomerForm';
import Orders from './views/sales/Order';
import OrderForm from './views/sales/OrderForm';

import Purchase_Dashboard from './views/purchase/Dashboard';
import Suppliers from './views/purchase/Supplier';
import SupplierForm from './views/purchase/SupplierForm';

import Stock_Dashboard from './views/stock/Dashboard';
import Items from './views/stock/Item';
import ItemForm from './views/stock/ItemForm';
import Promotion from './views/stock/Promotion';
import PromotionForm from './views/stock/PromotionForm';

import Finance_Dashboard from './views/finance/Dashboard';
import Accounts from './views/finance/Account';
import AccountForm from './views/finance/AccountForm';
import AccountPayables from './views/finance/AccountPayable';
import AccountReceivables from './views/finance/AccountReceivable';
import AccountMovements from './views/finance/AccountMovement';

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
const UserEmailsSubscriptions = {
	template: `
<div>
	<h3>Email Subscriptions</h3>
</div>
  `
}

const UserProfile = {
	template: `
<div>
	<h3>Edit your profile</h3>
</div>
  `
}

const UserSettings = {
	template: `
<div class="us">
  <h2>User Settings</h2>
  <UserSettingsNav/>
  <router-view/>

</div>
  `
}
//Note: These tasks are only needed to show views.
const router = new VueRouter({


    routes: [
        //This will cause 404 Errors to be redirected to proper site.

        {
            path: '/dashboard',
            component: UserSettings,
            children: [{
                path: 'items',
                component: UserEmailsSubscriptions},
                {
                    path:'customers',
                    component: UserProfile
            }]
        },

        //{ path: '/', name: 'dashboard', component: Dashboard },
        { path: '/:profile-dashboard', name: 'dashboard', component: Dashboard },

        { path: '/config/profile', name: 'profile.form', component: ProfileForm },
        { path: '/:profile/config-locations', name: 'location.index', component: Location },
        { path: '/:profile/config-sales-taxes', name: 'sales-taxes.index', component: SalesTax },
        { path: '/:profile/config-contracts', name: 'contracts.index', component: Contract },
        { path: '/:profile/config-team-members', name: 'team-members.index', component: TeamMember },

        { path: '/:profile/crm-dashboard', name: 'crm.dashboard', component: Dashboard },
        { path: '/:profile/crm-pipelines', name: 'pipeline.index', component: Pipelines },
        { path: '/:profile/crm-opportunities-:userid', name: 'opportunity.index', component: Opportunities },
        { path: '/:profile/crm-opportunity-:id-:user_id', name: 'opportunity.form', component: OpportunityForm },
        { path: '/:profile/crm-opportunity-:id', name: 'opportunity.show', component: OpportunityShow },

        { path: '/:profile/sales-dashboard', name: 'sales.dashboard', component: Dashboard },
        { path: '/:profile/sales-customers', name: 'customer.index', component: Customers },
        { path: '/:profile/sales-customer-:id', name: 'customer.form', component: CustomerForm },
        // { path: '/:profile/sales/carts', name: 'carts', component: Carts },
        { path: '/:profile/sales-orders', name: 'order.index', component: Orders },
        { path: '/:profile/sales-order-:id', name: 'order.form', component: OrderForm },

        { path: '/:profile/purchases-dashboard', name: 'purchase.dashboard', component: Dashboard },
        { path: '/:profile/purchases-suppliers', name: 'supplier.index', component: Suppliers },
        { path: '/:profile/purchases-supplier-:id', name: 'supplier.form', component: SupplierForm },

        { path: '/:profile/stocks-dashboard', name: 'stock.dashboard', component: Dashboard },
        { path: '/:profile/stocks-items', name: 'item.index', component: Items },
        { path: '/:profile/stocks-item-:id', name: 'item.form', component: ItemForm },
        { path: '/:profile/stocks-itempromotions', name: 'itempromotion.index', component: Promotion },
        { path: '/:profile/stocks-itempromotions-:id', name: 'itempromotion.form', component: PromotionForm },

        { path: '/:profile/finances-dashboard', name: 'finance.dashboard', component: Dashboard },
        { path: '/:profile/finances-accounts', name: 'account.index', component: Accounts },
        { path: '/:profile/finances-account-:id', name: 'account.form', component: AccountForm },
        { path: '/:profile/finances-account-payables', name: 'account-payable.index', component: AccountPayables },
        { path: '/:profile/finances-account-recievables', name: 'account-recievable.index', component: AccountReceivables },
        { path: '/:profile/finances-account-movements', name: 'account_movement.index', component: AccountMovements },

    ],
    components: {
        Reports : Reports

    }
});

const app = new Vue({
    el: '#app',
    // components: { App },
    router,
}).$mount('#app');
