<template>
  <div>
    <div class="block-header bg-gray-lighter">
      <div class="block-content block-content-full">
        <button class="btn btn-info" data-toggle="modal" data-target="#modal-normal" type="button" v-on:click="Product()">Add Product</button>
      </div>
    </div>
    <div class="modal" id="modal-normal" tabindex="-1" role="dialog" aria-hidden="true" >
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

                    <tr  v-for="item in items">
                      <td class="font-w600">{{ item.sku }}</td>
                      <td class="font-w600">{{ item.name }}</td>
                      <td class="hidden-xs">{{ item.price }}</td>
                      <td class="hidden-xs">{{ item.quantity }}</td>

                      <td class="text-center">
                        <div class="btn-group">
                          <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Add Quantity" v-on:click="addQuantity(item)"><i class="fa fa-plus"></i></button>
                          <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Remove Quantity" v-on:click="removeQuantity(item)"><i class="fa fa-minus"></i></button>
                        </div>
                      </td>
                    </tr>

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
  </div>

</template>
<script>


export default {

  data: function () {
    return {
      url:'',
      items:[]
    }
  },

  methods:
  {
    addQuantity: function (detail)
    {
      this.$parent.addQuantity(detail);
    },
    removeQuantity: function (detail)
    {
      this.$parent.removeQuantity(detail);
    },

    Product: function ()
    {

      var app = this;


        if(app.items.length==0)
        {
          var quantity=0;
          axios.get('/api/getItems/'+ this.$parent.$parent.profile )
          .then(function (resp)
          {
            console.log(resp.data);
            for(let i = 0; i < resp.data.length; i++)
            {

              for(let j = 0; i <   app.$parent.details.length; j++)
              {

                if (typeof app.$parent.details[j] != 'undefined') {

                  if (app.$parent.details[j].sku==resp.data[i].sku)
                  {

                    quantity=Math.round(app.$parent.details[j].quantity*100)/100;
                    break;
                  }
                }



                }
                app.items.push({ price:resp.data[i].unit_price,cost:resp.data[i].unit_cost,sku:resp.data[i].sku
                  ,name:resp.data[i].name,quantity:quantity,item_id:resp.data[i].id,currency_id:resp.data[i].currency_id});
                  quantity=0;

              }

            })
            .catch(function (resp) {
              console.log(resp);
              alert("Something wrong for load items");
            });
          }
        }






    }


  }

  </script>
