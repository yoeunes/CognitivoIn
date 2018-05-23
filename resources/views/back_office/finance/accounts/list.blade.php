
<div class="block-content">
    <table>
        <thead>
            <tr>
                <th>TaxID</th>
                <th>Customer</th>
                <th>Email</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="customer in list">
                <td>@{{ customer.customer_taxid }}</td>
                <td>@{{ customer.customer_alias }}</td>
                <td>@{{ customer.email }}</td>
                <td class="text-center">
                    <div class="btn-group">
                        <button v-on:click="onEdit(customer)" type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Edit">
                            <i class="fa fa-pencil"></i>
                        </button>
                        <button v-on:click="onDelete(customer)" type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Delete">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    @include('layouts/infinity-loading')
</div>
