
import Vue from 'vue';
import VueSweetAlert from 'vue-sweetalert';
import InfiniteLoading from 'vue-infinite-loading';
import axios from 'axios';

Vue.component('model',
{
    props: ['profile'],
    data() {
        return {
            showList: true,
            showModule: '1',
            //1 = Dashboard
            //2 = Profile
            //3 = Locations

            url: '',
            total: 0,
            skip: 0,
            pageSize: 100,

            list: [],
            filterListBy: 1,
        }
    },

    methods:
    {
        infiniteHandler($state)
        {
            var app = this;

            if (app.url != '')
            {
                axios.get('/api/' + this.profile + '/back-office/list/'  + app.skip + '/' + app.url + '/' + app.filterListBy,
                { params: { page: app.list.length / this.pageSize + 1 } })
                .then(({ data }) =>
                {

                    if (data.length > 0)
                    {
                        for (let i = 0; i < data.length; i++)
                        {
                            app.list.push(data[i]);
                        }

                        app.skip += app.pageSize;
                        $state.loaded();
                    }
                    else
                    {
                        $state.complete();
                    }
                })
                .catch(ex => {
                    //Stop loading with one ex.
                    $state.complete();
                    //Log ex for help
                    console.log(ex);
                    this.$toast.open({
                        duration: 5000,
                        message: 'Error trying to load records',
                        type: 'is-danger'
                    })
                });
            }
        },

        //This restarts the inifity loader.
        onList($url, $showModule,$filterListBy)
        {
            var app = this;
            app.showList = true;
            app.skip = 0;
            app.url = $url;
            app.showModule = $showModule;
            if ($filterListBy != null)
            {
                app.filterListBy = $filterListBy ;
            }

            app.list = [];
            //Handle the infinite loading of the list.
            if (app.$refs.infiniteLoading != null)
            { app.$refs.infiniteLoading.attemptLoad(); }
        },

        onCreate()
        {
            var app = this;
            app.showList = false;
        },

        onShow($data)
        {
            var app = this;
            app.showList = 2;

            axios.get('/api/' + this.profile + '/back-office/' + app.url + '/' + $data.id)
            .then(function (response) {
                app.$refs.back_officeForm.onShow(response.data);
            })
            .catch(ex => {
                console.log(ex);
                app.showList = true;
                this.$toast.open({
                    duration: 5000,
                    message: 'Error trying to show this record',
                    type: 'is-danger'
                })
            });
        },

        onEdit($data)
        {
            var app = this;
            app.showList = false;

            axios.get('/api/' + this.profile + '/back-office/' + app.url + '/' + $data.id + '/edit')
            .then(function (response) {
                app.$refs.back_officeForm.onEdit(response.data);
            })
            .catch(ex => {
                console.log(ex);
                app.showList = true;
                this.$toast.open({
                    duration: 5000,
                    message: 'Error trying to edit this record',
                    type: 'is-danger'
                })
            });
        },

        onCancel($data)
        {
            var app = this;

            this.$swal({
                title: 'Are you sure?',
                text: "This will cancel all changes made",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, cancel it!'
            }).then(() => {
                app.$refs.back_officeForm.onReset();
                app.showList = true;
            })
        },

        postSpecial: async function(specialURL, $data)
        {
            var app = this;
            var resp;

            await axios.post(specialURL, $data)
            .then((response) =>
            {
                this.$snackbar.open('Done!');
                resp = response.data;
            })
            .catch(ex => {
                console.log(ex);
                this.$toast.open({
                    duration: 5000,
                    message: 'Error trying to perform action',
                    type: 'is-danger'
                })
            });

            return resp;
        },

        onSave($data)
        {
            var app = this;
            console.log($data);
            axios.post('/back-office/'+ this.profile +'/sales/' + app.url, $data)
            .then(() =>
            {
                this.$toast.open({
                    message: 'Awsome! Your work has been saved',
                    type: 'is-success'
                })

                app.showList = true;

                if (app.$refs.infiniteLoading != null)
                { app.$refs.infiniteLoading.attemptLoad(); }
            })
            .catch(ex => {
                console.log(ex.response);
                this.$toast.open({
                    duration: 5000,
                    message: 'Error trying to save record',
                    type: 'is-danger'
                })
            });
        },

        onSaveCreate($data)
        {
            var app = this;

            axios.post('/api/' + this.profile + '/back-office/' + app.url, $data)
            .then(() =>
            {
                //TODO run code to clean data.
                this.$toast.open({
                    message: 'Awsome! Your work has been saved',
                    type: 'is-success'
                })

                app.showList = false;
            })
            .catch(ex => {
                console.log(ex);
                this.$toast.open({
                    duration: 5000,
                    message: 'Error trying to save record',
                    type: 'is-danger'
                })
            });
        },

        onDelete($data)
        {
            var app = this;

            this.$swal({
                title: 'Delete Record',
                text: "Sure? This action is non-reversable",
                type: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            })
            .then(() => {

                axios.delete('/api/' + this.profile + '/back-office/' + this.url + '/' + $data.id)
                .then(() => {

                    let index = this.list.findIndex(x => x.id === $data.id);
                    this.list.splice(index, 1);

                    this.$toast.open({
                        duration: 750,
                        message: 'The record has been deleted',
                        position: 'is-bottom-right',
                        type: 'is-danger'
                    })
                })
                .catch(ex => {
                    console.log(ex.response);
                    this.$toast.open({
                        duration: 5000,
                        message: 'Error trying to delete record',
                        type: 'is-danger'
                    })
                });
            });
        },

        deleteSpecial: async function(specialURL)
        {
            var app = this;
            var resp;

            this.$swal({
                title: 'Delete Record',
                text: "Sure? This action is non-reversable",
                type: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            })
            .then(() => {
                axios.delete(specialURL)
                .then((response) => {
                    resp = response.data;
                    return resp;
                })
                .catch(ex => {
                    console.log(ex.response);

                    this.$toast.open({
                        duration: 5000,
                        message: 'Error trying to delete record.',
                        type: 'is-danger'
                    })
                });
            });
        },

        onApprove($data)
        {
            var app = this;

            this.$swal({
                title: 'Approve Record',
                text: "This will process your record, and is non-reversable.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, approve it!'
            }).then(() => {
                axios.post('/api/' + this.profile + '/back-office/approve/' + app.url  , $data)
                .then(() =>
                {
                    this.$toast.open({
                        message: 'Awsome! Your record has been approved',
                        type: 'is-success'
                    })

                    app.showList = true;
                })
                .catch(ex => {
                    console.log(ex.response);
                    this.$toast.open({
                        message: 'Error trying to approve record.',
                        type: 'is-danger',
                    })
                });
                //Code to approve
            });
        },

        onAnnull($data)
        {
            var app = this;

            this.$swal({
                title: 'Annull Record',
                text: "This is non-reversable",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, annull it!'
            }).then(() => {
                //Code to annull
                axios.post('/api/' + this.profile + '/back-office/' + app.url + '/' + $data.id + '/annull', $data)
                .then(() =>
                {
                    this.$toast.open({
                        message: 'Awsome! Your record has been annulled',
                        type: 'is-danger',
                        position: 'is-bottom-right',
                    })

                    app.showList = true;
                })
                .catch(ex => {
                    console.log(ex);

                    this.$toast.open({
                        message: 'Error trying to annull record.',
                        type: 'is-danger',
                    })
                });
            });
        }
    },

    mounted: function mounted()
    {
        var app = this;
        app.showModule = 1;
    }
});
