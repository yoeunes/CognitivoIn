import Items from './ItemComponent.vue';

Vue.component('order-form',
{
    components:{
        'item': Items
    },

    data: function () {
        return {
            cloud_id: 0,
            status:1,
            date:'',
            code:'',
            code_expiry:'',
            number:'',
            item_name:'',
            contract_id:'',
            relationship_cloud_id:'',
            customer_name:'',
            customer_address:'',
            customer_telephone:'',
            customer_email:'',
            currency:'',
            rate:'',
            customers:[],
            contracts:[],
            vats:[],
            items:[],
            //itemscomponent:[],
            details:[]
        }
    },

    methods: {
        onEdit: function(data)
        {
            var app = this;

            app.cloud_id = data.id;
            app.contract_id = data.contract_id;
            app.currency = data.currency;
            app.rate = data.currency_rate;
            app.code = data.code;
            app.number = data.number;
            app.code_expiry = data.code_expiry;
            app.relationship_cloud_id = data.relationship_id,
            app.customer_name = data.relationship.customer_alias,
            app.customer_address = data.relationship.customer_address,
            app.customer_telephone = data.relationship.customer_telephone,
            app.customer_email = data.relationship.customer_email,
            app.details  =  [];
            for (var i = 0; i < data.details.length; i++)
            {
                app.details.push({
                    detail_cloud_id:data.details[i].id,
                    price: data.details[i].unit_price,
                    unit_price: data.details[i].unit_price,
                    vat_id:data.details[i].vat_id,
                    unit_price_vat: data.details[i].unit_price,
                    cost: data.details[i].unit_cost,
                    code: data.details[i].item_sku,
                    sub_total: data.details[i].unit_price * data.details[i].quantity,
                    sub_total_vat: data.details[i].unit_price_vat * data.details[i].quantity,
                    name:  data.details[i].item_name,
                    code:data.details[i].item_code,
                    quantity: data.details[i].quantity,
                    item_cloud_id: data.details[i].item_id,
                    is_shipped:0
                });
            }
        },
        onApprove($data)
        {

            var app = this;
            axios.get('/api/' + app.$route.params.profile + '/back-office/transact/salesApprove/' + $data.cloud_id)
            .then(() =>
            {
                this.$toast.open({
                    message: 'Awsome! Your work has been saved',
                    type: 'is-success'
                })
                this.onStatusChanged();
                //this.$router.push({ name: "order.index" });
            })
            .catch(ex => {
                console.log(ex.response);
                this.$toast.open({
                    duration: 5000,
                    message: 'Error trying to save record',
                    type: 'is-danger'
                })
            });
        },
        onPriceChange: function(detail)
        {

            var app = this;

            for (let i = 0; i < app.vats.length; i++)
            {
                if (detail.vat_id == app.vats[i].id)
                {
                    if (app.vats[i].details.length>0) {
                        for (var j = 0; j < app.vats[i].details.length; j++)
                        {


                            detail.unit_price_vat = parseFloat(new Number(detail.unit_price) * (1 + new Number(app.vats[i].details[j].coefficient))).toFixed(2);
                            detail.sub_total_vat=detail.unit_price_vat *detail.quantity;
                        }
                    }




                }
            }
        },


        onStatusChanged(isapproved)
        {
            var app = this;
            if (!isapproved) {
                app.$parent.onSave(app.data);
            }

            this.status=parseInt(this.status)+1;
        },

        onShow: function(data)
        {
            var app = this;

            app.cloud_id = data.id;
            app.relationship_cloud_id = data.relationship_id,
            app.customer_name = data.customer_alias,
            app.customer_address = data.customer_address,
            app.customer_telephone = data.customer_telephone,
            app.customer_email = data.customer_email,
            app.details  =  [];
            for (var i = 0; i < data.details.length; i++)
            {
                app.details.push({
                    detail_cloud_id:data.details[i].id,
                    price: data.details[i].unit_price,
                    vat_id:data.details[i].vat_id,
                    unit_price: new Number(data.details[i].unit_price),
                    unit_price_vat: new Number(data.details[i].unit_price),
                    cost: data.details[i].unit_cost,
                    code: data.details[i].item_sku,
                    sub_total: data.details[i].unit_price * data.details[i].quantity,
                    sub_total: data.details[i].unit_price_vat * data.details[i].quantity,
                    name:  data.details[i].item_name,
                    code:data.details[i].item_code,
                    quantity: data.details[i].quantity,
                    item_cloud_id: data.details[i].item_id
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

                    if (app.details[i].sku == detail.code)
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
                        cloud_id:0,

                        price: detail.price,
                        cost: detail.cost,
                        code: detail.sku,
                        sub_total: detail.price * detail.quantity,
                        name:  detail.name,
                        quantity: detail.quantity,
                        item_cloud_id: detail.item_id

                    });
                }
                else
                {

                    orderdata.quantity =   orderdata.quantity + detail.quantity;
                    orderdata.sub_total = detail.quantity * detail.price;
                    orderdata.sub_total_vat = detail.quantity * detail.unit_price_vat;
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
                        if (app.details[i].sku == detail.code)
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
                            orderdata.sub_total_vat=detail.unit_price_vat *detail.qunatity;
                        }
                    }

                    console.log(app.details);
                }
            },

            addCustomer: function(member)
            {
                var app = this;
                if (member!=null) {
                    app.relationship_cloud_id = member.id;
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
                        detail_cloud_id:0,
                        price: data.unit_price,
                        code: data.sku,
                        vat_id: data.vat_id,
                        unit_price: data.unit_price,
                        unit_price_vat: data.unit_price,
                        sub_total: data.unit_price,
                        sub_total_vat: data.unit_price,
                        name:  data.name,
                        code :data.code,
                        quantity: 1,
                        item_cloud_id: data.id,
                        is_shipped:0,
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
            getContracts: function()
            {
                var app = this;

                axios.get('/api/' + app.$route.params.profile + '/back-office/list/contracts/3')
                .then(({ data }) =>
                {
                    if (data.data.length > 0)
                    {
                        app.contracts = [];
                        for (let i = 0; i < data.data.length; i++)
                        {
                            app.contracts.push(data.data[i]);
                        }
                    }
                })
                .catch(ex => {
                    console.log(ex);
                    this.$swal('Error trying to load records.');
                });


            },
            getVats: function()
            {
                var app = this;

                axios.get('/api/' + app.$route.params.profile + '/back-office/list/vats/1')
                .then(({ data }) =>
                {
                    if (data.data.length > 0)
                    {
                        app.vats = [];
                        for (let i = 0; i < data.data.length; i++)
                        {
                            app.vats.push(data.data[i]);
                        }
                    }
                })
                .catch(ex => {
                    console.log(ex);
                    this.$swal('Error trying to load records.');
                });


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
            this.getContracts();
            this.getVats();



        }
    });
