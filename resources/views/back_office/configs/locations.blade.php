
<div class="col-sm-6 col-md-3">
    <a class="block block-link-hover3 text-center" @click="onCreate()">
        <div class="block-content block-content-full">
            <div class="h1 font-w700 text-success"><i class="fa fa-plus"></i></div>
        </div>
        <div class="block-content block-content-full block-content-mini bg-gray-lighter text-success font-w600">Add New Location</div>
    </a>
</div>

{{-- <infinity-customer baseurl="back-office/list-customers" profile="{{ request()->route('profile')->slug }}" inline-template> --}}
    <div>
        <div v-if="showList">
            @include('back_office/configs/locations/list')
        </div>
        <div v-else>
            @include('back_office/configs/locations/form')
        </div>
    </div>
{{-- </infinity-customer> --}}
