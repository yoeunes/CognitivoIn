
Vue.component('opportunity-member-form',
{
    data() {
        return {
            selected:null,
            isFetching:false,
            selectname:'',

            profiles:[],
        }
    },

    methods:
    {
        addMember: function(member)
        {

            var app = this;

            axios.post('/api/'+ app.$parent.$parent.profile +'/back-office/opportunities/' + this.$parent.id + '/members/', {
                profile_id: member.id
            })
            .then(({ data }) =>
            {

                app.$parent.members.push({
                    id: data.id,
                    name: data.profile.name,
                    email: data.profile.email,
                    slug: '/' + data.profile.slug,
                    profile_img: data.profile.profile_img,
                    profile_id: data.profile_id,
                    opportunity_id: data.opportunity_id,
                });
            })  .catch(ex => {
                console.log(ex.response);
                this.$swal('Error trying to load records.');
            });;
        },

        deleteMember: function(member)
        {

            var app = this;
            axios.delete('/api/'+ app.$parent.$parent.profile +'/back-office/opportunities/'
            + this.$parent.id + '/members/' + member.id)
            .then(({ data }) =>
            {
                let index = this.$parent.members.findIndex(x => x.id === member.id);
                this.$parent.members.splice(index, 1);


            })  .catch(ex => {
                console.log(ex.response);
                this.$swal('Error trying to load records.');
            });;
        },

        getProfiles: function(query)
        {
            var app = this;
            axios.get('/api/back-office/' + app.$parent.$parent.profile + '/search/profiles/' + query)
            .then(({ data }) =>
            {
                if (data.length > 0)
                {
                    app.profiles=[];
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
    },

    mounted: function mounted()
    {

    }
});
