<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Item</th>
            <th>Credit</th>
            <th>Debit</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="movement in list">
            <td>@{{ movement.date }}</td>
            <td>@{{ movement.account.name }}</td>
            <td>@{{ movement.credit }}</td>
            <td>@{{ movement.debit }}</td>
            <td class="text-center">
                <div class="btn-group">
                    <button v-on:click="onEdit(movement)" type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Edit">
                        <i class="fa fa-pencil"></i>
                    </button>
                    <button v-on:click="onDelete(movement)" type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Delete">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </td>
        </tr>
    </tbody>
</table>
@include('layouts/infinity-loading')
