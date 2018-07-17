<template>
  <div>
    <relationship-form ref="back_officeForm" inline-template>
      <div>

        <!-- User Profile -->
        <h2 class="content-heading text-black">{{lang('back-office.Commercial')}}</h2>
        <div class="row items-push">
          <div class="col-lg-3">
            <p class="text-muted">
              Load the customers commercial information, this information helps during order process.
            </p>
          </div>
          <div class="col-lg-7 offset-lg-1">

            <b-field label="lang('back-office.Name')">
              <b-input v-model="customer_alias"></b-input>
            </b-field>

            <b-field v-bind:label="lang('global.Save-and-New')">
              <b-input v-model="customer_taxid"></b-input>
            </b-field>

            <b-field label="Credit Limit">
              <b-input v-model="credit_limit"></b-input>
            </b-field>

            <b-field label="lang('back-office.Default_Contract')" v-if="credit_limit != ''">
              <select v-model="contract_ref" required class="custom-select" >
                <option v-for="contract in contracts" :value="contract.id">{{ contract.name }}</option>
              </select>
            </b-field>
          </div>
        </div>
        <!-- END User Profile -->

        <!-- Personal Details -->
        <h2 class="content-heading text-black"> {{lang('back-office.Customer')}} </h2>
        <div class="row items-push">
          <div class="col-lg-3">
            <p class="text-muted">
              Load contact information such as address, emails, and telephone numbers.
            </p>
          </div>
          <div class="col-lg-7 offset-lg-1">
            <b-field label="lang('global.Telephone')">
              <b-input v-model="customer_telephone"></b-input>
            </b-field>
            <b-field label="lang('global.Email')">
              <b-input v-model="customer_email" type="email"></b-input>
            </b-field>
            <b-field label="lang('global.Address')">
              <b-input type="textarea" v-model="customer_address"></b-input>
            </b-field>
          </div>
        </div>
        <!-- END Personal Details -->

        <div class="row">
          <button v-on:click="$parent.onSave($data, false)" class="btn btn-outline-primary min-width-125 js-click-ripple-enabled m" data-toggle="click-ripple">
            {{lang('global.Save')}}
          </button>

          <button v-on:click="$parent.onSave($data, true)" class="btn btn-outline-primary min-width-125 js-click-ripple-enabled" data-toggle="click-ripple">
            {{lang('global.Save-and-New')}}
          </button>

          <button v-on:click="$parent.onCancel()" class="btn btn-alt-secondary min-width-125 js-click-ripple-enabled" data-toggle="click-ripple">
            {{lang('global.Cancel')}}
          </button>
        </div>
      </div>
    </relationship-form>
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
      var app = this;
      axios.post('/api/' + app.profile + '/back-office/customers', $data)
      .then(() =>
      {
        this.$toast.open({
          message: 'Awsome! Your work has been saved',
          type: 'is-success'
        })

        this.$router.push({ name: "customer.index" });
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
      this.$router.push({ name: "customer.index" });
    }

  },
  mounted: function mounted()
  {

    var app = this;
    app.profile=this.$route.params.profile;
    app.id=this.$route.params.id;
    if (app.id>0) {


      axios.get('/api/' + app.profile + '/back-office/customers/' + app.id + '/edit')
      .then(function (response) {
        console.log(app);
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
