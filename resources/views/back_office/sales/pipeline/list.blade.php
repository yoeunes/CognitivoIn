<div class="content">
    <div class="block block-fx-shadow">
        <div class="block-content">
            <table>
                <thead>
                    <tr>
                        <td>#</td>
                        <th>Pipeline Name</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="pipeline in list">
                        <td>@{{ pipeline.id }}</td>
                        <td>@{{ pipeline.name }}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button v-on:click="onEdit(pipeline)" type="button" class="btn btn-sm btn-info js-tooltip-enabled" data-toggle="tooltip" data-original-title="Edit">
                                    <i class="fa fa-pencil"></i>
                                </button>
                                <button v-on:click="onDelete(pipeline)" type="button" class="btn btn-sm btn-danger js-tooltip-enabled" data-toggle="tooltip" data-original-title="Delete">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            @include('layouts/infinity-loading')
        </div>
    </div>
</div>
