// Vue.use(Buefy.default)

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
            tasks:[],
            members:[]
        }
    },
    computed:
    {
        activeTasks: function ()
        {
            var app = this;

            return app.tasks.filter(function(i) {
                return i.completed == 0
            })
        },

        completedTasks: function ()
        {
            var app = this;
            return app.tasks.filter(function(i) {
                return i.completed == 1
            })
        },
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

        onShow: function(data)
        {
            var app = this;

            app.tasks = [];
            for (var i = 0; i < data.tasks.length; i++) {
                app.tasks.push({
                    id: data.tasks[i].id,
                    activity_type: data.tasks[i].activity_type,
                    opportunity_id: data.tasks[i].id,
                    sentiment: data.tasks[i].sentiment,

                    reminder_date: data.tasks[i].reminder_date,
                    date_started: data.tasks[i].date_started,
                    date_ended: data.tasks[i].date_ended,

                    title: data.tasks[i].title,
                    description: data.tasks[i].description,
                    geoloc: data.tasks[i].geoloc,
                    completed: data.tasks[i].completed
                });
            }

            app.members = [];
            for (var i = 0; i < data.members.length; i++) {
                app.members.push({
                    id: data.members[i].id,
                    member: data.members[i].name,
                    email: data.members[i].email,
                    profile_id: data.members[i].profile_id,
                    opportunity_id: data.members[i].opportunity_id,
                });
            }
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

            app.tasks = [];
            app.members = [];
        },

        getStages: function(data)
        {
            var app = this;
            axios.get('/api/' + app.$parent.profile + '/back-office/pipeline-stages/')
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
