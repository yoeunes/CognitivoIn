<template>
  <div class="">
    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Crear Contribuyente</h4>
          </div>
          <div class="modal-body">
            <div class="form-group m-form__group row">
              <label class="col-lg-3 col-form-label">
                Nombre
              </label>
              <div class="col-lg-7">
                <input type="text" v-model="customer_alias"/>
              </div>
            </div>


            <div class="form-group m-form__group row">
              <label class="col-lg-3 col-form-label">
                RUC
              </label>
              <div class="col-lg-7">
                <input type="text" v-model="customer_taxid"/>
              </div>
            </div>

            <div class="form-group m-form__group row">
              <label class="col-lg-3 col-form-label">
                Dirección
              </label>
              <div class="col-lg-7">
                <textarea  v-model="address"/>
              </div>
            </div>

            <div class="form-group m-form__group row">
              <label class="col-lg-3 col-form-label">
                Correo
              </label>
              <div class="col-lg-7">
                <input type="text" v-model="email"/>
              </div>
            </div>

            <div class="form-group m-form__group row">
              <label class="col-lg-3 col-form-label">
                Teléfono
              </label>
              <div class="col-lg-7">
                <input type="text" v-model="telephone"/>
              </div>
            </div>
            <div class="form-group">

              <div class="col-sm-7">
                <button type="submit" data-dismiss="modal" class="btn btn-success" v-on:click="onSave()">
                  Guardar
                </button>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div class="input-group m-input-group">
      <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">
          <i class="fa fa-spinner fa-spin" v-if="loading"></i>
          <template v-else>
            <i class="fa fa-search" v-show="isEmpty"></i>
            <i class="fa fa-times" v-show="isDirty" @click="reset"></i>
          </template>
        </span>
      </div>

      <input type="text"
      name ="contribuyente"
      class="form-control m-input"
      placeholder="Buscar"
      aria-describedby="basic-addon2"
      autocomplete="off"



      v-model="query"
      @keydown.down="down"
      @keydown.up="up"
      @keydown.enter="hit"
      @keydown.esc="reset"
      @blur="reset"
      @input="update"/>

      <div class="input-group-append">
        <span  id="basic-addon1">
          <a class="btn-icon-only" data-pk="1" data-target="#myModal1" data-title="Añadir" data-toggle="modal" data-type="text">
            <i class="fa fa-plus push-5-r"></i>
          </a>
          <input type="hidden" name="relationship_id" v-model="id"/>
          @{{ selectText }}
        </span>
      </div>
    </div>
    <span class="m-form__help">
      <ul v-show="hasItems">
        <li v-for="(item, $item) in items" :class="activeClass($item)" @mousedown="hit" @mousemove="setActive($item)">
          <span class="name" v-text="item.customer_alias"></span>
          <span class="screen-name" v-text="item.screen_name"></span>
        </li>
      </ul>
    </span>
  </div>
</template>

<script>
import VueTypeahead from 'vue-typeahead'
import Vue from 'vue'
import Axios from 'axios'
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
Vue.prototype.$http = Axios

export default {
  extends: VueTypeahead,
  props: ['current_company'],
  data () {
    return {
      customer_alias:'',
      customer_taxid:'',
      address:'',
      email:'',
      telephone:'',
      src: '/api/getCustomer/' + this.current_company['slug'] + '/',
      limit: 5,
      minChars: 3,
      queryParamName: '',
      selectText:'Favor Elegir',
      id:''
    }
  },

  methods:
  {
    onHit (item)
    {
      var app = this  ;

      app.selectText = item.customer_alias + ' | ' + item.customer_taxid;
      app.id= item.id;
      app.$parent.relationship_id=item.id;
      app.$parent.customer_address=item.customer_address;
      app.$parent.customer_email=item.customer_email;
      app.$parent.customer_name=item.customer_alias;
      app.$parent.customer_telephone=i

    },
    onSave()
    {
      $.ajax({
        url: '/api/save_customer/' + this.current_company['slug'] + '/',
        type: 'post',
        data:{

          customer_alias:this.customer_alias,
          customer_taxid:this.customer_taxid,
          address:this.address,
          email:this.email,
          telephone:this.telephone,
        },
        dataType: 'json',
        async: false,
        success: function(data)
        {
          //console.log(data);
        },
        error: function(xhr, status, error)
        {
          console.log(xhr.responseText);
        }
      });

    }
  }
}
</script>
