
Vue.component('team-form',
{
    data() {
        return {
            id:0,
            selected:null,
            isFetching:false,
            selectname:'',
            profile_id:0,
            profiles:[],
            role:0,
        }
    },

    methods:
    {
        addMember: function(member)
        {
            var app = this;
            app.profile_id = member.id;
        },

        getProfiles: function(query)
        {
            var app = this;
            axios.get('/api/back-office/' + app.$parent.profile + '/search/profiles/' + query)
            .then(({ data }) =>
            {
                if (data.length > 0)
                {
                    app.profiles = [];
                    for (let i = 0; i < data.length; i++)
                    {
                        app.profiles.push(data[i]);
                    }
                }
            })
            .catch(ex => {
                console.log(ex);
                this.$swal('Error trying to load records.');
            });
        },
        onEdit: function(record)
        {
            console.log(record);
            var app = this;

            app.id = record.id;
            app.selectname = record.profile.name;
            app.profile_id = record.profile_id;
            app.role = record.role;

        },

        onReset: function()
        {
            var app = this;

            app.id = null;
            app.profile_id = null;
            app.role = null;
            app.selectname = '';
        },
    },

    mounted: function mounted()
    {

    }
});
