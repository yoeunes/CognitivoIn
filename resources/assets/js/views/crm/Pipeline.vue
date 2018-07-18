<template>
    <div>
        <div v-if="!showForm">
            <div class="col-md-6 col-xl-3">
                <a class="block block-rounded block-link-shadow" @click="onCreate()" href="#">
                    <div class="block-content block-content-full block-sticky-options">
                        <div class="block-options">
                            <div class="block-options-item">
                                <i class="fa fa-archive fa-2x text-success-light"></i>
                            </div>
                        </div>
                        <div class="py-20 text-center">
                            <div class="font-size-h2 font-w700 mb-0 text-success">
                                <i class="fa fa-plus"></i>
                            </div>
                            <div class="font-size-sm font-w600 text-uppercase text-muted">New Pipeline</div>
                        </div>
                    </div>
                </a>
            </div>
            <b-table :data="list" hoverable>
                <template slot-scope="props">
                    <b-table-column field="name" v-bind:label="lang('global.Name')">
                        {{ props.row.name }}
                    </b-table-column>

                    <b-table-column custom-key="actions">
                        <button class="button is-small is-light" v-on:click="onEdit(props.row)">
                            <i class="fa fa-pencil"></i>
                        </button>
                        <button v-on:click="onDelete(props.row)" type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Delete">
                            <i class="fa fa-times"></i>
                        </button>
                    </b-table-column>
                </template>
            </b-table>
            <b-pagination :total="meta.total" :current.sync="meta.current_page" :simple="false" :per-page="meta.per_page" @change="pageChange"></b-pagination>
        </div>
        <div v-if="showForm">

            <div>

                <!-- User Profile -->
                <h2 class="content-heading text-black"> Opportunity Pipeline </h2>
                <div class="row items-push">
                    <div class="col-lg-3">
                        <p class="text-muted">
                            Pipelines are a great way to group your opportunities into general habbits.
                        </p>
                    </div>
                    <div class="col-lg-7 offset-lg-1">
                        <div class="form-group row">
                            <div class="col-12">
                                <label>Pipeline Name</label>
                                <input type="text" class="form-control form-control-lg" v-model="name" placeholder="Give your pipeline a nice name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label>Is Active</label>
                                <input type="checkbox" class="form-control form-control-lg" v-model="is_active">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END User Profile -->

                <!-- Personal Details -->
                <h2 class="content-heading text-black">Pipeline Stages</h2>
                <div class="row items-push">
                    <div class="col-lg-3">
                        <p class="text-muted">
                            A Pipeline should have multiple stages that help you understand how far you have reached in a particular opportunity.
                        </p>
                        <button v-on:click="onAddStage()" class="btn btn-default">
                            {{lang('global.Add Stage')}}
                        </button>
                    </div>
                    <div class="col-lg-7 offset-lg-1">
                        <table>
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <th>Stage Name</th>
                                    <th>Completion</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="stage in orderedStages">
                                    <td>@{{ stage.stage_sequence }}</td>
                                    <td><input type="text" v-model="stage.stage_name"/></td>
                                    <td>
                                        <div class="js-rating" data-score="5" data-number="10" style="cursor: pointer;">
                                            <i data-alt="1" class="fa fa-fw fa-star text-muted" title="Just Bad!"></i>&nbsp;
                                            <i data-alt="2" class="fa fa-fw fa-star text-muted" title="Almost There!"></i>&nbsp;
                                            <i data-alt="3" class="fa fa-fw fa-star text-muted" title="It’s ok!"></i>&nbsp;
                                            <i data-alt="4" class="fa fa-fw fa-star text-muted" title="That’s nice!"></i>&nbsp;
                                            <i data-alt="5" class="fa fa-fw fa-star text-muted" title="Incredible!"></i>&nbsp;
                                            <i data-alt="6" class="fa fa-fw fa-star text-muted" title="6"></i>&nbsp;
                                            <i data-alt="7" class="fa fa-fw fa-star text-muted" title="7"></i>&nbsp;
                                            <i data-alt="8" class="fa fa-fw fa-star text-muted" title="8"></i>&nbsp;
                                            <i data-alt="9" class="fa fa-fw fa-star text-muted" title="9"></i>&nbsp;
                                            <i data-alt="10" class="fa fa-fw fa-star text-muted" title="10"></i>
                                            <input name="score" type="hidden" v-model="stage.completedAsInteger">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button v-on:click="stageDown(stage)" type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Delete">
                                                <i class="fa fa-arrow-up"></i>
                                            </button>
                                            <button v-on:click="stageUp(stage)" type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Delete">
                                                <i class="fa fa-arrow-down"></i>
                                            </button>
                                            <button v-on:click="stageCancel(stage)" type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Delete">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <button v-on:click="onSave($data, false)" class="btn btn-outline-primary min-width-125 js-click-ripple-enabled m" data-toggle="click-ripple">
                        {{lang('global.Save')}}
                    </button>

                    <button v-on:click="onSave($data, true)" class="btn btn-outline-primary min-width-125 js-click-ripple-enabled" data-toggle="click-ripple">
                        {{lang('global.Save-and-New')}}
                    </button>

                    <button v-on:click="onCancel()" class="btn btn-alt-secondary min-width-125 js-click-ripple-enabled" data-toggle="click-ripple">
                        {{lang('global.Cancel')}}
                    </button>
                </div>
            </div>

        </div>
    </div>
</template>
<script>



export default {
    data() {
        return {
            profile:'',
            list: [],
            meta: [{total:0}],
            showForm:false,
            id: 0,
            name: '',
            is_active: true,
            stages:[],

        };
    },


    computed:
    {
        orderedStages: function ()
        {
            var app = this;
            return _.orderBy(app.stages, 'stage_sequence')
        },

        completedAsInteger: function(){
            var app = this;
            return (stage_completed * 10);
        }
    },
    methods: {
        onAddStage: function()
        {
            var app = this;
            var api = null;

            app.stages.push({
                id: 0,
                stage_name:'',
                stage_completed: 0,
                stage_sequence: app.stages.length + 1
            });
        },

        stageUp: function(stage)
        {
            var app = this;
            if (app.stages.length > stage.stage_sequence)
            {
                stage.stage_sequence = stage.stage_sequence + 1;
            }
        },

        stageDown: function(stage)
        {
            if (stage.stage_sequence > 1)
            {
                stage.stage_sequence = stage.stage_sequence - 1;
            }
        },

        stageCancel: function(stage)
        {
            var app = this;
            axios.delete('/back-office/' + app.profile + '/sales/pipelinestages/' + stage.id)
            .then(() => {

                let index = this.stages.indexOf(stage);
                this.stages.splice(index, 1);

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

        },
        onLoad(page) {
            this.profile=this.$route.params.profile;
            axios
            .get('/api/' + this.profile + '/back-office/list/pipelines/1?page=' + page  )
            .then(response => {

                this.list = response.data.data;
                this.meta = response.data.meta;

            }).catch(error => {

            });

        },
        pageChange (page) {
            var app = this;
            app.onLoad(page);
        },
        onCreate()
        {
            var app = this;
            app.showForm=true;
        },
        onEdit($data)
        {
            var app = this;
            app.showForm=true;

            axios.get('/api/' + app.profile + '/back-office/pipelines/' + $data.id + '/edit')
            .then(function (response) {

                app.id = response.data.id;
                app.name = response.data.name;

                app.stages=[];

                for (var i = 0; i < response.data.stages.length; i++) {
                    app.stages.push({
                        id: response.data.stages[i].id,
                        stage_name: response.data.stages[i].name,
                        stage_completed: response.data.stages[i].completed,
                        stage_sequence: response.data.stages[i].sequence
                    });
                }
            })
            .catch(ex => {
                console.log(ex);

                app.$toast.open({
                    duration: 5000,
                    message: 'Error trying to edit this record',
                    type: 'is-danger'
                })
            });
            app.onLoad(1);
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

                axios.delete('/api/' + this.profile + '/back-office/pipelines/' + $data.id)
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
        onCancel()
        {
            var app = this;
            app.showForm=false;
            app.id = null;
            app.name = null;
            app.stages = [];
            app.onLoad(1);
        },


        onSave($data)
        {
            var app = this;
            axios.post('/api/' + app.profile + '/back-office/pipelines', $data)
            .then(() =>
            {
                app.onCancel();
                this.$toast.open({
                    message: 'Awsome! Your work has been saved',
                    type: 'is-success'
                })


            })
            .catch(ex => {
                console.log(ex.response);
                this.$toast.open({
                    duration: 5000,
                    message: 'Error trying to save record',
                    type: 'is-danger'
                })
            });
        }

    },
    mounted: function mounted()
    {
        var app = this;
        app.onLoad(1);
        if (app.stages.length == 0)
        {
            app.onAddStage();
        }
    }
}
</script>
