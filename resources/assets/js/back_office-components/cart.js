
Vue.component('cart',
{
    props: ['profile'],
    data() {
        return {
            carts: []
        }
    },




    methods:
    {

        getCarts: function()
        {


            var app = this;
            console.log(app.profile);
            axios.get('/api/' + app.profile + '/back-office/list/carts/1')
            .then(({ data }) =>
            {
                if (data.length > 0)
                {
                    app.carts = [];
                    for (let i = 0; i < data.length; i++)
                    {
                        app.carts.push(data[i]);
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
        var app=this;

        app.getCarts();
    }
});
