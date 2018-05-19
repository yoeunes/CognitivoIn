// import Vue from 'vue';
// import VueSweetAlert from 'vue-sweetalert';
// import axios from 'axios';

Vue.component('location-form',
{
    //props: ['profile'],
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
            app.city = record.city;
            app.state = record.state;
            app.country = record.country;
            app.zip = record.zip;

            for (var i = 0; i < record.hours.length; i++) {
                app.hours.push({
                    id: record.stages[i].id,
                    open_time: record.stages[i].open_time,
                    close_time: record.stages[i].close_time,
                    day: record.stages[i].day
                });
            }
        },

        onReset: function()
        {
            var app = this;
            app.id = null;
            app.name = '';
            app.address = '';
            app.city = '';
            app.state = '';
            app.hours = [];
        },

        //Takes Json and uploads it into Sales Invoice API for inserting. Since this is a new, it should directly insert without checking.
        //For updates code will be different and should use the ID's palced int he Json.
        onSave: function(json, isnew)
        {
            var app = this;

            if (isnew == false) {
                app.$parent.onSave(json);
            }
            else {
                app.$parent.onSaveCreate(json);
            }
        }
    },

    mounted: function mounted()
    {

    }
});
