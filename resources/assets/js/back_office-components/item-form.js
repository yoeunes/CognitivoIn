
Vue.component('item-form',
{

    data() {
        return {
            id: 0,
            item_id: '',
            profile_id:'',
            name:'',
            sku: '',
            vat_id:'',
            short_description:'',
            long_description:'',
            currency:'',
            unit_price:'',
            unit_cost: '',
            unit_pricevat:'',
            is_active: true,
            is_global: true,
            currencies:[],
            is_stockable:false,
            vats:[],
            selected:null,
            isFetching:false,
            selectname:'',

            items:[],
        }
    },
    computed:
    {
        unit_priceVAT:
        {
            get: function ()
            {
                var app = this;

                let index = app.vats.findIndex(x => x.id === app.vat_id);

                if (app.unit_price > 0 && index>-1 && app.unit_pricevat == 0)
                {
                    var priceVAT = 0;
                    var coefficient = 0;
                    coefficient=app.vats[index].details.reduce(function(total, item){

                        return parseFloat(total) + parseFloat(item.coefficient);
                    },0);
                    

                    app.unit_pricevat = parseInt(app.unit_price) + parseFloat(app.unit_price * coefficient);
                }

                return app.unit_pricevat;
            },
            // setter
            set: function (priceVAT)
            {
                var app = this;
                app.unit_pricevat = priceVAT;
                let index = app.vats.findIndex(x => x.id === app.vat_id);

                if (app.unit_pricevat > 0 && index>-1)
                {
                    var coefficient = 0;

                    coefficient=app.vats[index].details.reduce(function(total, item){

                        return parseFloat(total) + parseFloat(item.coefficient);
                    },0);

                    pricewithoutvat = parseInt(app.unit_pricevat) / (parseInt(1) + parseFloat(coefficient));
                    app.unit_price = Math.round(parseFloat(pricewithoutvat),2);
                }
            }
        },
    },

    methods:
    {
        addItem: function(item)
        {

            var app = this;
            app.item_id=item.id;

        },
        getItems: function(query)
        {
            var app = this;
            axios.get('/api/getItem/' + app.$parent.profile + '/' + query)
            .then(({ data }) =>
            {
                if (data.length > 0)
                {
                    app.items=[];
                    for (let i = 0; i < data.length; i++)
                    {
                        app.items.push(data[i]);
                    }
                }
            })
            .catch(ex => {
                console.log(ex);
                this.$swal('Error trying to load records.');
            });
        },
        onEdit: function(data)
        {
            var app = this;
            app.id = data.id;
            app.profile_id = data.profile_id;
            app.item_id = app.is_global == false ? item_id : null;
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
            app.item_id = null;
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
