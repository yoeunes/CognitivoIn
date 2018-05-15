<div>
<!-- Products Table -->
<div class="block block-rounded">
    <div class="block-content">
        {{-- <infinity-item  baseurl="back-office/list-items"  profile="{{ request()->route('profile')->slug }}" inline-template> --}}
        <div>
            <table class="table table-borderless table-striped">
                <thead>
                    <tr>
                        <th style="width: 100px;">ID</th>
                        <th class="d-none d-sm-table-cell">@lang('global.Name')</th>

                    </tr>
                </thead>
                <tbody>
                    <div class="">
                        <tr v-for="contract in list">
                            <td>
                                <a class="font-w600" href="be_pages_ecom_product_edit.html">@{{ contract.id }}</a>
                            </td>
                            <td class="d-none d-sm-table-cell">
                                @{{ contract.name }}
                            </td>

                            <td class="text-right">
                                <a @click="onEdit(contract,false)" class="m-btn btn btn-secondary"><i class="la la-pencil m--font-brand"></i></a>
                                <a @click="onDelete(contract)" class="m-btn btn btn-secondary"><i class="la la-trash m--font-danger"></i></a>
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
</div>
<!-- END Products Table -->
