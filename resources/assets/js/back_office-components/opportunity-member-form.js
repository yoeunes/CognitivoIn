
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
      profiles:[],
      filteredProfiles:[],
    }
  },

  methods:
  {
    addMember: function()
    {

      //code for adding tasks
      var app = this;
      var $profileID=0;
      for (var i = 0; i <  app.$parent.members.length; i++) {
        if (app.$parent.members[i].id==0) {
          $profileID=app.$parent.members[i].profile_id;
        }
      }
      console.log($profileID);
      axios.post('/api/'+ app.$parent.$parent.profile +'/back-office/opportunities/' + this.$parent.id + '/members/', {profile_id:$profileID})
      .then(({ data }) =>
      {
        for (var i = 0; i <  app.$parent.members.length; i++) {
            app.$parent.members.splice(i,1);
          app.$parent.members.push({
            id: data.id,
            name: data.profile.name,
            email: data.profile.email,
            slug: '/' + data.profile.slug,
            profile_img: data.profile.profile_img,
            profile_id: data.profile_id,
            opportunity_id: data.opportunity_id,
          });
        }

      })  .catch(ex => {
        console.log(ex.response);
        this.$swal('Error trying to load records.');
      });;
    },
    getProfiles: function()
    {
      var app=this;
      axios.get('/api/getProfile/')
      .then(({ data }) =>
      {

        if (data.length > 0)
        {
          for (let i = 0; i < data.length; i++)
          {
            app.profiles.push({id:0,slug:data[i].slug,name:data[i].name,alias:data[i].alias,profile_id:data[i].id});
          }


        }

      })
      .catch(ex => {
        console.log(ex);
        this.$swal('Error trying to load records.');
      });
    },
    getFilteredProfiles(text) {
      var app=this;
      this.filteredProfiles = app.profiles.filter((option) => {
        return option.slug
        .toString()
        .toLowerCase()
        .indexOf(text.toLowerCase()) >= 0
        & option.name
        .toString()
        .toLowerCase()
        .indexOf(text.toLowerCase()) >= 0
        & option.alias
        .toString()
        .toLowerCase()
        .indexOf(text.toLowerCase()) >= 0
      })
    }
  },

  mounted: function mounted()
  {
    var app=this;
    app.getProfiles();
  }
});
