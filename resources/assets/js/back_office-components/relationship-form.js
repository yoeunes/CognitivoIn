
Vue.component('relationship-form',
{
    data() {
        return {
            id: 0,
            customer_alias:  '',
            customer_taxid: '',
            customer_address: '',
            customer_telephone: '',
            customer_email: '',
            customer_telephone: '',
            supplier_alias: '',
            supplier_taxid:  '',
            supplier_address: '',
            supplier_telephone: '',
            supplier_email: '',
            supplier_telephone: '',
            credit_limit: '',
            contract_ref: ''
        }
    },

    methods:
    {
        onEdit: function(data)
        {
            var app = this;

            app.id = data.id;
            app.customer_alias = data.customer_alias;
            app.customer_taxid = data.customer_taxid;
            app.customer_address = data.customer_address;
            app.customer_telephone = data.customer_telephone;
            app.customer_email = data.customer_email;
            app.customer_telephone = data.customer_telephone;
            app.supplier_alias = data.supplier_alias;
            app.supplier_taxid = data.supplier_taxid;
            app.supplier_address = data.supplier_address;
            app.supplier_telephone = data.supplier_telephone;
            app.supplier_email = data.supplier_email;
            app.supplier_telephone = data.supplier_telephone;
            app.credit_limit = data.credit_limit;
            app.contract_ref = data.contract_ref;
        },

        onReset: function(isnew)
        {
            var app = this;

            app.id = null;
            app.customer_alias = null;
            app.customer_taxid = null;
            app.customer_address = null;
            app.customer_telephone = null;
            app.customer_email = null;
            app.customer_telephone = null;
            app.supplier_alias = null;
            app.supplier_taxid = null;
            app.supplier_address = null;
            app.supplier_telephone = null;
            app.supplier_email = null;
            app.supplier_telephone = null;
            app.credit_limit = null;
            app.contract_ref = null;
        },
    },

    mounted: function mounted()
    {

    }
});
