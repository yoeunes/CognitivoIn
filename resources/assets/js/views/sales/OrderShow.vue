<template>
  <div>
    <order-form ref="back_officeForm" inline-template>
      <div class="content">
        <!-- Progress -->
        <h2 class="content-heading">
          <button type="button"  v-on:click="onApprove($data)" class="btn btn-sm btn-secondary float-right">
            <i class="fa fa-check text-success mr-5"></i>Complete
          </button>
          <button type="button" class="btn btn-sm btn-secondary float-right mr-5">
            <i class="fa fa-times text-danger mr-5"></i>Cancel
          </button>
          Progress
        </h2>
        <div class="row gutters-tiny">
          <!-- Submitted -->
          <div class="col-md-6 col-xl-3">
            <div class="block block-rounded">
              <div class="block-content block-content-full">
                <div class="py-20 text-center">
                  <div class="mb-20">
                    <i class="fa fa-check fa-3x text-success"></i>
                  </div>
                  <div class="font-size-sm font-w600 text-uppercase text-success">1. Submitted</div>
                </div>
              </div>
            </div>
          </div>
          <!-- END Submitted -->

          <!-- Payment -->

          <div class="col-md-6 col-xl-3" v-if="status>=2">
            <div class="block block-rounded">
              <div class="block-content block-content-full">
                <div class="py-20 text-center">
                  <div class="mb-20">
                    <i class="fa fa-check fa-3x text-success"></i>
                  </div>
                  <div class="font-size-sm font-w600 text-uppercase text-success">2. Payment</div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-3" v-if="status==1">
            <div class="block block-rounded">
              <div class="block-content block-content-full" v-on:click="onApprove($data)">
                <div class="py-20 text-center">
                  <div class="mb-20">
                    <i class="fa fa-times fa-3x text-muted"></i>
                  </div>
                  <div class="font-size-sm font-w600 text-uppercase text-muted">Approved</div>
                </div>
              </div>
            </div>
          </div>
          <!-- END Payment -->

          <!-- Packaging -->
          <div class="col-md-6 col-xl-3" v-if="status>=3">
            <div class="block block-rounded">
              <div class="block-content block-content-full">
                <div class="py-20 text-center">
                  <div class="mb-20">
                    <i class="fa fa-spinner fa-3x fa-spin text-warning"></i>
                  </div>
                  <div class="font-size-sm font-w600 text-uppercase text-warning">3. Packed</div>
                </div>
              </div>
            </div>
          </div>
          <!-- END Packaging -->
          <div class="col-md-6 col-xl-3" v-if="status==2">
            <div class="block block-rounded">
              <div class="block-content block-content-full" v-on:click="onStatusChanged()">
                <div class="py-20 text-center">
                  <div class="mb-20">
                    <i class="fa fa-times fa-3x text-muted"></i>
                  </div>
                  <div class="font-size-sm font-w600 text-uppercase text-muted">Packaging</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Completed -->
          <div class="col-md-6 col-xl-3" v-if="status>=4">
            <div class="block block-rounded">
              <div class="block-content block-content-full">
                <div class="py-20 text-center">
                  <div class="mb-20">
                    <i class="fa fa-check fa-3x text-success"></i>
                  </div>
                  <div class="font-size-sm font-w600 text-uppercase text-muted">4. Completed</div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-3" v-if="status==3">
            <div class="block block-rounded">
              <div class="block-content block-content-full" v-on:click="onStatusChanged">
                <div class="py-20 text-center">
                  <div class="mb-20">
                    <i class="fa fa-times fa-3x text-muted"></i>
                  </div>
                  <div class="font-size-sm font-w600 text-uppercase text-muted">Complete</div>
                </div>
              </div>
            </div>
          </div>
          <!-- END Completed -->


        </div>
        <!-- END Progress -->

        <!-- Customer -->
        <h2 class="content-heading">
          <button type="button" class="btn btn-sm btn-secondary float-right">
            <i class="fa fa-envelope-o text-info mr-5"></i>Contact
          </button>

          <div>
            {{customer_name}}
          </div>
        </h2>
        <div class="row row-deck">

          <!-- Addresses -->

          <div class="row row-deck gutters-tiny">

            <!-- Billing Address -->
            <div class="col-md-6">
              <div class="block block-rounded">
                <div class="block-header block-header-default">
                  <h3 class="block-title">Billing Address</h3>
                </div>
                <div class="block-content">
                  <div class="font-size-lg text-black mb-5">{{customer_name}}</div>
                  <address>
                    {{customer_address}}<br>

                    <i class="fa fa-phone mr-5"></i> {{customer_telephone}}<br>
                    <i class="fa fa-envelope-o mr-5"></i> <a href="javascript:void(0)">{{customer_email}}</a>
                  </address>
                </div>
              </div>
            </div>
            <!-- END Billing Address -->

            <!-- Shipping Address -->
            <div class="col-md-5">
              <div class="block block-rounded">
                <div class="block-header block-header-default">
                  <h4 class="block-title">Shipping Address</h4>
                </div>
                <div class="block-content">
                  <div class="font-size-lg text-black mb-5">{{customer_name}}</div>
                  <address>
                    {{customer_address}}<br>

                    <i class="fa fa-phone mr-5"></i> {{customer_telephone}}<br>
                    <i class="fa fa-envelope-o mr-5"></i> <a href="javascript:void(0)">{{customer_email}}</a>
                  </address>
                </div>
              </div>
            </div>
            <!-- END Shipping Address -->

          </div>
          <!-- END Addresses -->

          <!-- Products -->


          <!-- END Products -->


        </div>
        <div >
          <h2 class="content-heading text-black">Commercial</h2>
          <div class="row items-push">
            <div class="col-lg-3">
              <p class="text-muted">
                This is how your item will be commercialized.
              </p>
            </div>

            <div class="col-lg-7 offset-lg-1">
              <div class="form-group row">
                <div class="col-6">
                  <label>Date</label>
                  {{date}}

                </div>
              </div>
              <div class="form-group row">
                <div class="col-6">
                  <label>Currency</label>
                  {{currency}}
                </div>

                <div class="col-6">
                  <label>Rate</label>
                  {{rate}}
                </div>
              </div>

              <div class="form-group row">

                <div class="col-6">
                  <label>Contract</label>
                  <select disabled ="true"  v-model="contract_id" required class="custom-select" >
                    <option v-for="contract in contracts" :value="contract.id">{{ contract.name }}</option>
                  </select>
                </div>
                <div class="col-6">
                  <label>Number</label>
                  {{number}}
                </div>
                <div class="col-6">
                  <label>code</label>
                  {{code}}
                </div>
                <div class="col-6">
                  <label>Expiry Date</label>
                  {{code_expiry}}

                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="block block-rounded">
          <div class="block-content">
            <div class="table-responsive">

              <table class="table table-borderless table-striped">
                <thead>
                  <tr>
                    <th>Product</th>
                    <th class="text-center">VAT</th>
                    <th class="text-center">QTY</th>
                    <th class="text-right" style="width: 10%;">PRICE</th>
                    <th class="text-right" style="width: 10%;">PriceVAt</th>
                    <th class="text-right" style="width: 10%;">TOTAL</th>
                    <th class="text-right" style="width: 10%;">TOTALVAt</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="detail in details">

                    <td>
                      <a href="be_pages_ecom_product_edit.html">{{detail.name}}</a>
                    </td>
                    <td class="text-center">
                      <select disable="true" v-model="detail.vat_id" v-change="onPriceChange(detail)" required class="custom-select" >
                        <option v-for="vat in vats" :value="vat.id">{{ vat.name }}</option>
                      </select>
                    </td>
                    <td class="text-right">{{detail.quantity}}</td>
                    <td class="text-right">{{detail.unit_price}}</td>
                    <td class="text-right">{{detail.unit_price_vat}}</td>
                    <td class="text-right">{{detail.sub_total}}</td>
                    <td class="text-right">{{detail.sub_total_vat}}</td>
                  </tr>

                  <tr>
                    <td colspan="5" class="text-right font-w600">Total Price:</td>
                    <td class="text-right font-w600">{{$parent.total}}</td>
                    <td class="text-right">{{$parent.totalVAT}}</td>
                  </tr>
                  <tr class="table-success">
                    <td colspan="5" class="text-right font-w600 text-uppercase">Total Due:</td>
                    <td class="text-right font-w600">{{$parent.total}}</td>
                    <td class="text-right font-w600">{{$parent.totalVAT}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </order-form>
  </div>
</template>

<script>


export default {
  data() {
    return {
      profile:'',



    };
  },

  computed:
  {
    total: function ()
    {
      var app = this;
      var totalvalue = 0;

      for (var i = 0; i < app.$children[0].details.length; i++)
      { totalvalue = totalvalue + app.$children[0].details[i].sub_total; }

      return totalvalue.toFixed(2);
    },
    totalVAT: function ()
  {


    var app = this;
    var totalvalue = 0;

    for (var i = 0; i < app.$children[0].details.length; i++)
    { totalvalue = totalvalue + app.$children[0].details[i].sub_total_vat; }

    return totalvalue.toFixed(2);
  }
  },

  methods: {

    onSave($data)
    {
      console.log($data);
      var app = this;
      axios.post('/api/' + app.profile + '/back-office/orders', $data)
      .then(() =>
      {
        this.$toast.open({
          message: 'Awsome! Your work has been saved',
          type: 'is-success'
        })

        this.$router.push({ name: "order.index" });
      })
      .catch(ex => {
        console.log(ex.response);
        this.$toast.open({
          duration: 5000,
          message: 'Error trying to save record',
          type: 'is-danger'
        })
      });
    },
    onCancel()
    {
      console.log(this)
      this.$router.push({ name: "order.index" });
    }

  },
  mounted: function mounted()
  {


    var app = this;
    app.profile=this.$route.params.profile;
    app.id=this.$route.params.id;
    if (app.id>0) {


      axios.get('/api/' + app.profile + '/back-office/orders/' + app.id + '/edit')
      .then(function (response) {
        console.log(response.data);
        app.$children[0].onEdit(response.data)
      })
      .catch(ex => {
        console.log(ex);

        app.$toast.open({
          duration: 5000,
          message: 'Error trying to edit this record',
          type: 'is-danger'
        })
      });
    }

  }

}
</script>
