
Vue.component('opportunity-task-form',
{
    data() {
        return {
            id: 0,
            activity_type: '',
            opportunity_id: '',
            sentiment: '',
            reminder_date: '',
            date_started: '',
            date_ended: '',
            title: '',
            description: '',
            geoloc: '',
            completed: false,
            taske:[]
        }
    },

    methods:
    {
        addTask:   function()
        {
            //code for adding tasks
            var app = this;
            var url = '/back-office/' + app.$parent.$parent.profile + '/sales/opportunities/' + app.$parent.id + '/tasks';
            var data=
                {
                    id: app.id,
                    activity_type:app.activity_type,
                    opportunity_id:app.opportunity_id,
                    sentiment:app.sentiment,
                    reminder_date:app.reminder_date,
                    date_started:app.date_started,
                    date_ended:app.date_ended,
                    title:app.title,
                    description:app.description,
                    geoloc:app.geoloc,
                    completed: app.completed,
                }
                app.$parent.$parent.postSpecial(url, data);
                app.$parent.tasks.push({
                    id: data.id,
                    activity_type: data.activity_type,
                    opportunity_id: data.opportunity_id,
                    sentiment: data.sentiment,
                    reminder_date: data.reminder_date,
                    date_started: data.date_started,
                    date_ended: data.date_ended,
                    title: data.title,
                    description: data.description,
                    geoloc: data.geoloc,
                    completed: data.completed,
                });





            app.onReset();
        },

        changeStateTask: function(task)
        {
            var app = this;
            var url = '/back-office/' + app.$parent.$parent.profile + '/sales/opportunities/' + app.$parent.id + '/tasks';

            var data = app.$parent.postSpecial(url, task);
            //find index in list and update value.
        },


        onEdit: function(data)
        {
            var app = this;

            app.id = data.id;
            app.activity_type = data.activity_type;
            app.opportunity_id = data.opportunity_id;
            app.sentiment = data.sentiment;

            app.reminder_date = data.reminder_date;
            app.date_started = data.date_started;
            app.date_ended = data.date_ended;

            app.title = data.title;
            app.description = data.description;
            app.geoloc = data.geoloc;
            app.completed = data.completed;
        },

        onReset: function()
        {
            var app = this;

            app.id = 0;
            app.activity_type = '';
            app.opportunity_id = '';
            app.sentiment = '';

            app.reminder_date = '';
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
