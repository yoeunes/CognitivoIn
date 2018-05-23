
Vue.component('opportunity-member-form',
{
    data() {
        return {
            id: 0,
            profile_id: '',
            opportunity_id: '',
            member: '',
            email: '',
            slug: '',
            profile_img: '',
        }
    },

    methods:
    {
        addMember: function($profileID)
        {
            console.log($profileID);
            //code for adding tasks
            var app = this;
            axios.post('/api/'+ app.$parent.$parent.profile +'/back-office/opportunities/' + this.$parent.id + '/members/', {profile_id:$profileID})
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
    },

    mounted: function mounted()
    {

    }
});
