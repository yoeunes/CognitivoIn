<customer-form inline-template>
  <div>
    <div class="row">
      <div class="form-group">
        <div class="col-xs-12">
          <div class="form-material form-material-primary">

            <input class="form-control" type="text" v-model="customer_taxid">

            <label for="taxid">GovCode</label>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="col-xs-12">
          <div class="form-material form-material-primary">

            <input class="form-control" type="text"  v-model="customer_alias">


            <label for="alias">Alias</label>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="col-xs-12">
          <div class="form-material form-material-primary">

            <input class="form-control" type="text" id="address" name="address" v-model="customer_address">


            <label for="address">Address</label>
          </div>
        </div>
      </div>

        <div class="form-group">
          <div class="col-xs-12">
            <div class="form-material form-material-primary">

              <input class="form-control" type="text" id="telephone" name="telephone"  v-model="customer_telephone">

              <label for="telephone">Telephone</label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <div class="form-material form-material-primary">

              <input class="form-control" type="text" id="email" name="email" v-model="customer_email">


              <label for="email">Email</label>
            </div>
          </div>
        </div>
  <div class="form-group">
        <button v-on:click="onSave($data,false)" class="btn btn-primary">
          @lang('global.Save')
        </button>
        <button v-on:click="onSave($data,true)" class="btn btn-primary">
          @lang('global.Save-and-New')
        </button>
        <button v-on:click="$parent.cancel()" class="btn btn-default">
          @lang('global.Cancel')
        </button>
      </div>
      </div>
    </div>
  </item-form>
