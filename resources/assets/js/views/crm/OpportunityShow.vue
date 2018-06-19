<template>
  <div>
      <opportunity-form ref="back_officeForm" userid="user_id" inline-template>
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

                    <div class="block text-center" href="javascript:void(0)">
                        <div class="block-content block-content-full bg-gd-dusk">
                            <img class="img-avatar img-avatar-thumb" src="/img/avatars/avatar6.jpg" alt="">
                        </div>
                        <div v-if="relationship !== null" class="block-content block-content-full">
                            <div class="font-w600 mb-5">@{{ relationship.customer_alias }}</div>
                            <div class="font-size-sm text-muted">@{{ relationship.customer_taxid }}</div>
                        </div>
                        <div v-if="relationship != null && relationship.customer_email != null" class="block-content block-content-full block-content-sm bg-body-light">
                            <span class="font-w600 font-size-sm text-danger">@{{ relationship.customer_email }}</span>
                        </div>
                        <div class="block-content">
                            <div class="row items-push text-center">
                                <div class="col-6">
                                    <div class="item item-circle bg-success-light mx-auto mb-10">
                                        <i class="fa fa-money text-success"></i>
                                    </div>
                                    <div class="text-muted"><small>@{{ currency }}</small> @{{ totalValue }}</div>
                                </div>
                                <div class="col-6">
                                    <div class="item item-circle bg-info-light mx-auto mb-10">
                                        <i class="fa fa-diamond text-info"></i>
                                    </div>
                                    <div class="text-muted">@{{ items.length }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="block-footer">

                            <button v-if="status != 2" class="button is-warning" @click="onHold()" expanded>
                                <b-icon icon="clock"></b-icon>
                                <span>@lang('back-office.On Hold')</span>
                            </button>
                            <button v-else class="button is-warning" disabled expanded>
                                <b-icon icon="clock"></b-icon>
                                <span>@lang('back-office.On Hold')</span>
                            </button>

                            <button v-if="status != 3" class="button is-success" @click="onWon()" expanded>
                                <b-icon icon="approval"></b-icon>
                                <span>@lang('back-office.Won')</span>
                            </button>
                            <button v-else class="button is-success" expanded disabled>
                                <b-icon icon="approval"></b-icon>
                                <span>@lang('back-office.Won')</span>
                            </button>

                            <button v-if="status != 4" class="button is-danger" @click="onLost()" expanded>
                                <b-icon icon="cancel"></b-icon>
                                <span>@lang('back-office.Lost')</span>
                            </button>
                            <button v-else class="button is-danger" disabled expanded>
                                <b-icon icon="cancel"></b-icon>
                                <span>@lang('back-office.Lost')</span>
                            </button>

                            <hr>
                        </div>
                    </div>

                    <div class="js-tasks-nav d-none d-block">
                        <!-- Items -->
                        <div class="block block-rounded">
                            <opportunity-item-form ref="item-form" inline-template>
                                <div class="">
                                    <div class="block-header block-header-default">
                                        <b-field>
                                            <b-autocomplete v-model="selectname" :data="items" placeholder="Search for Products or Services" field="name" :loading="isFetching" @input="getItems" @select="option => addItem(option)">
                                                <template slot-scope="props">
                                                    @{{props.option.sku}} | <b>@{{props.option.name}}</b>
                                                </template>
                                                <template slot="empty">
                                                    There are no items
                                                </template>
                                            </b-autocomplete>
                                        </b-field>
                                    </div>
                                    <div class="block-content">
                                        <div  class="js-task block block-rounded mb-5 animated fadeIn" data-task-id="9" data-task-completed="false" data-task-starred="false">
                                            <table class="table table-borderless table-vcenter">
                                                <tbody v-for="cart in $parent.items">
                                                    <tr>
                                                        <td colspan="2">
                                                            <small>@{{ cart.sku }}</small> |
                                                            <span class="font-w600">@{{ cart.name }}</span>
                                                        </td>
                                                        <td class="text-right">
                                                            <a @click="deleteItem(cart)" class="is-danger" href="#" >
                                                                <i class="si si-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            <span class="font-w600">
                                                                <a @click="removeQuantity(cart)">
                                                                    <i class="si si-minus is-warning"></i>
                                                                </a>
                                                                @{{ cart.quantity }}
                                                                <a @click="addQuantity(cart)">
                                                                    <i class="si si-plus is-success"></i>
                                                                </a>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span class="font-w600">
                                                                @{{ Number(cart.unit_price * cart.quantity).toLocaleString() }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </opportunity-item-form>

                        </div>
                        <!-- END Items -->

                        <!-- Members -->
                        <opportunity-member-form ref="member-form" inline-template>
                            <div class="block block-rounded">
                                <div class="block-header block-header-default">
                                    <b-field>
                                        <b-autocomplete v-model="selectname" :data="profiles" placeholder="Search Members" field="name" :loading="isFetching" @input="getProfiles" @select="option => addMember(option)">
                                            <template slot-scope="props">
                                                <strong>@{{props.option.name}}</strong> | @{{props.option.slug}}
                                            </template>
                                            <template slot="empty">
                                                There are no items
                                            </template>
                                        </b-autocomplete>
                                    </b-field>
                                </div>
                                <div class="block-content">
                                    <div  class="js-task block block-rounded mb-5 animated fadeIn" data-task-id="9" data-task-completed="false" data-task-starred="false">
                                        <table class="table table-borderless table-vcenter mb-0">
                                            <tbody>
                                                <tr v-for="member in $parent.members">
                                                    <td class="js-task-content">
                                                        <span class="font-w600">@{{ member.name }}</span>
                                                        <small>@{{ member.taxid }}</small>
                                                    </td>
                                                    <td class="text-right">
                                                        <button @click="deleteMember(member)" class="js-task-remove btn btn-sm btn-alt-danger" type="button">
                                                            <i class="si si-close"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </opportunity-member-form>
                        <!-- END Members -->
                    </div>
                    <!-- END Collapsible Tasks Navigation -->
                </div>
                <div class="col-md-7 col-xl-9">
                    <!-- Tasks -->
                    <div class="js-tasks">
                        <!-- Add task -->
                        <opportunity-task-form ref="task-form" inline-template>
                            <section>
                                <b-field expanded>
                                    <b-dropdown v-model="activity_type">
                                        <button class="button is-primary" type="button" slot="trigger">
                                            <template v-if="activity_type == 1">
                                                <b-icon icon="format-list-checks"></b-icon>
                                                <span>@lang('back-office.Task')</span>
                                            </template>
                                            <template v-else-if="activity_type == 2">
                                                <b-icon icon="phone"></b-icon>
                                                <span>@lang('global.Telephone')</span>
                                            </template>
                                            <template v-else-if="activity_type == 3">
                                                <b-icon icon="video"></b-icon>
                                                <span>@lang('global.Video Conference')</span>
                                            </template>
                                            <template v-else-if="activity_type == 4">
                                                <b-icon icon="account-multiple"></b-icon>
                                                <span>@lang('global.Meeting')</span>
                                            </template>
                                            <template v-else-if="activity_type == 5">
                                                <b-icon icon="map-marker-radius"></b-icon>
                                                <span>@lang('global.Visit')</span>
                                            </template>
                                            <template v-else>
                                                <b-icon icon="email"></b-icon>
                                                <span>@lang('global.Email')</span>
                                            </template>
                                            <b-icon icon="menu-down"></b-icon>
                                        </button>

                                        <b-dropdown-item :value="1">
                                            <div class="media">
                                                <b-icon class="media-left" icon="format-list-checks"></b-icon>
                                                <div class="media-content">
                                                    @lang('back-office.Task')
                                                </div>
                                            </div>
                                        </b-dropdown-item>

                                        <b-dropdown-item :value="2">
                                            <div class="media">
                                                <b-icon class="media-left" icon="phone"></b-icon>
                                                <div class="media-content">
                                                    @lang('global.Telephone')
                                                </div>
                                            </div>
                                        </b-dropdown-item>

                                        <b-dropdown-item :value="3">
                                            <div class="media">
                                                <b-icon class="media-left" icon="video"></b-icon>
                                                <div class="media-content">
                                                    @lang('global.Video Conference')
                                                </div>
                                            </div>
                                        </b-dropdown-item>

                                        <b-dropdown-item :value="4">
                                            <div class="media">
                                                <b-icon class="media-left" icon="account-multiple"></b-icon>
                                                <div class="media-content">
                                                    @lang('global.Meeting')
                                                </div>
                                            </div>
                                        </b-dropdown-item>

                                        <b-dropdown-item :value="5">
                                            <div class="media">
                                                <b-icon class="media-left" icon="map-marker-radius"></b-icon>
                                                <div class="media-content">
                                                    @lang('global.Visit')
                                                </div>
                                            </div>
                                        </b-dropdown-item>

                                        <b-dropdown-item :value="6">
                                            <div class="media">
                                                <b-icon class="media-left" icon="email"></b-icon>
                                                <div class="media-content">
                                                    @lang('global.Email')
                                                </div>
                                            </div>
                                        </b-dropdown-item>
                                    </b-dropdown>

                                    <b-input v-model="title" placeholder="What needs to be done?" expanded></b-input>

                                    <p class="control">
                                        <button @click="addTask()" class="button is-info">@lang('global.New Model', ['model' => __('back-office.Task')])</button>
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
                                                            <b-datepicker v-model="date_reminder"
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
                                        <button @click="onReset()" class="btn btn-outline-secondary min-width-125">@lang('global.Cancel')</button>
                                    </div>
                                </div>
                            </section>
                        </opportunity-task-form>

                        <b-tabs type="is-boxed">
                            <b-tab-item label="Tasks" icon="format-list-checks">

                                <!-- END Add task -->
                                <div v-if="myTasks.length > 0">
                                    <h2>My Tasks</h2>

                                    <b-table :data="myTasks" hoverable detailed detail-key="id">
                                        <template slot-scope="props">
                                            <b-table-column width="40">
                                                {{-- <b-icon icon="checkbox-marked" v-if="props.row.completed" @click="taskChecked(props.row)"></b-icon>
                                                <b-icon icon="checkbox-blank-outline" v-else ></b-icon> --}}
                                                <i class="fa fa-check-square text-info" v-if="props.row.completed" @click="taskChecked(props.row)"></i>
                                                <i class="fa fa-square-o" v-else @click="taskChecked(props.row)"></i>
                                            </b-table-column>

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

                                            <b-table-column field="date" sortable centered width="30">
                                                <b-field v-if="props.row.completed" grouped>
                                                    <a @click="sentimentTask(props.row, 2)">
                                                        <img v-if="props.row.sentiment == 2" src="/img/icons/emojiHappy.svg" width="32" alt="">
                                                        <img v-else src="/img/icons/emojiHappy.svg" style="opacity: 0.32" width="20" alt="">
                                                    </a>
                                                    <a @click="sentimentTask(props.row, 1)">
                                                        <img v-if="props.row.sentiment == 1" src="/img/icons/emojiOk.svg" width="32" alt="">
                                                        <img v-else src="/img/icons/emojiOk.svg" style="opacity: 0.32" width="20" alt="">
                                                    </a>
                                                    <a @click="sentimentTask(props.row, 0)">
                                                        <img v-if="props.row.sentiment == 0" src="/img/icons/emojiSad.svg" width="32" alt="">
                                                        <img v-else src="/img/icons/emojiSad.svg" style="opacity: 0.32" width="20" alt="">
                                                    </a>
                                                </b-field>
                                                <span v-else class="tag is-light">
                                                    @{{ new Date(props.row.date_started).toLocaleDateString() }}
                                                </span>
                                            </b-table-column>

                                            <b-table-column field="title" label="@lang('back-office.Task')" sortable expanded>
                                                @{{ props.row.title }} <span class="has-text-grey-light">| @{{ props.row.description }}</span>
                                            </b-table-column>

                                            <b-table-column label="@lang('global.Actions')" numeric>
                                                <b-field grouped>
                                                    <b-tooltip :label="props.row.date_reminder" dashed>
                                                        <i class="si si-bell"></i>
                                                    </b-tooltip>
                                                    <a class="delete" @click="deleteTask(props.row)"></a>
                                                </b-field>
                                            </b-table-column>
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
                                                            placeholder="@lang('global.Start Date')"></b-datepicker>
                                                        </b-field>
                                                        <b-field expanded>
                                                            <b-datepicker v-model="props.row.date_ended"
                                                            :min-date="props.row.date_started"
                                                            placeholder="@lang('global.End Date')"></b-datepicker>
                                                        </b-field>
                                                    </b-field>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-2">
                                                    <b-field label="Assign Task" custom-class="is-small"></b-field>
                                                </div>
                                                <div class="col-10">
                                                    <b-select placeholder="Assign someone"  v-model="props.row.assigned_to">
                                                        <option v-for="member in members" :value="member.id" >
                                                            @{{ member.name }}
                                                        </option>
                                                    </b-select>
                                                </div>
                                            </div>
                                            <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                                                <button @click="editTask(props.row)" class="button is-info">
                                                    @lang('global.Save')
                                                </button>
                                                <button @click="" class="btn btn-outline-secondary min-width-125">
                                                    @lang('global.Cancel')
                                                </button>
                                            </div>
                                        </template>
                                    </b-table>
                                </div>

                                <div v-if="otherTasks.length > 0">
                                    <hr>

                                    <h2>Other Tasks</h2>

                                    <b-table :data="otherTasks"  hoverable detailed detail-key="id">
                                        <template slot-scope="props">
                                            <b-table-column width="40">
                                                {{-- <b-icon icon="checkbox-marked" v-if="props.row.completed" @click="taskChecked(props.row)"></b-icon>
                                                <b-icon icon="checkbox-blank-outline" v-else ></b-icon> --}}
                                                <i class="fa fa-check-square text-info" v-if="props.row.completed" @click="taskChecked(props.row)"></i>
                                                <i class="fa fa-square-o" v-else @click="taskChecked(props.row)"></i>
                                            </b-table-column>

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

                                            <b-table-column field="date" label="@lang('global.Deadline')" sortable centered width="30">
                                                <span class="tag is-light">
                                                    @{{ new Date(props.row.date_started).toLocaleDateString() }}
                                                </span>
                                            </b-table-column>

                                            <b-table-column field="title" label="@lang('back-office.Task')" sortable>
                                                @{{ props.row.title }} <span class="has-text-grey-light">| @{{ props.row.description }}</span>
                                            </b-table-column>

                                            <b-table-column label="@lang('global.Actions')" numeric>
                                                <b-field v-if="props.row.completed" grouped>
                                                    <a @click="sentimentTask(props.row, 2)">
                                                        <img v-if="props.row.sentiment == 2" src="/img/icons/emojiHappy.svg" width="32" alt="">
                                                        <img v-else src="/img/icons/emojiHappy.svg" style="opacity: 0.32" width="20" alt="">
                                                    </a>
                                                    <a @click="sentimentTask(props.row, 1)">
                                                        <img v-if="props.row.sentiment == 1" src="/img/icons/emojiOk.svg" width="32" alt="">
                                                        <img v-else src="/img/icons/emojiOk.svg" style="opacity: 0.32" width="20" alt="">
                                                    </a>
                                                    <a @click="sentimentTask(props.row, 0)">
                                                        <img v-if="props.row.sentiment == 0" src="/img/icons/emojiSad.svg" width="32" alt="">
                                                        <img v-else src="/img/icons/emojiSad.svg" style="opacity: 0.32" width="20" alt="">
                                                    </a>
                                                </b-field>
                                                <b-field v-else grouped>
                                                    <b-tooltip :label="props.row.date_reminder" dashed>
                                                        <i class="si si-bell"></i>
                                                    </b-tooltip>
                                                    <a class="delete" @click="deleteTask(props.row)"></a>
                                                </b-field>
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
                                                            placeholder="@lang('global.Start Date')"></b-datepicker>
                                                        </b-field>
                                                        <b-field expanded>
                                                            <b-datepicker v-model="props.row.date_ended"
                                                            :min-date="props.row.date_started"
                                                            placeholder="@lang('global.End Date')"></b-datepicker>
                                                        </b-field>
                                                    </b-field>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-2">
                                                    <b-field label="Assign Task" custom-class="is-small"></b-field>
                                                </div>
                                                <div class="col-10">
                                                    <b-select placeholder="Assign someone"  v-model="props.row.assigned_to">
                                                        <option v-for="member in members" :value="member.id" >
                                                            @{{ member.name }}
                                                        </option>
                                                    </b-select>
                                                </div>
                                            </div>
                                            <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                                                <button @click="editTask(props.row)" class="button is-info">
                                                    @lang('global.Save')
                                                </button>
                                                <button @click="" class="btn btn-outline-secondary min-width-125">
                                                    @lang('global.Cancel')
                                                </button>
                                            </div>
                                        </template>
                                    </b-table>
                                </div>
                                <!-- END Tasks -->
                            </b-tab-item>

                            <b-tab-item label="Products and Services" icon="diamond">
                                <b-table :data="items" hoverable detailed detail-key="id">
                                    <template slot-scope="props">
                                        <b-table-column field="quantity" label="@lang('global.Quantity')" sortable width="64">
                                            <b-field>
                                                <b-input placeholder="" v-model="props.row.quantity" type="number" min="1"></b-input>
                                            </b-field>
                                        </b-table-column>

                                        <b-table-column field="items" label="@lang('back-office.Products and Services')" sortable>
                                            @{{ props.row.name }} <span class="has-text-grey-light">| @{{ props.row.sku }}</span>
                                        </b-table-column>

                                        <b-table-column field="unit_price" label="@lang('global.Price')" width="128" sortable>
                                            <b-field>
                                                <b-input placeholder="" v-model="props.row.unit_price" type="number" min="0"></b-input>
                                            </b-field>
                                        </b-table-column>

                                        <b-table-column field="sub_total" label="@lang('global.Sub Total')" sortable numeric>
                                            @{{ Number(props.row.unit_price * props.row.quantity).toLocaleString() }}
                                        </b-table-column>

                                        <b-table-column label="@lang('global.Actions')" centered width="24">
                                            <a class="delete" @click="deleteItem(props.row)"></a>
                                        </b-table-column>
                                    </template>
                                    <template slot="footer">
                                        <h3> @{{ totalValue }} </h3>
                                        <button class="button is-info">Send Budget</button>
                                    </template>
                                    <template slot="detail" slot-scope="props">
                                        <div class="row">
                                            <div class="col-2">
                                                <b-field label="Description" custom-class="is-small"></b-field>
                                            </div>
                                            <div class="col-10">
                                                <b-field>
                                                    <b-input v-model="props.row.description" placeholder="Write more detailed info on what the task entails." type="textarea"></b-input>
                                                </b-field>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2">
                                                <b-field label="Assign Task" custom-class="is-small"></b-field>
                                            </div>
                                            <div class="col-10">
                                                <b-select placeholder="Assign someone"  v-model="props.row.assigned_to">
                                                    <option v-for="member in members" :value="member.id" >
                                                        @{{ member.name }}
                                                    </option>
                                                </b-select>
                                            </div>
                                        </div>
                                        <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                                            <button @click="editTask(props.row)" class="button is-info">
                                                @lang('global.Save')
                                            </button>
                                            <button @click="" class="btn btn-outline-secondary min-width-125">
                                                @lang('global.Cancel')
                                            </button>
                                        </div>
                                    </template>
                                </b-table>
                            </b-tab-item>
                        </b-tabs>
                    </div>
                </div>
                <!-- END Tasks Content -->
            </div>
        </div>

    </opportunity-form>
  </div>
</template>

<script>


export default {
  data() {
    return {
      profile:'',
      user_id:''


    };
  },



  methods: {

    onSave($data)
    {
      var app = this;
      axios.post('/api/' + app.profile + '/back-office/opportunities', $data)
      .then(() =>
      {
        this.$toast.open({
          message: 'Awsome! Your work has been saved',
          type: 'is-success'
        })

        this.$router.push({ name: "opportunity.index", params: { userid:app.user_id } });
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
    onCancel()
    {
      console.log(this)
        this.$router.push({ name: "opportunity.index", params: { userid:app.user_id } });
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
            console.log(ex.response);
            this.$toast.open({
                duration: 5000,
                message: 'Error trying to perform action',
                type: 'is-danger'
            })
        });

        return resp;
    },


  },
  mounted: function mounted()
  {

    var app = this;
    app.profile=this.$route.params.profile;
    app.user_id=this.$route.params.user_id;
    app.id=this.$route.params.id;
    if (app.id>0) {


      axios.get('/api/' + app.profile + '/back-office/opportunities/' + app.id )
      .then(function (response) {
        console.log(app);
        app.$children[0].onShow(response.data)
      })
      .catch(ex => {
        console.log(ex);

        app.$toast.open({
          duration: 5000,
          message: 'Error trying to edit this record',
          type: 'is-danger'
        })
      });
    }

  }

}
</script>
