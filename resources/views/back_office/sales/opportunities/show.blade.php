<div>
    <!-- Hero -->
    <div class="block block-rounded">
        <div class="block-content bg-pattern" style="background-image: url('/img/backgrounds/bg-pattern-inverse.png');">
            <div class="py-20 text-center">
                <h1 class="h3 mb-5">@{{ name }}</h1>
                <p class="mb-10 text-muted">
                    <em>@{{ deadline_date }}</em>
                </p>
                <p>
                    @{{ description }}
                </p>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Tasks Content -->
    <div class="row">
        <div class="col-md-5 col-xl-3">
            <!-- Toggle Tasks Navigation on mobile -->
            <button type="button" class="btn btn-block btn-primary d-md-none mb-10" data-toggle="class-toggle" data-target=".js-tasks-nav" data-class="d-none d-md-block">
                Menu
            </button>

            <!-- Collapsible Tasks Navigation -->
            <div class="js-tasks-nav d-none d-md-block">
                <!-- Tasks Info -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Tasks</h3>
                    </div>

                    <ul class="list-group push">
                        <li class="list-group-item">
                            <span class="js-task-badge badge badge-primary float-right animated bounceIn">@{{ activeTasks.length }}</span>
                            <i class="fa fa-fw fa-tasks mr-5"></i> Active
                        </li>
                        <li class="list-group-item">
                            <span class="js-task-badge-completed badge badge-success float-right animated bounceIn">@{{ completedTasks.length }}</span>
                            <i class="fa fa-fw fa-check mr-5"></i> Completed
                        </li>
                    </ul>
                </div>
                <!-- END Tasks Info -->

                <!-- Items -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Items</h3>
                    </div>

                    {{-- <div class="block-content">
                    <ul class="nav-users push" v-for="item in items">
                    <li>
                    <a href="#" target="_blank">
                    <img class="img-avatar" src="/img/avatars/avatar0.jpg" alt="">
                    <i class="fa fa-circle text-success"></i> @{{ item.name }}
                    <div class="font-w400 font-size-xs text-muted">
                    <i class="fa fa-mail"></i> @{{ item.email }}
                </div>
            </a>
        </li>
    </ul>
    <div>
    <div class="input-group">

    <div class="input-group-append">
    <router-view name="SearchBoxItem" :current_company="{{request()->route('profile')}}"> </router-view>
</div>
</div>
</div>
</div> --}}


</div>
<!-- END Items -->

<!-- Members -->
<div class="block block-rounded">
    <div class="block-header block-header-default">
        <h3 class="block-title">Members</h3>

    </div>

    <opportunity-member-form ref="member-form" inline-template>
        {{-- <div class="block-content"> --}}

        <b-field>
            <b-taginput v-model="$parent.members" :data="filteredProfiles"
            autocomplete field="name" icon="label" placeholder="Search for a Member"
            @typing="getProfiles" @add="addMember()">
            <template slot-scope="props">
                <strong>@{{props.option.id}}</strong>: @{{props.option.slug}}
            </template>
            <template slot="empty">
                There are no items
            </template>
        </b-taginput>
    </b-field>

    {{-- </div> --}}

</opportunity-member-form>
</div>
<!-- END Members -->
</div>
<!-- END Collapsible Tasks Navigation -->
</div>
<div class="col-md-7 col-xl-9">
    <!-- Tasks -->
    <!-- Tasks functionality (initialized in js/pages/be_pages_generic_todo.js) -->
    <div class="js-tasks">

        <!-- Add task -->
        <opportunity-task-form ref="task-form" inline-template>
            <section>
                <b-field expanded>
                    <b-dropdown v-model="activity_type">
                        <button class="button is-primary" type="button" slot="trigger">
                            <template v-if="activity_type == 1">
                                <b-icon icon="format-list-checks"></b-icon>
                                <span>Task</span>
                            </template>
                            <template v-else-if="activity_type == 2">
                                <b-icon icon="phone"></b-icon>
                                <span>Phone</span>
                            </template>
                            <template v-else-if="activity_type == 3">
                                <b-icon icon="video"></b-icon>
                                <span>Video Conf.</span>
                            </template>
                            <template v-else-if="activity_type == 4">
                                <b-icon icon="account-multiple"></b-icon>
                                <span>Meeting</span>
                            </template>
                            <template v-else-if="activity_type == 5">
                                <b-icon icon="map-marker-radius"></b-icon>
                                <span>Visit</span>
                            </template>
                            <template v-else>
                                <b-icon icon="email"></b-icon>
                                <span>Email</span>
                            </template>
                            <b-icon icon="menu-down"></b-icon>
                        </button>

                        <b-dropdown-item :value="1">
                            <div class="media">
                                <b-icon class="media-left" icon="format-list-checks"></b-icon>
                                <div class="media-content">
                                    <h4>Task</h4>
                                </div>
                            </div>
                        </b-dropdown-item>

                        <b-dropdown-item :value="2">
                            <div class="media">
                                <b-icon class="media-left" icon="phone"></b-icon>
                                <div class="media-content">
                                    <h4>Phone</h4>
                                </div>
                            </div>
                        </b-dropdown-item>

                        <b-dropdown-item :value="3">
                            <div class="media">
                                <b-icon class="media-left" icon="video"></b-icon>
                                <div class="media-content">
                                    <h4>Video Conference</h4>
                                </div>
                            </div>
                        </b-dropdown-item>

                        <b-dropdown-item :value="4">
                            <div class="media">
                                <b-icon class="media-left" icon="account-multiple"></b-icon>
                                <div class="media-content">
                                    <h4>Meeting</h4>
                                </div>
                            </div>
                        </b-dropdown-item>

                        <b-dropdown-item :value="5">
                            <div class="media">
                                <b-icon class="media-left" icon="map-marker-radius"></b-icon>
                                <div class="media-content">
                                    <h4>Visit</h4>
                                </div>
                            </div>
                        </b-dropdown-item>

                        <b-dropdown-item :value="6">
                            <div class="media">
                                <b-icon class="media-left" icon="email"></b-icon>
                                <div class="media-content">
                                    <h4>Email</h4>
                                </div>
                            </div>
                        </b-dropdown-item>
                    </b-dropdown>

                    <b-input v-model="title" placeholder="What needs to be done?" expanded></b-input>

                    <p class="control">
                        <button @click="addTask()" class="button is-info">Create Task</button>
                    </p>
                </b-field>

                <div class="block block-bordered" v-if="title != ''">
                    <div class="block-content">

                        <div class="row">
                            <div class="col-2">
                                <b-field label="Description" custom-class="is-small"></b-field>
                            </div>
                            <div class="col-10">
                                <b-field>
                                    <b-input v-model="description"
                                    placeholder="Write more detailed info on what the task entails."
                                    type="textarea"></b-input>
                                </b-field>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-2">
                                <b-field label="Start and End Dates" custom-class="is-small"></b-field>
                            </div>
                            <div class="col-10">
                                <b-field grouped>
                                    <b-field>
                                        <b-field expanded>
                                            <b-datepicker v-model="date_started"
                                            placeholder="Start Date"></b-datepicker>
                                        </b-field>
                                        <b-field expanded>
                                            <b-datepicker v-model="date_ended"
                                            :min-date="date_started"
                                            placeholder="End Date"></b-datepicker>
                                        </b-field>
                                    </b-field>
                                </b-field>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-2">
                                <b-field label="Set a Reminder?" custom-class="is-small"></b-field>
                            </div>
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-1">
                                        <b-switch v-model="remindMe"></b-switch>
                                    </div>
                                    <div class="col-4">
                                        <b-field v-if="remindMe == true" custom-class="is-small">
                                            <b-datepicker v-model="reminder_date"
                                            custom-class="is-small"
                                            :max-date="date_started"
                                            placeholder="Remind me on"></b-datepicker>
                                        </b-field>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-2">
                                <b-field label="Assign Task:" custom-class="is-small"></b-field>
                            </div>
                            <div class="col-10">
                                <div v-for="member in $parent.members">
                                    <b-radio v-model="assigned_to" :native-value="member.id">
                                        @{{ member.name }}
                                    </b-radio>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                        <button @click="addTask()" class="button is-info">Create Task</button>
                        <button @click="onReset()" class="btn btn-outline-secondary min-width-125">Cancel</button>
                    </div>
                </div>
            </section>
        </opportunity-task-form>

        <!-- END Add task -->
        <h2>This Week</h2>

        <b-table :data="activeTasks" hoverable detailed checkable detail-key="id">
            <template slot-scope="props">

                <b-table-column label="" width="40">
                    <template v-if="props.row.activity_type == 1">
                        <b-icon class="has-text-info" icon="format-list-checks"></b-icon>
                    </template>
                    <template v-else-if="props.row.activity_type == 2">
                        <b-icon class="has-text-info" icon="phone"></b-icon>
                    </template>
                    <template v-else-if="props.row.activity_type == 3">
                        <b-icon class="has-text-info" icon="video"></b-icon>
                    </template>
                    <template v-else-if="props.row.activity_type == 4">
                        <b-icon class="has-text-info" icon="account-multiple"></b-icon>
                    </template>
                    <template v-else-if="props.row.activity_type == 5">
                        <b-icon class="has-text-info" icon="map-marker-radius"></b-icon>
                    </template>
                    <template v-else>
                        <b-icon class="has-text-info" icon="email"></b-icon>
                    </template>
                </b-table-column>

                <b-table-column field="title" label="Task" sortable>
                    @{{ props.row.title }} <span class="has-text-grey-light">| @{{ props.row.description }}</span>
                </b-table-column>

                <b-table-column field="date" label="Date" sortable centered>
                    <span class="tag is-info">
                        @{{ new Date(props.row.date_started).toLocaleDateString() }}
                    </span>
                </b-table-column>

                <b-table-column label="Actions" centered>
                    <b-tooltip :label="props.row.reminder_date" dashed>
                        <i class="si si-bell"></i>
                    </b-tooltip>
                    <a class="delete" @click="deleteTask(props.row)"></a>
                </b-table-column>

            </template>
            <template slot="empty">
                <section class="section">
                    <div class="content has-text-grey has-text-centered">
                        <p>
                            <b-icon icon="emoticon-sad" size="is-large"> </b-icon>
                        </p>
                        <p>Nothing here.</p>
                    </div>
                </section>
            </template>
            <template slot="detail" slot-scope="props">
                <div class="row">
                    <div class="col-2">
                        <b-field label="Description" custom-class="is-small"></b-field>
                    </div>
                    <div class="col-10">
                        <b-field>
                            <b-input v-model="props.row.description" placeholder="Write more detailed info on what the task entails."
                            type="textarea"></b-input>
                        </b-field>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <b-field label="Start & End Dates" custom-class="is-small"></b-field>
                    </div>
                    <div class="col-10">
                        <b-field grouped>
                            <b-field expanded>
                                <b-datepicker v-model="props.row.date_started"
                                placeholder="Start Date"></b-datepicker>
                            </b-field>
                            <b-field expanded>
                                <b-datepicker v-model="props.row.date_ended"
                                :min-date="props.row.date_started"
                                placeholder="End Date"></b-datepicker>
                            </b-field>
                        </b-field>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <b-field label="Assign Task" custom-class="is-small"></b-field>
                    </div>
                    <div class="col-10">
                        <b-select placeholder="Assign someone">
                            <option v-for="member in members" :value="props.row.assigned_to" :key="member.id">
                                @{{ member.name }}
                            </option>
                        </b-select>
                    </div>
                </div>
                <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                    <button @click="taskEdit(prop.row)" class="button is-info">Save</button>
                    <button @click="onReset()" class="btn btn-outline-secondary min-width-125">Cancel</button>
                </div>
            </template>
        </b-table>

        <!-- Tasks List -->
        {{-- <h2 class="content-heading">Active</h2> --}}
        <h2>Active</h2>

        <div class="js-task-list">
            <!-- Task -->
            <div  class="js-task block block-rounded mb-5 animated fadeIn" data-task-id="9" data-task-completed="false" data-task-starred="false">

                <table class="table table-borderless table-vcenter mb-0">
                    <tbody>
                        <tr v-for="task in activeTasks">
                            <td class="text-center" style="width: 50px;">
                                <i class="si si-check" @click="taskChecked(task)"></i>
                                {{-- <label class="js-task-status css-control css-control-primary css-checkbox py-0">
                                <input type="checkbox" v-on:change="taskChecked(task)" class="css-control-input">
                                <span class="css-control-indicator"></span>
                            </label> --}}
                        </td>
                        <td>
                            <template v-if="task.activity_type == 1">
                                <b-icon icon="format-list-checks"></b-icon>
                            </template>
                            <template v-else-if="task.activity_type == 2">
                                <b-icon icon="phone"></b-icon>
                            </template>
                            <template v-else-if="task.activity_type == 3">
                                <b-icon icon="video"></b-icon>
                            </template>
                            <template v-else-if="task.activity_type == 4">
                                <b-icon icon="account-multiple"></b-icon>
                            </template>
                            <template v-else-if="task.activity_type == 5">
                                <b-icon icon="map-marker-radius"></b-icon>
                            </template>
                            <template v-else>
                                <b-icon icon="email"></b-icon>
                            </template>
                        </td>
                        <td class="js-task-content">
                            <span class="font-w600">@{{ task.title }}</span>
                            <small>@{{ task.description }}</small>
                        </td>
                        <td class="text-right">
                            <a href="#">
                                <i v-if="task.reminder_date != null" class="si si-bell"></i>
                            </a>
                            <button @click="deleteTask(task)" class="js-task-remove btn btn-sm btn-alt-danger" type="button">
                                <i class="si si-close"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- END Task -->
    </div>
    <!-- END Tasks List -->

    <!-- Tasks List Completed -->
    <h2 class="content-heading">Completed</h2>
    <div class="js-task-list-completed">
        <!-- Completed Task -->
        <div class="js-task block block-rounded mb-5 animated fadeIn" data-task-id="3" data-task-completed="true" data-task-starred="false">
            <table class="table table-borderless table-vcenter bg-body-light mb-0">
                <tbody>
                    <tr v-for="task in completedTasks">
                        <td class="text-center" style="width: 50px;">
                            <label class="js-task-status css-control css-control-primary css-checkbox py-0">
                                <input type="checkbox" v-on:change="taskChecked(task)" class="css-control-input" checked>
                                <span class="css-control-indicator"></span>
                            </label>
                        </td>
                        <td class="js-task-content">
                            <del>
                                <span class="font-w600">@{{ task.title }}</span>
                                <small>@{{ task.description }}</small>
                            </del>
                        </td>
                        <td class="text-right" style="width: 100px;">
                            <button @click="editTask(task)" class="js-task-star btn btn-sm btn-alt-info" type="button">
                                <i class="fa fa-eye"></i>
                            </button>
                            <button @click="deleteTask(task)" class="js-task-remove btn btn-sm btn-alt-danger" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- END Completed Task -->
    </div>
    <!-- END Tasks -->
</div>
</div>
<!-- END Tasks Content -->
</div>
</div>
