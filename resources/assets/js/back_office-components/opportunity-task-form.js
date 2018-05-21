
Vue.component('opportunity-task-form',
{
    props: ['opportunityID'],
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
            tasks:[]
        }
    },

    computed:
    {
        activeTasks: function ()
        {
            var app = this;

            return app.$parent.list.filter(function(i) {
                return i.is_completed === '0'
            })
        },

        completedTasks: function ()
        {
            var app = this;

            return app.$parent.list.filter(function(i) {
                return i.is_completed === '1'
            })
        },
    },

    methods:
    {
        addTask: function()
        {
            //code for adding tasks
            var app = this;

            app.tasks.push({
                id: app.id,
                activity_type: 1,
                opportunity_id: app.opportunity_id,
                sentiment: 1,

                reminder_date: null,
                date_started: null,
                date_ended: null,

                title: app.title,
                description: null,
                geoloc: null,
                completed: false
            });

        
            app.$parent.postSpecial('/back-office/'+ app.$parent.profile +'/sales/opportunities/' + app.opportunity_id + '/tasks' ,app.tasks);

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
