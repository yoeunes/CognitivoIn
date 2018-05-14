
<div class="col-sm-6 col-md-3">
    <a class="block block-link-hover3 text-center" @click="onCreate()">
        <div class="block-content block-content-full">
            <div class="h1 font-w700 text-success"><i class="fa fa-plus"></i></div>
        </div>
        <div class="block-content block-content-full block-content-mini bg-gray-lighter text-success font-w600">Add New Order</div>
    </a>
</div>

{{-- <infinity-order profile="{{ request()->route('profile')->slug }}" baseurl="back-office/list-orders"  inline-template> --}}
    <div>
        <div v-if="showList">
            @include('back_office/sales/orders/list')
        </div>
        <div v-else>
            @include('back_office/sales/orders/form')
        </div>
    </div>
{{-- </infinity-order> --}}
