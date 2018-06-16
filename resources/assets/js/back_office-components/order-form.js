import Items from './ItemComponent.vue';

Vue.component('order-form',
{
    components:{
        'item': Items
    },

    data: function () {
        return {
            id: 0,
            item_name:'',
            relationship_id:'',
            customer_name:'',
            customer_address:'',
            customer_telephone:'',
            customer_email:'',
            currency:'PYG',
            customers:[],
            items:[],
            //itemscomponent:[],
            details:[]
        }
    },

    methods: {
        onEdit: function(data)
        {
            var app = this;

            app.id = data.id;
            app.relationship_id = data.relationship_id,
            app.customer_name = data.relationship.customer_alias,
            app.customer_address = data.relationship.customer_address,
            app.customer_telephone = data.relationship.customer_telephone,
            app.customer_email = data.relationship.customer_email,
            app.details  =  [];
            for (var i = 0; i < data.details.length; i++)
            {
                app.details.push({
                    id:data.details[i].id,
                    price: data.details[i].unit_price,
                    cost: data.details[i].unit_cost,
                    sku: data.details[i].item_sku,
                    sub_total: data.details[i].unit_price * data.details[i].quantity,
                    name:  data.details[i].item_name,
                    quantity: data.details[i].quantity,
                    item_id: data.details[i].item_id

                });
            }
        },

        onShow: function(data)
        {
            var app = this;

            app.id = data.id;
            app.relationship_id = data.relationship_id,
            app.customer_name = data.customer_alias,
            app.customer_address = data.customer_address,
            app.customer_telephone = data.customer_telephone,
            app.customer_email = data.customer_email,
            app.details  =  [];
            for (var i = 0; i < data.details.length; i++)
            {
                app.details.push({
                    id:data.details[i].id,
                    price: data.details[i].unit_price,
                    cost: data.details[i].unit_cost,
                    sku: data.details[i].item_sku,
                    sub_total: data.details[i].unit_price * data.details[i].quantity,
                    name:  data.details[i].item_name,
                    quantity: data.details[i].quantity,
                    item_id: data.details[i].item_id
                });
            }
        },

        addQuantity: function (detail)
        {

            var app = this;
            detail.quantity = detail.quantity + 1;
            var orderdata = null;
            if (app.details != null) {
                for(let i = 0; i < app.details.length; i++)
                {

                    if (app.details[i].sku == detail.sku)
                    {
                        orderdata = app.details[i];

                        break;
                    }
                }
            }

            if (orderdata == null)
            {
                app.details.push(
                    {
                        id:0,

                        price: detail.price,
                        cost: detail.cost,
                        sku: detail.sku,
                        sub_total: detail.price * detail.quantity,
                        name:  detail.name,
                        quantity: detail.quantity,
                        item_id: detail.item_id

                    });
                }
                else
                {

                    orderdata.quantity =   orderdata.quantity + detail.quantity;
                    orderdata.sub_total = detail.quantity * detail.price;
                    console.log(orderdata );
                }
            },

            removeQuantity: function (detail)
            {
                var app = this;
                var orderdata = null;
                var index = 0;
                if (app.details != null) {
                    for(let i = 0; i < app.details.length; i++)
                    {
                        if (app.details[i].sku == detail.sku)
                        {
                            orderdata = app.details[i];
                            index = i;
                            break;
                        }
                    }
                }

                if (detail.quantity == 0)
                {
                    detail.quantity = 0;
                }
                else
                {
                    detail.quantity = detail.quantity - 1;

                    if (detail.quantity == 0) {
                        if (orderdata != null)
                        {
                            app.details.splice(index, 1)
                        }
                    }
                    else
                    {
                        if (orderdata != null)
                        {
                            orderdata.quantity = detail.quantity;
                            orderdata.sub_total = detail.quantity * detail.price;
                        }
                    }

                    console.log(app.details);
                }
            },

            addCustomer: function(member)
            {
                var app = this;
                if (member!=null) {
                    app.relationship_id = member.id;
                    app.customer_name= member.customer_alias;
                    app.customer_address= member.customer_address;
                    app.customer_telephone= member.customer_telephone;
                    app.customer_email= member.customer_email;
                }

            },

            getCustomers: function(query)
            {
                if (query !=null) {
                    if(query.length > 2) {
                        var app = this;

                        axios.get('/api/' + app.$route.params.profile + '/back-office/search/customers/' + query)
                        .then(({ data }) =>
                        {
                            if (data.length > 0)
                            {
                                app.customers = [];
                                for (let i = 0; i < data.length; i++)
                                {
                                    app.customers.push(data[i]);
                                }
                            }
                        })
                        .catch(ex => {
                            console.log(ex);
                            this.$swal('Error trying to load records.');
                        });
                    }
                }

            },

            addItem: function(data)
            {
                var app = this;
                if (data!=null) {
                    app.details.push({
                        id:0,
                        price: data.unit_price,
                        sku: data.sku,
                        unit_price: data.unit_price,
                        sub_total: data.unit_price,
                        name:  data.name,
                        quantity: 1,
                        item_id: data.id
                    });
                }

            },

            getItems: function(query)
            {

                if (query !=null) {
                    if(query.length > 2) {
                        var app = this;

                        axios.get('/api/' + app.$route.params.profile + '/back-office/search/items/' + query)
                        .then(({ data }) =>
                        {
                            if (data.length > 0)
                            {
                                app.items = [];
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
                    }
                }

            },
        },

        computed:
        {
            // a computed getter
            grandTotal: function ()
            {
                // `this` points to the vm instance
                var app = this;
                var total = 0.0;

                if (app.details!=null)
                {
                    for (let i = 0; i < app.details.length; i++)
                    {
                        total += parseFloat(app.details[i].quantity).toFixed(2) *
                        parseFloat(app.details[i].price).toFixed(2);
                    }
                }

                return parseFloat(total).toFixed(2);
            }
        },

        mounted()
        {
            //this.itemscomponent = this.$children;




        }
    });
