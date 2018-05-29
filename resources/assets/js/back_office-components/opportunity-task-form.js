
Vue.component('opportunity-task-form',
{
    data() {
        return {
            id: 0,
            activity_type: 1,
            opportunity_id: '',
            pipeline_stage_id: '',
            sentiment: '',
            date_reminder: null,
            date_started: new Date(),
            date_ended: '',
            title: '',
            description: '',
            geoloc: '',
            completed: false,
            assigned_to: 0,

            remindMe: false,
        }
    },

    methods:
    {
        deleteTask: function()
        {
            var app = this;
            var url = '/back-office/' + app.$parent.$parent.profile + '/sales/opportunities/' + app.$parent.id + '/tasks';
        },

        addTask: function()
        {
            //code for adding tasks
            var app = this;
            var url = '/back-office/' + app.$parent.$parent.profile + '/sales/opportunities/' + app.$parent.id + '/tasks';
            var data =
            {
                activity_type: app.activity_type,
                opportunity_id: app.opportunity_id,
                sentiment: app.sentiment,
                pipeline_stage_id: app.pipeline_stage_id,
                date_reminder: app.remindMe ? app.date_reminder : null,
                date_started: app.date_started,
                date_ended: app.date_ended,
                title: app.title,
                description: app.description,
                geoloc: app.geoloc,
                completed: app.completed,
                assigned_to: app.assigned_to,
            }

            app.$parent.$parent.postSpecial(url, data)
            .then(function(response)
            {
                app.$parent.tasks.push({
                    id: response.id,
                    activity_type: response.activity_type,
                    opportunity_id: response.opportunity_id,
                    pipeline_stage_id: response.pipeline_stage_id,
                    sentiment: response.sentiment,
                    date_reminder: response.date_reminder,
                    date_started: response.date_started,
                    date_ended: response.date_ended,
                    title: response.title,
                    description: response.description,
                    geoloc: response.geoloc,
                    completed: response.completed,
                    assigned_to: response.assigned_to,
                });

                app.onReset();
            });
        },

        onReset: function()
        {
            var app = this;

            app.id = 0;
            app.activity_type = 1;
            app.opportunity_id = '';
            app.sentiment = '';

            app.date_reminder = null;
            app.date_started = app.date_started;
            app.date_ended = '';

            app.pipeline_stage_id = '';
            app.title = '';
            app.description = '';
            app.geoloc = '';
            app.assigned_to = '';
            app.completed = false;
            app.remindMe = false;
        },
    },

    mounted: function mounted()
    {

    }
});
