
<div class="col-sm-6 col-md-3">
  <a class="block block-link-hover3 text-center" @click="$parent.onCreate()">
    <div class="block-content block-content-full">
      <div class="h1 font-w700 text-success"><i class="fa fa-plus"></i></div>
    </div>
    <div class="block-content block-content-full block-content-mini bg-gray-lighter text-success font-w600">Add New Customer</div>
  </a>
</div>

  <infinity-customer baseurl="back-office/list-customers" inline-template>
        <div>

           <div v-if="$parent.$parent.showList">

          @include('back_office/sales/customers/list')
            </div>
            <div v-else>

                @include('back_office/sales/customers/form')
            </div>
        </div>
    </infinity>
