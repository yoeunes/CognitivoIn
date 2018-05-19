import Vue from 'vue';
import VueSweetAlert from 'vue-sweetalert';
import axios from 'axios';


Vue.component('contract-form',
{
    data() {
        return {
            id: 0,
            name: '',
            details: [],
        }
    },

    methods:
    {
        onEdit: function(data)
        {
            var app = this;
            app.id = data.id;
            app.name = data.name;
            app.details = [];
            for (var i = 0; i < data.details.length; i++)
            {
                app.details.push(data.details[i]);
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
