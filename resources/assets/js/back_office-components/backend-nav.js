
Vue.component('backend-nav',
{
    data () {
        return {
            showDashboard: 1,
            showProfile: 0,
            showLocations: 0,
            showItem: 0,
            showCustomer: 0,
            showPipeline: 0,
            showOpportunity: 0,
            showOrders: 0,
        };
    },

    methods:
    {
        Dashboard: function ()
        {
            this.showDashboard = 1,
            this.showProfile = 0,
            this.showLocations = 0,
            this.showItem = 0;
            this.showCustomer = 0;
            this.showPipeline = 0;
            this.showOpportunity = 0;
            this.showOrders = 0;
        },

        Profile: function ()
        {
            this.showDashboard = 0,
            this.showProfile = 1,
            this.showLocations = 0,
            this.showItem = 0;
            this.showCustomer = 0;
            this.showPipeline = 0;
            this.showOpportunity = 0;
            this.showOrders = 0;
        },

        Stores: function ()
        {
            this.showDashboard = 0,
            this.showProfile = 0,
            this.showLocations = 1,
            this.showItem = 0;
            this.showCustomer = 0;
            this.showPipeline = 0;
            this.showOpportunity = 0;
            this.showOrders = 0;
        },

        Items: function ()
        {
            this.showDashboard = 0,
            this.showProfile = 0,
            this.showLocations = 0,
            this.showItem = 1;
            this.showCustomer = 0;
            this.showPipeline = 0;
            this.showOpportunity = 0;
            this.showOrders = 0;
        },

        Customers()
        {
            this.showDashboard = 0,
            this.showProfile = 0,
            this.showLocations = 0,
            this.showItem = 0;
            this.showCustomer = 1;
            this.showPipeline = 0;
            this.showOpportunity = 0;
            this.showOrders = 0;
        },

        Pipeline()
        {
            this.showDashboard = 0,
            this.showProfile = 0,
            this.showLocations = 0,
            this.showItem = 0;
            this.showCustomer = 0;
            this.showPipeline = 1;
            this.showOpportunity = 0;
            this.showOrders = 0;
        },

        Opportunities()
        {
            this.showDashboard = 0,
            this.showProfile = 0,
            this.showLocations = 0,
            this.showItem = 0;
            this.showCustomer = 0;
            this.showPipeline = 0;
            this.showOpportunity = 1;
            this.showOrders = 0;
        },

        Orders()
        {
            this.showDashboard = 0,
            this.showProfile = 0,
            this.showLocations = 0,
            this.showItem = 0;
            this.showCustomer = 0;
            this.showPipeline = 0;
            this.showOpportunity = 0;
            this.showOrders = 1;
        }
    },
    mounted()
    {
        //do something after mounting vue instance
    }
});
