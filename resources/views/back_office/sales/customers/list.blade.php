
<!-- Products Table -->
<div class="block block-rounded">
    <div class="block-content">
        {{-- <infinity-item  baseurl="back-office/list-items"  profile="{{ request()->route('profile')->slug }}" inline-template> --}}
        <div>
            <table class="table table-borderless table-striped">
                <thead>
                    <tr>
                        <th style="width: 100px;">ID</th>
                        <th class="d-none d-sm-table-cell">@lang('global.Gov Code')</th>
                        <th>@lang('global.Name')</th>
                        <th class="d-none d-md-table-cell">@lang('global.Email')</th>
                        <th class="text-right">@lang('global.Actions')</th>
                    </tr>
                </thead>
                <tbody>
                    <div class="">
                        <tr v-for="relationship in list">
                            <td>
                                <a class="font-w600" href="be_pages_ecom_product_edit.html">@{{ relationship.id }}</a>
                            </td>
                            <td class="d-none d-sm-table-cell">
                                @{{ relationship.customer_taxid }}
                            </td>
                            <td class="d-none d-sm-table-cell">
                                @{{ relationship.customer_name }}
                            </td>
                            <td>
                                @{{ relationship.customer_email }}
                            </td>
                            <td class="text-right">
                                <a @click="onEdit(relationship,false)" class="m-btn btn btn-secondary"><i class="la la-pencil m--font-brand"></i></a>
                                <a @click="onDelete(relationship)" class="m-btn btn btn-secondary"><i class="la la-trash m--font-danger"></i></a>
                            </td>
                        </tr>
                    </div>
                </tbody>
            </table>
            @include('layouts/infinity-loading')
        </div>
        {{-- </infinity-item> --}}
    </div>
</div>
<!-- END Products Table -->




<div class="block-content">
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
                <td>@{{ invoice.relationship.customer_alias }}</td>
                <td>@{{ invoice.number }}</td>
                <td class="text-center">
                    <div class="btn-group">
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
</div>
