import Vue from 'vue';
import VueSweetAlert from 'vue-sweetalert';
// import axios from 'axios';

Vue.component('pipeline-form',
{
    data() {
        return {
            id: 0,
            name: '',
            is_active: true,
            stages:[],
        }
    },

    computed: {
        orderedStages: function ()
        {
            var app = this;
            return _.orderBy(app.stages, 'stage_sequence')
        },

        completedAsInteger: function(){
            var app = this;
            return (stage_completed * 10);
        }
    },

    methods:
    {
        onAddStage: function()
        {
            var app = this;
            var api = null;

            app.stages.push({
                id: 0,
                stage_name:'',
                stage_completed: 0,
                stage_sequence: app.stages.length + 1
            });
        },

        stageUp: function(stage)
        {
            var app = this;
            if (app.stages.length > stage.stage_sequence)
            {
                stage.stage_sequence = stage.stage_sequence + 1;
            }
        },

        stageDown: function(stage)
        {
            if (stage.stage_sequence > 1)
            {
                stage.stage_sequence = stage.stage_sequence - 1;
            }
        },

        stageCancel: function(stage)
        {
            var app = this;

            let index = this.stages.indexOf(stage);
            this.stages.splice(index, 1);
        },

        onEdit: function(data)
        {
            var app = this;
            app.id = data.id;
            app.name = data.name;

             app.stages=[];

            for (var i = 0; i < data.stages.length; i++) {
                app.stages.push({
                    id: data.stages[i].id,
                    stage_name: data.stages[i].name,
                    stage_completed: data.stages[i].completed,
                    stage_sequence: data.stages[i].sequence
                });
            }

            app.$parent.showList = false;
        },

        onReset: function(isnew)
        {
            var app = this;
            app.id = null;
            app.name = null;
            app.stages = [];

            if (isnew == false)
            {
                app.$parent.showList = true;
            }
        },
    },

    mounted: function mounted()
    {
        var app = this;

        //We want users to load stages, if none is there, we will ask user to set one up.
        if (app.stages.length == 0)
        {
            this.onAddStage();
        }
    }
});
