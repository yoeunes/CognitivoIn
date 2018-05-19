<order-form inline-template>
  <div>

    <div class="row" >
       <div class="col-lg-6">
         <!-- Billing Address -->
         <div class="block">
           <div class="block-header bg-gray-lighter">
             <h3 class="block-title">Billing Address</h3>
           </div>
           <div class="block-content block-content-full">
             <div class="h4 push-5">

           <select required id="dropDown" required :Change="onContactChange()" v-model="relationship_id" >
                 <option >Select an Customer</option>

                 <option v-for="customer in customers" :value="customer.id">@{{ customer.customer_alias }}</option>

               </select>
             </div>
             <address>
               @{{customer_name}}<br>
               @{{ customer_address }}<br><br>
               <i class="fa fa-phone"></i> @{{ customer_telephone }}<br>
               <i class="fa fa-envelope-o"></i> <a href="javascript:void(0)">@{{ customer_email }}</a>
             </address>
           </div>
         </div>
         <!-- END Billing Address -->
       </div>
       <div class="col-lg-6">
         <!-- Shipping Address -->
         <div class="block">
           <div class="block-header bg-gray-lighter">
             <h3 class="block-title">Shipping Address</h3>
           </div>
           <div class="block-content block-content-full">
             <div class="h4 push-5">@{{ customer_name }}</div>
             <address>
               <br>
               @{{ customer_address }}<br><br>
               <i class="fa fa-phone"></i> @{{ customer_telephone }}<br>
               <i class="fa fa-envelope-o"></i> <a href="javascript:void(0)">@{{ customer_email }}</a>
             </address>
           </div>
         </div>
         <!-- END Shipping Address -->
       </div>
     </div>
     <div class="row" >
       <div class="block">

         <item></item>

         <div class="block-content">

           <div class="table-responsive">

             <table class="table table-borderless table-striped table-vcenter">
               <thead>
                 <tr>
                   <th class="hidden-s text-center">SKU</th>
                   <th class="text-center">Name</th>
                   <th class="hidden-s" style="width: 15%;">Quantity</th>
                   <th style="width: 15%;">Price</th>
                   <th class="hidden-s" style="width: 15%;">Sub Total</th>
                 </tr>
               </thead>
               <tbody>

                 <tr v-for="order in details" >
                   <td class="hidden-s">@{{ order.sku }}</td>
                   <td class="font-w700">@{{ order.name }}</td>
                   <td class="hidden-s">@{{ order.quantity }}</td>
                   <td>@{{ order.price }}</td>
                   <td class="hidden-s">@{{ order.sub_total }}</td>
                 </tr>
                 <tr>
                   <td colspan="5" class="text-right"><strong>Total Price:</strong></td>
                   <td class="text-right">@{{ grandTotal }}</td>
                 </tr>


               </tbody>
             </table>
           </div>
         </div>
       </div>

       <div class="block-header bg-gray-lighter">
         <div class="block-content block-content-full">
           <button class="btn btn-info" v-on:click="onSave($data)" type="button">Save Product</button>
         </div>

       </div>
     </div>
  </div>
</order-form>
