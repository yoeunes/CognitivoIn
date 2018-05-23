
<!-- Page Content -->
<div class="content">

    <!-- Overview -->
    <h2 class="content-heading">Sales | <b>Customers</b></h2>
    <div class="row gutters-tiny">

        <!-- Add Product -->
        <div class="col-md-6 col-xl-3">
            <div class="block block-rounded block-link-shadow">
                <div class="block-content block-content-full block-sticky-options">
                    <div class="py-20 text-center">
                        <div class="font-size-h2 font-w700 mb-0 text-success">
                            <img src="/img/logo/cognitivo-64.svg" width="46">
                        </div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Customers</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <a class="block block-rounded block-link-shadow" @click="onCreate()" href="#" v-if="showList">
                <div class="block-content block-content-full block-sticky-options">
                    <div class="block-options">
                        <div class="block-options-item">
                            <i class="fa fa-archive fa-2x text-success-light"></i>
                        </div>
                    </div>
                    <div class="py-20 text-center">
                        <div class="font-size-h2 font-w700 mb-0 text-success">
                            <i class="fa fa-plus"></i>
                        </div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Create new Customer</div>
                    </div>
                </div>
            </a>
        </div>
        <!-- END Add Product -->
    </div>
    <!-- END Overview -->

    <div class="block block-fx-shadow">
        <div class="block-content">
            <div v-if="showList">
                @include('back_office/sales/customers/list')
            </div>
            <div v-else>
                @include('back_office/sales/customers/form')
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->
