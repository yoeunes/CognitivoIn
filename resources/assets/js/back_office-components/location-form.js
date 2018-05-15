import Vue from 'vue';
import VueSweetAlert from 'vue-sweetalert';
import axios from 'axios';

Vue.component('location-form',
{
    props: ['profile'],
    data() {
        return {
            id: 0,
            name:'',
            address: '',
            city:'',
            state:'',
            country:'',
            zip:''
        }
    },

    methods:
    {
        onEdit: function(data)
        {
            var app = this;
            app.id = data.id;
            app.name = data.name;
            app.address = data.address;
            app.city = data.city;
            app.state = data.state;
            app.$parent.showList = false;
        },

        onReset: function(isnew)
        {
            var app = this;
            app.id = null;
            app.name = '';
            app.address = '';
            app.city = '';
            app.state = '';

            if (isnew == false)
            {
                app.$parent.showList = true;
            }
        },

        //Takes Json and uploads it into Sales Invoice API for inserting. Since this is a new, it should directly insert without checking.
        //For updates code will be different and should use the ID's palced int he Json.
        onSave: function(json,isnew)
        {
            var app = this;
            var api = null;
            app.$parent.onSave('/back-office/'+ this.profile +'/sales/locations',json);
        }
    },

    mounted: function mounted()
    {

    }
});
