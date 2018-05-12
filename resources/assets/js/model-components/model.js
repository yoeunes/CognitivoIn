
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
            app.showList = false;

            axios.get('/api/' + this.profile + '/back-office/list/'  + app.skip + '/' + app.url + '/' + app.filterListBy)
            .then(({ $data }) =>
            {
                return $data[0];
            });
        },

        onCancel($data)
        {
            var app = this;

        }

        onSave($url, $data)
        {
            var app = this;
            axios.put('/api/cruds/${id}', { color })
            .then(() =>
            {
                // Once AJAX resolves we can update the Crud with the new color
                this.cruds.find(crud => crud.id === id).color = color;
            });

        },

        onSaveCreate($url, $data)
        {
            var app = this;

        },

        onDelete($url, $data)
        {
            var app = this;

            axios.delete('/api/' + this.profile + '/back-office/' + app.url, {
                params: { $data: this.data.ID }
            })
            .then(() => {
                let index = this.list.findIndex(crud => list.ID === ID);
                this.list.splice(index, 1);


            });
        },

        onApprove($url, $data)
        {
            var app = this;

        },

        onAnnull($url, $data)
        {
            var app = this;

        }
    },

    mounted: function mounted()
    {

    }
});
