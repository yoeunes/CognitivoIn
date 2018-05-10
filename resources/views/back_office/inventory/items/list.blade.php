<!-- Products Table -->
<div class="block block-rounded">
    <div class="block-content">
        <infinity-item  baseurl="back-office/list-items"  profile="{{ request()->route('profile')->slug }}" inline-template>
            <div>
                <table class="table table-borderless table-striped">
                    <thead>
                        <tr>
                            <th style="width: 100px;">ID</th>
                            <th class="d-none d-sm-table-cell">SKU</th>
                            <th>Name</th>
                            <th class="d-none d-md-table-cell">Price</th>
                            <th class="text-right">Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <div class="">
                            <tr v-for="item in list">
                                <td>
                                    <a class="font-w600" href="be_pages_ecom_product_edit.html">PID.424</a>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    @{{ item.sku }}
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    @{{ item.name }}
                                </td>
                                <td>
                                    @{{ item.unit_price }}
                                </td>
                                <td class="text-right">
                                    <a @click="onEdit(item.id)" class="m-btn btn btn-secondary"><i class="la la-pencil m--font-brand"></i></a>
                                    <a @click="onDelete(item)" class="m-btn btn btn-secondary"><i class="la la-trash m--font-danger"></i></a>
                                    <a @click="onAnull(item)" class="m-btn btn btn-secondary"><i class="la la-close m--font-danger"></i></a>
                                </td>
                            </tr>
                        </div>
                    </tbody>
                </table>
                @include('layouts/infinity-loading')
            </div>
        </infinity-item>
    </div>
</div>
<!-- END Products Table -->
