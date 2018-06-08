<div class="bg-image" style="background-image: url('/img/backgrounds/photo26@2x.jpg');">
    <div class="bg-black-op-75">
        <div class="content content-top content-full text-center">
            <div class="py-20">
                <h1 class="text-white">Sales | <b>ORDERS</b></h1>
            </div>
        </div>
    </div>
</div>

<!-- Page Content -->
<div class="content">

    <div class="block block-fx-shadow">
        <div class="block-content">
            <div v-if="showList">
                @include('back_office/sales/orders/list')
            </div>
            <div v-else>
                @include('back_office/sales/orders/form')
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->
