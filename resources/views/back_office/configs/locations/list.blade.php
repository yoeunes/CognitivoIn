<div>
    <!-- Products Table -->
    <div class="block block-rounded">
        <div class="block-content">
            <table class="table table-borderless table-striped">
                <thead>
                    <tr>
                        <th>
                            #
                        </th>
                        <th class="d-none d-sm-table-cell">
                            @lang('global.Name')
                        </th>
                        <th>
                            @lang('global.City')
                        </th>
                        <th class="d-none d-md-table-cell">
                            @lang('global.State')
                        </th>
                        <th class="text-right">
                            @lang('global.Actions')
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <div class="">
                        <tr v-for="location in list">
                            <td>
                                @{{ location.id }}
                            </td>
                            <td class="d-none d-sm-table-cell">
                                <a class="font-w600" href="#" @click="onEdit(location)">@{{ location.name }}</a>
                            </td>
                            <td>
                                @{{ location.city }}
                            </td>
                            <td>
                                @{{ location.state }}
                            </td>
                            <td class="text-right">
                                <div class="btn-group">
                                    <button v-on:click="onEdit(location)" type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    <button v-on:click="onDelete(location)" type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Delete">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </div>
                </tbody>
            </table>
            @include('layouts/infinity-loading')
        </div>
    </div>
</div>
<!-- END Products Table -->
