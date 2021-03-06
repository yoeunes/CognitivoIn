<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Customer</th>
            <th>Number</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="invoice in list">
            <td>@{{ invoice.date }}</td>
            <td>@{{ invoice.relationship != null ? invoice.relationship.customer_alias : 'N/A' }}</td>
            <td>@{{ invoice.number }}</td>
            <td class="text-center">
                <div class="btn-group">
                    <button v-on:click="onShow(invoice)" type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Show">
                        <i class="fa fa-eye"></i>
                    </button>
                    <button v-on:click="onEdit(invoice)" type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Edit">
                        <i class="fa fa-pencil"></i>
                    </button>
                    <button v-on:click="onDelete(invoice)" type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Delete">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </td>
        </tr>
    </tbody>
</table>

@include('layouts/infinity-loading')
