<div class="block block-fx-shadow">
    <div class="block-content">
        <table>
            <thead>
                <tr>
                    <td>#</td>
                    <th>Opportunity Name</th>
                    <th>Customer</th>
                    <th>Value</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="opportunity in list">
                    <td>@{{ opportunity.id }}</td>
                    <td><a @click="onShow(opportunity)" href="#">@{{ opportunity.name }}</a></td>
                    <td>@{{ opportunity.relationship.customer_alias }}</td>
                    <td>@{{ opportunity.value }}</td>
                    <td class="text-center">
                        <div class="btn-group">
                            <button v-on:click="onShow(opportunity)" type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Show">
                                <i class="fa fa-eye"></i>
                            </button>
                            <button v-on:click="onEdit(opportunity)" type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Edit">
                                <i class="fa fa-pencil"></i>
                            </button>
                            <button v-on:click="onDelete(opportunity)" type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Delete">
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
