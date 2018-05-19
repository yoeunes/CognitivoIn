
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
        showModules($moduleID)
        {
            var app = this;
            app.showModule = $moduleID;
            app.showList = true;
        },

        infiniteHandler($state)
        {
            var app = this;

            if (app.url != '')
            {
                axios.get('/api/' + this.profile + '/back-office/list/'  + app.skip + '/' + app.url + '/' + app.filterListBy,
                {
                    params:
                    {
                        page: app.list.length / this.pageSize + 1,
                    },
                })
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
                    this.$swal('Error trying to load records.');
                });
            }
        },

        //This restarts the inifity loader.
        onList($url, $showModule)
        {
            var app = this;
            app.showList = true;
            app.skip = 0;
            app.url = $url;
            app.showModule = $showModule;

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
                this.$swal('Error trying to edit record.');
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
                // confirmButtonColor: '#3085d6',
                // cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, cancel it!'
            }).then(() => {
                //clean property changes
                app.$refs.back_officeForm.onReset();
                app.showList = true;
            })
        },

        onSave($data)
        {
            var app = this;
            //alert($data.id);
            axios.post('/api/' + this.profile + '/back-office/' + app.url, $data)
            .then(() =>
            {
                this.$swal({
                    position: 'top-end',
                    type: 'success',
                    title: 'Awsome! Your work has been saved',
                    showConfirmButton: false,
                    timer: 1500
                })

                app.showList = true;
                
                if (app.$refs.infiniteLoading != null)
                { app.$refs.infiniteLoading.attemptLoad(); }
            })
            .catch(ex => {
                console.log(ex);
                this.$swal('Error trying to save record.');
            });
        },

        onSaveCreate($data)
        {
            var app = this;

            axios.post('/api/' + this.profile + '/back-office/' + app.url, $data)
            .then(() =>
            {
                //TODO run code to clean data.
                this.$swal({
                    position: 'top-end',
                    type: 'success',
                    title: 'Awsome! Your work has been saved',
                    showConfirmButton: false,
                    timer: 1500
                })

                app.showList = false;
            })
            .catch(ex => {
                console.log(ex);
                this.$swal('Error trying to save record.');
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

                    this.$swal({
                        position: 'top-end',
                        type: 'success',
                        title: 'The record has been deleted',
                        showConfirmButton: false,
                        timer: 750
                    })
                })
                .catch(ex => {
                    console.log(ex);
                    this.$swal('Error trying to delete record.');
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
                axios.post('/api/' + this.profile + '/back-office/' + app.url + '/' + $data.id + '/approve', $data)
                .then(() =>
                {
                    this.$swal({
                        position: 'top-end',
                        type: 'success',
                        title: 'Awsome! Your record has been approved',
                        showConfirmButton: false,
                        timer: 1500
                    })

                    app.showList = true;
                })
                .catch(ex => {
                    console.log(ex);
                    this.$swal('Error trying to approve record.');
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
                    this.$swal({
                        position: 'top-end',
                        type: 'success',
                        title: 'Awsome! Your record has been annulled',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    app.showList = true;
                })
                .catch(ex => {
                    console.log(ex);
                    this.$swal('Error trying to annull record.');
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
