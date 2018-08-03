<template>
  <div>
    <order-form ref="back_officeForm" inline-template>
      <div class="content">


        <!-- Customer -->
        <h2 class="content-heading">
          <button type="button" v-on:click="$parent.onSave($data, false)" class="btn btn-sm btn-secondary float-right">
            <i class="fa fa-save text-info mr-5"></i>{{lang('global.Save')}}
          </button>
          Customer
          <b-field>
            <b-autocomplete v-model="customer_name" :data="customers" placeholder="Search Customer" field="customer_alias"
            :loading="isFetching" @input="getCustomers" @select="option => addCustomer(option)">
            <template slot-scope="props">
              <strong>@{{props.option.customer_taxid}}</strong> | @{{props.option.customer_alias}}
            </template>
            <template slot="empty">
              There are no customers
            </template>
          </b-autocomplete>
        </b-field>
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

        <div class="block block-rounded">
          <div class="block-content">
            <div class="table-responsive">
              <b-field>
                <b-autocomplete v-model="item_name" :data="items" placeholder="Search Item" field="name"
                :loading="isFetching" @input="getItems" @select="option => addItem(option)">
                <template slot-scope="props">
                  <strong>@{{props.option.name}}</strong> | @{{props.option.code}}
                </template>
                <template slot="empty">
                  There are no items
                </template>
              </b-autocomplete>
            </b-field>
            <table class="table table-borderless table-striped">
              <thead>
                <tr>

                  <th>Product</th>
                  <th class="text-center">QTY</th>
                  <th class="text-right" style="width: 10%;">UNIT</th>
                  <th class="text-right" style="width: 10%;">PRICE</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="detail in details">

                  <td>
                    <a href="be_pages_ecom_product_edit.html">{{detail.name}}</a>
                  </td>
                  <td class="text-center">{{detail.quantity}}</td>
                  <td class="text-right">{{detail.unit_price}}</td>
                  <td class="text-right">{{detail.sub_total}}</td>
                </tr>

                <tr>
                  <td colspan="3" class="text-right font-w600">Total Price:</td>
                  <td class="text-right">$245,00</td>
                </tr>
                <tr>
                  <td colspan="3" class="text-right font-w600">Total Paid:</td>
                  <td class="text-right">$245,00</td>
                </tr>
                <tr class="table-success">
                  <td colspan="3" class="text-right font-w600 text-uppercase">Total Due:</td>
                  <td class="text-right font-w600">$0,00</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- END Products -->


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
