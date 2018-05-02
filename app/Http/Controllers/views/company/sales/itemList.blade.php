<div class="modal" id="modal-normal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div >
        <div class="block block-themed block-transparent remove-margin-b">
          <div class="block-header bg-primary-dark">
            <ul class="block-options">
              <li>
                <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
              </li>
            </ul>
            <h3 class="block-title"></h3>
          </div>
          <div class="block-content">
            <table class="table table-bordered table-striped js-dataTable-full">
              <thead>
                <tr>
                  <th class="text-center">SKU</th>
                  <th class="text-center">Name</th>
                  <th class="hidden-s" style="width: 15%;">Price</th>
                  <th class="hidden-s" style="width: 15%;">Quantity</th>
                  <th class="text-center" style="width: 10%;">Actions</th>
                </tr>
              </thead>
              <tbody>
                <template v-for="item in items">
                  <tr>
                    <td class="font-w600">@{{ item.sku }}</td>
                    <td class="font-w600">@{{ item.name }}</td>
                    <td class="hidden-xs">@{{ item.price }}</td>
                    <td class="hidden-xs">@{{ item.quantity }}</td>
                    <td class="text-center">
                      <div class="btn-group">
                        <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Add Quantity" v-on:click="addQuantity(item)"><i class="fa fa-plus"></i></button>
                        <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Remove Quantity" v-on:click="removeQuantity(item)"><i class="fa fa-minus"></i></button>
                      </div>
                    </td>
                  </tr>
                </template>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Close</button>
          <button class="btn btn-sm btn-primary" type="button" data-dismiss="modal"><i class="fa fa-check"></i> Ok</button>
        </div>
      </div>
    </div>
  </div>
</div>
