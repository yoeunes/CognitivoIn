
<div class="col-sm-6 col-md-3">
    <a class="block block-link-hover3 text-center" @click="onCreate()">
        <div class="block-content block-content-full">
            <div class="h1 font-w700 text-success">
                <i class="fa fa-plus"></i>
            </div>
        </div>
        <div class="block-content block-content-full block-content-mini bg-gray-lighter text-success font-w600">Add New Pipeline</div>
    </a>
</div>

<div>
    <div v-if="showList">
        @include('back_office/sales/pipeline/list')
    </div>
    <div v-else>
        @include('back_office/sales/pipeline/form')
    </div>
</div>
