
Vue.component('location-form',
{
    data() {
        return {
            id: 0,
            name:'',
            telephone: '',
            address: '',
            city:'',
            state:'',
            country:'',
            zip:'',
            hours: []
        }
    },

    methods:
    {
        onEdit: function(record)
        {
            var app = this;

            app.id = record.id;
            app.name = record.name;
            app.telephone = record.telephone;
            app.address = record.address;
            app.zip = record.zip;
            app.city = record.city;
            app.state = record.state;
            app.country = record.country;

            // for (var i = 0; i < record.hours.length; i++) {
            //     app.hours.push({
            //         id: record.stages[i].id,
            //         open_time: record.stages[i].open_time,
            //         close_time: record.stages[i].close_time,
            //         day: record.stages[i].day
            //     });
            // }
        },

        onReset: function()
        {
            var app = this;

            app.id = null;
            app.name = '';
            app.telephone = '';
            app.address = '';
            app.zip = '';
            app.city = '';
            app.state = '';
            app.country = '';

            app.hours = [];
        },
    },

    mounted: function mounted()
    {

    }
});
