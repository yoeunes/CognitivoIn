// import Vue from 'vÍue';
// import VueSweetAlert from 'vue-sweetalert';
// import axios from 'axios';

Vue.component('opportunity-form',
{
    data() {
        return {
            id: 0,
            relationship_id:'',
            description:'',
            deadline_date:'',
            value:'',
            stage_id:'',
            stages:[],
            customers:[]
        }
    },

    methods:
    {
        onEdit: function(data)
        {
            console.log(data)
            var app = this;
            app.id = data.id;
            app.relationship_id = data.relationship_id;
            app.description = data.description;
            app.deadline_date = data.deadline_date;
            app.value = data.value;
            app.stage_id  = data.pipeline_stage_id
            app.$parent.showList = false;
        },

        onReset: function(isnew)
        {
            var app = this;
            app.id = null;
            app.relationship_id = null;
            app.description = null;
            app.deadline_date = null;

            app.value = null;
            app.stage_id = null;
            if (isnew == false)
            {
                app.$parent.showList = true;
            }
        },

        getStages: function(data)
        {
            var app = this;
            axios.get('/api/'+ this.profile +'/back-office/pipelinestages/')
            .then(({ data }) =>
            {
                app.stages = [];
                for(let i = 0; i < data.length; i++)
                {
                    app.stages.push({ name: data[i]['name'], id: data[i]['id'] });
                }
            });
        },

        getCustomers: function(data)
        {
            var app = this;
            axios.get('/api/getCustomers/'+ this.profile +'/')
            .then(({ data }) =>
            {
                app.customers = [];
                for(let i = 0; i < data.length; i++)
                {
                    app.customers.push({ name:data[i]['customer_alias'], id:data[i]['id'] });
                }
            });
        }
    },

    mounted: function mounted()
    {
        this.getStages();
        this.getCustomers();
    }
});
