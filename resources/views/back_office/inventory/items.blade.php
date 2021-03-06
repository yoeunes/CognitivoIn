
<!-- Page Content -->
<div class="content">

    <!-- Overview -->
    <h2 class="content-heading"><b>Products & Services</b> | Statistics</h2>
    <div class="row gutters-tiny">
        <!-- All Products -->
        <div class="col-md-6 col-xl-3">
            <a class="block block-rounded block-link-shadow" href="javascript:void(0)">
                <div class="block-content block-content-full block-sticky-options">
                    <div class="block-options">
                        <div class="block-options-item">
                            <i class="fa fa-circle-o fa-2x text-info-light"></i>
                        </div>
                    </div>
                    <div class="py-20 text-center">
                        <div class="font-size-h2 font-w700 mb-0 text-info js-count-to-enabled" data-toggle="countTo" data-to="3580">3580</div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">All Products</div>
                    </div>
                </div>
            </a>
        </div>
        <!-- END All Products -->

        <!-- Top Sellers -->
        <div class="col-md-6 col-xl-3">
            <a class="block block-rounded block-link-shadow" href="javascript:void(0)">
                <div class="block-content block-content-full block-sticky-options">
                    <div class="block-options">
                        <div class="block-options-item">
                            <i class="fa fa-star fa-2x text-warning-light"></i>
                        </div>
                    </div>
                    <div class="py-20 text-center">
                        <div class="font-size-h2 font-w700 mb-0 text-warning js-count-to-enabled" data-toggle="countTo" data-to="95">95</div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Top Sellers</div>
                    </div>
                </div>
            </a>
        </div>
        <!-- END Top Sellers -->

        <!-- Out of Stock -->
        <div class="col-md-6 col-xl-3">
            <a class="block block-rounded block-link-shadow" href="javascript:void(0)">
                <div class="block-content block-content-full block-sticky-options">
                    <div class="block-options">
                        <div class="block-options-item">
                            <i class="fa fa-warning fa-2x text-danger-light"></i>
                        </div>
                    </div>
                    <div class="py-20 text-center">
                        <div class="font-size-h2 font-w700 mb-0 text-danger js-count-to-enabled" data-toggle="countTo" data-to="30">30</div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Out of Stock</div>
                    </div>
                </div>
            </a>
        </div>
        <!-- END Out of Stock -->

        <!-- Add Product -->
        <div class="col-md-6 col-xl-3">
            <a class="block block-rounded block-link-shadow" @click="onCreate()" href="#">
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
                        <div class="font-size-sm font-w600 text-uppercase text-muted">New Product</div>
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
                @include('back_office/inventory/items/list')
            </div>
            <div v-else>
                @include('back_office/inventory/items/form')
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->
