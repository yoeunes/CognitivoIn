
Vue.component('item-form',
{
    props: ['currency'],
    data() {
        return {
            id: 0,
            profile_id:'',
            name:'',
            sku: '',
            vat_id:'',
            short_description:'',
            long_description:'',
            currency_id:'',
            unit_price:'',
            unit_cost: '',
            is_active: true,
            currencies:[],
        }
    },

    methods:
    {
        onEdit: function(data)
        {
            var app = this;
            app.id = data.id;
            app.profile_id = data.profile_id;
            app.name = data.name;
            app.sku = data.sku;
            app.vat_id = data.vat_id;
            app.short_description = data.short_description;
            app.long_description = data.long_description;
            app.currency_id = data.currency_id;
            app.unit_price = data.unit_price;
            app.unit_cost = data.unit_cost;
            app.is_active = data.is_active;
            app.$parent.showList = false;
        },

        onReset: function(isnew)
        {
            var app = this;
            app.id = null;
            app.profile_id = null;
            app.name = null;
            app.sku = null;
            app.vat_id = null;
            app.short_description = null;
            app.long_description = null;
            app.currency_id = null;
            app.unit_price = null;
            app.unit_cost = null;
            if (!isnew) {
                app.$parent.showList = true;
            }
        },
    },

    mounted: function mounted()
    {
        var app = this;
        axios.get('/api/' + this.$parent.profile + '/back-office/list/0/vats/1')
        .then(({ data }) =>
        {
            app.vats = data;
            console.log()
        })
        .catch(error => {
            console.log(error);
            this.$swal('Error trying to edit record.');
        });

    }
});
