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

    computed:
    {
        totalPercent: function ()
        {
            var app = this;
            var total = 0;

            for (var i = 0; i < app.details.length; i++)
            { total = +app.details[i].percent + +total; }

            return (total * 100).toFixed(2);
        },
    },

    methods:
    {
        addDetail: function()
        {
            var app = this;
            
            app.details.push({
                id: 0,
                percent: 1,
                offset: 0,
            });
        },

        removeDetail: function(detail)
        {
            var app = this;

            let index = this.details.indexOf(detail);
            this.details.splice(index, 1);
        },

        template: function(quota, interval)
        {
            var app = this;

            //clean details
            app.details = [];

            for (var i = 1; i < (quota + 1); i++) {
                app.details.push({
                    id: 0,
                    percent: (1 / quota).toFixed(4),
                    offset: Math.floor((interval / quota) * i),
                });
            }
        },

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
        },

        onReset: function(isnew)
        {
            var app = this;
            app.id = null;
            app.name = '';
            app.details = [];
        },
    },

    mounted: function mounted()
    {

    }
});
