
Vue.component('vat-form',
{
    data() {
        return {
            id: 0,
            name: '',
            vatdetails: [],
            showDetail: true,
            detail_id: 0,
            coefficient: '',
            percent: ''
        }
    },

    methods:
    {
        onEdit: function(data)
        {
            var app = this;
            app.id = data.id;
            app.name = data.name;
            app.vatdetails = [];
            for (var i = 0; i < data.details.length; i++) {
                app.vatdetails.push(data.details[i]);
            }

            app.$parent.showList = false;
        },

        onReset: function(isnew)
        {
            var app = this;
            app.id = null;
            app.name = '';
            if (isnew == false)
            {
                app.$parent.showList = true;
            }
        },
    },

    mounted: function mounted()
    {

    }
});
