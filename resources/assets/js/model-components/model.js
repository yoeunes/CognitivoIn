
import VueSweetAlert from 'vue-sweetalert';
import InfiniteLoading from 'vue-infinite-loading';
import axios from 'axios';

Vue.component('model',
{
    props: ['profile'],

    data() {
        return
        {
            showList: true,
            showModule: 1,

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

        showModule($moduleID)
        {
            var app = this;
            app.showModule = $moduleID;
        },

        infiniteHandler($state)
        {
            var app = this;
            if (app.url != '')
            {
                axios.get('/api/' + this.profile + '/back-office/list/'  + app.skip + '/' + app.url + '/' + app.filterListBy +,
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
                });
            }
        },

        //This restarts the inifity loader.
        onList($url, $filter)
        {
            var app = this;
            this.skip = 0;
            this.$refs.infiniteLoading.attemptLoad();
        },

        onCreate()
        {
            var app = this;
            app.showList = false;
        },

        onEdit($url, $data)
        {
            var app = this;

            axios.get('/api/' + this.profile + '/back-office/list/'  + app.skip + '/' + app.url + '/' + app.filterListBy)
            .then(({ $data }) =>
            {
                app.showList = false;
                return $data[0];
            })
            .catch(error => {
                console.log(error.response.data);
                this.$swal('Error trying to edit record.');
            });
        },

        onCancel($data)
        {
            var app = this;
            swal({
                title: 'Are you sure?',
                text: "You will loose all your data",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, cancel it!'
            }).then((result) => {
                app.showList = true;
            })
        }

        onSave($url, $data)
        {
            var app = this;
            axios.put('/api/cruds/${id}', { color })
            .then(() =>
            {
                app.showList = true;
                this.$swal({
                    position: 'top-end',
                    type: 'success',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 1500
                })
            })
            .catch({

            });
        },

        onSaveCreate($url, $data)
        {
            var app = this;

            axios.put('/api/cruds/${id}', { color })
            .then(() =>
            {
                //TODO run code to clean data.
                app.showList = false;
                this.$swal({
                    position: 'top-end',
                    type: 'success',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 1500
                })
            })
            .catch({

            });
        },

        onDelete($url, $data)
        {
            var app = this;

            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'danger',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                axios.delete('/api/' + this.profile + '/back-office/' + app.url, {
                    params: { $data: this.data.ID }
                })
                .then(() => {
                    let index = this.list.findIndex(crud => list.ID === ID);
                    this.list.splice(index, 1);

                    this.$swal({
                        position: 'top-end',
                        type: 'success',
                        title: 'The record has been deleted',
                        showConfirmButton: false,
                        timer: 750
                    })
                })
                .catch({

                });
            })
        },

        onApprove($url, $data)
        {
            var app = this;

            swal({
                title: 'You are about to Approve',
                text: "This will process your record",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, approve it!'
            }).then((result) => {
                //Code to approve
            })
        },

        onAnnull($url, $data)
        {
            var app = this;

            swal({
                title: 'Annull? Are you sure?',
                text: "This is non-reversable",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, annull it!'
            }).then((result) => {
                //Code to annull
            })
        }
    },

    mounted: function mounted()
    {

    }
});
