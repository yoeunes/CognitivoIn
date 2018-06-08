<div class="bg-image" style="background-image: url('/img/backgrounds/photo26@2x.jpg');">
    <div class="bg-black-op-75">
        <div class="content content-top content-full text-center">
            <div class="py-20">
                <h2 class="text-white">Sales | <b>Orders</b></h2>
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
            <order-form ref="back_officeForm" v-else :userid="{{ Auth::user()->profile_id }}" inline-template>
                <div>
                    <div v-if="$parent.showList === 2">
                        @include('back_office/sales/orders/show')
                    </div>
                    <div v-if="$parent.showList === false">
                        @include('back_office/sales/orders/form')
                    </div>
                </div>
            </order-form>
        </div>
    </div>
</div>
<!-- END Page Content -->
