<table class="table table-borderless table-striped">
    <thead>
        <tr>
            <th style="width: 100px;">ID</th>
            <th class="d-none d-sm-table-cell">@lang('global.Name')</th>

        </tr>
    </thead>
    <tbody>
        <div class="">
            <tr v-for="vat in list">
                <td>
                    <a class="font-w600" href="be_pages_ecom_product_edit.html">@{{ vat.id }}</a>
                </td>
                <td class="d-none d-sm-table-cell">
                    @{{ vat.name }}
                </td>

                <td class="text-right">
                    <a @click="onEdit(vat,false)" class="m-btn btn btn-secondary"><i class="la la-pencil m--font-brand"></i></a>
                    <a @click="onDelete(vat)" class="m-btn btn btn-secondary"><i class="la la-trash m--font-danger"></i></a>
                </td>
            </tr>
        </div>
    </tbody>
</table>
@include('layouts/infinity-loading')
