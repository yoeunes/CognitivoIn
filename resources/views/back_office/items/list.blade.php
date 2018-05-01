<div>
  <div class="row">
    <div class="col-1 m--font-boldest">
      <p class="m--font-boldest m--font-transform-u">@lang('global.sku')</p>
    </div>
    <div class="col-5">
      <p class="m--font-boldest m--font-transform-u">@lang('global.name')</p>
    </div>
    <div class="col-2">
      <p class="m--font-boldest m--font-transform-u">@lang('global.short_description')</p>
    </div>

  </div>

  <div class="row m--margin-bottom-5" v-for="invoice in list">
    <div class="col-1">
      <p> @{{ invoice.sku }} </p>
    </div>
    <div class="col-1">
      <p> @{{ invoice.name }} </p>
    </div>
    <div class="col-1">
      <p> @{{ invoice.short_description }} </p>
    </div>

    <div class="col-1">
      <div class="m-btn-group btn-group-sm m-btn-group--pill btn-group" role="group" aria-label="...">

        <a @click="onEdit(invoice.id)" class="m-btn btn btn-secondary"><i class="la la-pencil m--font-brand"></i></a>
        <a @click="onDelete(invoice)" class="m-btn btn btn-secondary"><i class="la la-trash m--font-danger"></i></a>
        <a @click="onAnull(invoice)" class="m-btn btn btn-secondary"><i class="la la-close m--font-danger"></i></a>
      </div>
    </div>
  </div>
  @include('layouts/infinity-loading')
</div>
