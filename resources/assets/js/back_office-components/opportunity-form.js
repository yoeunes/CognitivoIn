
Vue.component('opportunity-form',
{
    data() {
        return {
            id: 0,
            relationship_id: '',
            pipeline_id: '',
            pipeline_stage_id: '',
            deadline_date: '',
            description: '',
            status: '',
            value: '',
            is_archived: false,

            stages: [],
        }
    },

    methods:
    {
        onEdit: function(data)
        {
            var app = this;
            app.id = data.id;
            app.relationship_id = data.relationship_id;
            app.pipeline_stage_id  = data.pipeline_stage_id;
            app.deadline_date = data.deadline_date;
            app.description = data.description;
            app.status = data.status;
            app.value = data.value;
            app.is_archived = data.is_archived;
        },

        onReset: function()
        {
            var app = this;
            app.id = 0;
            app.relationship_id = '';
            app.pipeline_stage_id  = '';
            app.deadline_date = '';
            app.description = '';
            app.status = '';
            app.value = '';
            app.is_archived = '';
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
                    app.stages.push({
                        name: data[i]['name'],
                        id: data[i]['id']
                    });
                }
            });
        },
    },

    mounted: function mounted()
    {
        this.getStages();
    }
});
