{{-- Task Model --}}

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
                    <div class="block-content">
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
                </div>
                <!-- END Tasks Info -->

                <!-- Items -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Items</h3>
                    </div>

                    <div class="block-content">
                        <ul class="nav-users push" v-for="item in items">
                            <li>
                                <a href="#" target="_blank">
                                    <img class="img-avatar" src="/img/avatars/avatar0.jpg" alt="">
                                    {{-- <img class="img-avatar" :src="member.profile_img" onerror="this.src='/img/avatars/avatar0.jpg';" alt=""> --}}
                                    <i class="fa fa-circle text-success"></i> @{{ item.name }}
                                    <div class="font-w400 font-size-xs text-muted">
                                        <i class="fa fa-mail"></i> @{{ item.email }}
                                    </div>
                                </a>
                            </li>
                        </ul>

                        {{-- <opportunity-member-form ref="member-form" inline-template> --}}
                        <div>
                            <div class="input-group">

                                <div class="input-group-append">
                                    <router-view name="SearchBoxItem"
                                    :current_company="{{request()->route('profile')}}" >

                                </router-view>
                            </div>
                        </div>
                    </div>
                    {{-- </opportunity-member-form> --}}

                </div>
            </div>
            <!-- END Items -->

            <!-- Members -->
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Members</h3>
                </div>

                <div class="block-content">
                    <ul class="nav-users push" v-for="member in members">
                        <li>
                            <a v-bind:href="member.slug" target="_blank">
                                <img class="img-avatar" :src="member.profile_img" alt="">
                                <i class="fa fa-circle text-success"></i> @{{ member.name }}
                                <div class="font-w400 font-size-xs text-muted">
                                    <i class="fa fa-mail"></i> @{{ member.email }}
                                </div>
                            </a>
                        </li>
                    </ul>

                    <opportunity-member-form ref="member-form" inline-template>
                        <div>
                            <div class="input-group">
                                <router-view name="SearchBoxProfile" :current_company="{{request()->route('profile')}}"> </router-view>
                            </div>
                        </div>
                    </opportunity-member-form>

                </div>
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
                <div>
                    <section>
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </section>
                </div>
            </opportunity-task-form>

            <!-- END Add task -->

            <!-- Tasks List -->
            <h2 class="content-heading mb-10">Active</h2>

            <div class="js-task-list">
                <!-- Task -->
                <div  class="js-task block block-rounded mb-5 animated fadeIn" data-task-id="9" data-task-completed="false" data-task-starred="false">
                    <table class="table table-borderless table-vcenter mb-0">
                        <tbody>
                            <tr v-for="task in activeTasks">
                                <td class="text-center" style="width: 50px;">
                                    <label class="js-task-status css-control css-control-primary css-checkbox py-0">
                                        <input type="checkbox" v-on:change="editTask(task)" class="css-control-input">
                                        <span class="css-control-indicator"></span>
                                    </label>
                                </td>
                                <td class="js-task-content">
                                    <span class="font-w600">@{{ task.title }}</span>
                                    <small>@{{ task.description }}</small>
                                </td>
                                <td class="text-right">
                                    <button v-if="task.reminder_date != null" @click="editTask(task)" class="btn btn-sm btn-circle btn-alt-warning mr-5 mb-5" type="button">
                                        <i class="si si-bell"></i>
                                    </button>
                                    <button @click="editTask(task)" class="js-task-star btn btn-sm btn-alt-info" type="button">
                                        <i class="si si-pencil"></i>
                                    </button>
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
            <h2 class="content-heading mb-10">Completed</h2>
            <div class="js-task-list-completed">
                <!-- Completed Task -->
                <div class="js-task block block-rounded mb-5 animated fadeIn" data-task-id="3" data-task-completed="true" data-task-starred="false">
                    <table class="table table-borderless table-vcenter bg-body-light mb-0">
                        <tbody>
                            <tr v-for="task in completedTasks">
                                <td class="text-center" style="width: 50px;">
                                    <label class="js-task-status css-control css-control-primary css-checkbox py-0">
                                        <input type="checkbox" class="css-control-input" checked="">
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
