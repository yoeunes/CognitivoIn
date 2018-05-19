import Vue from 'vue';
import VueSweetAlert from 'vue-sweetalert';
import axios from 'axios';


Vue.component('vat-form',
{
    props: ['profile'],
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
        onCreate()
        {
            var app = this;
            app.showDetail = false;
        },

        onEditDetail(data)
        {
            var app = this;
            app.showDetail = false;
            app.coefficient = data.coefficient;
            app.percent = data.percent;
            app.detail_id = data.id;
        },

        onDetailSave: function(json,isnew)
        {
            var app = this;
            var api = null;

            axios({
                method: 'post',
                url: '/back-office/'+ this.profile +'/sales/vatdetail',
                responseType: 'json',
                data: json

            }).then(function (response)
            {
                if (response.status = 200 )
                {
                    app.showDetail = true;
                    app.vatdetails = [];

                    for (var i = 0; i < response.data.length; i++) {
                        app.vatdetails.push(response.data[i]);
                        app.id = response.data[i].vat_id;
                    }
                }
                else
                {
                    alert('Something Went Wrong...')
                }
            })
            .catch(function (error)
            {
                console.log(error);
                console.log(error.response);
            });
        },

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

        //Takes Json and uploads it into Sales Invoice API for inserting. Since this is a new, it should directly insert without checking.
        //For updates code will be different and should use the ID's palced int he Json.
        onSave: function(json,isnew)
        {
            var app = this;
            var api = null;
            app.$parent.onSave('/back-office/'+ this.profile +'/sales/vats',json);
        }
    },

    mounted: function mounted()
    {

    }
});
