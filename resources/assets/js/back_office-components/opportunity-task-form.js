
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
        }
    },

    methods:
    {
        addTask: function()
        {
            //code for adding tasks
            var app = this;
            var url = '/back-office/' + app.$parent.$parent.profile + '/sales/opportunities/' + app.$parent.id + '/tasks';

            var response = app.$parent.$parent.postSpecial(url, app.data);

            if (isObject(response))
            {
                app.$parent.tasks.push({
                    id : response.data.id,
                    title : response.data.title,
                    profile_id : response.data.profile_id,
                    completed : false
                });

                this.onReset();
            }
        },

        changeStateTask: function(task)
        {
            var app = this;

            var data = app.$parent.postSpecial('status', $taskTitle);
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
