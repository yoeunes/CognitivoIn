
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
            <tr v-for="supplier in list">
                <td>@{{ supplier.supplier_taxid }}</td>
                <td>@{{ supplier.supplier_alias }}</td>
                <td>@{{ supplier.supplier_email }}</td>
                <td class="text-center">
                    <div class="btn-group">
                        <button v-on:click="onEdit(supplier)" type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Edit">
                            <i class="fa fa-pencil"></i>
                        </button>
                        <button v-on:click="onDelete(supplier)" type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Delete">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    @include('layouts/infinity-loading')
</div>
