
Vue.component('opportunity-task-form',
{
    data() {
        return {
            id: 0,
            activity_type: '',
            opportunity_id: '',
            sentiment: '',
            reminder_date: null,
            date_started: '',
            date_ended: '',
            title: '',
            description: '',
            geoloc: '',
            completed: false,

            isOpen: false,
        }
    },

    methods:
    {
        addTask: function()
        {
            //code for adding tasks
            var app = this;
            var url = '/back-office/' + app.$parent.$parent.profile + '/sales/opportunities/' + app.$parent.id + '/tasks';
            var data =
            {
                id: app.id,
                activity_type: app.activity_type,
                opportunity_id: app.opportunity_id,
                sentiment: app.sentiment,
                reminder_date: app.reminder_date,
                date_started: app.date_started,
                date_ended: app.date_ended,
                title: app.title,
                description: app.description,
                geoloc: app.geoloc,
                completed: app.completed,
            }

            app.$parent.$parent.postSpecial(url, data)
            .then(function(response)
            {
                app.$parent.tasks.push({
                    id: response.id,
                    activity_type: response.activity_type,
                    opportunity_id: response.opportunity_id,
                    sentiment: response.sentiment,
                    reminder_date: response.reminder_date,
                    date_started: response.date_started,
                    date_ended: response.date_ended,
                    title: response.title,
                    description: response.description,
                    geoloc: response.geoloc,
                    completed: response.completed,
                });

                app.onReset();
            });
        },

        onReset: function()
        {
            var app = this;

            app.id = 0;
            app.activity_type = '';
            app.opportunity_id = '';
            app.sentiment = '';

            app.reminder_date = null;
            app.date_started = '';
            app.date_ended = '';

            app.title = '';
            app.description = '';
            app.geoloc = '';
            app.completed = false;
        },
    },

    mounted: function mounted()
    {

    }
});
