<template>
    <div>
        <div class="col-md-6 col-xl-3">
            <a class="block block-rounded block-link-shadow" @click="onCreate()" href="#">
                <div class="block-content block-content-full block-sticky-options">
                    <div class="block-options">
                        <div class="block-options-item">
                            <i class="fa fa-archive fa-2x text-success-light"></i>
                        </div>
                    </div>
                    <div class="py-20 text-center">
                        <div class="font-size-h2 font-w700 mb-0 text-success">
                            <i class="fa fa-plus"></i>
                        </div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">New Supplier</div>
                    </div>
                </div>
            </a>
        </div>
        <b-table :data="list" hoverable>
                  <template slot-scope="props">
                      <b-table-column field="supplier_taxid" v-bind:label="lang('global.TaxID')">
                          {{ props.row.supplier_taxid }}
                      </b-table-column>
                      <b-table-column field="supplier_alias" v-bind:label="lang('back-office.Supplier')">
                          {{ props.row.supplier_alias }}
                      </b-table-column>
                      <b-table-column field="supplier_email" v-bind:label="lang('global.Email')">
                          {{ props.row.supplier_email }}
                      </b-table-column>


                      <b-table-column custom-key="actions">
                        <router-link :to="{ name: 'supplier.form',params: { profile:profile,id:supplier.id} }">
                            <button  type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Edit">
                                <i class="fa fa-pencil"></i>
                            </button>
                        </router-link>
                          <button v-on:click="onDelete(props.row)" type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" data-original-title="Delete">
                              <i class="fa fa-times"></i>
                          </button>
                      </b-table-column>
                  </template>
              </b-table>
    

</div>
</template>
<script>

export default {
    data() {
        return {
            profile:'',
            list: [],
            meta: [{total:0}],


        };
    },

    methods: {
        onLoad(page) {
            this.profile=this.$route.params.profile;
            axios
            .get('/api/' + this.profile + '/back-office/list/suppliers/1?page=' + page  )
            .then(response => {

                this.list = response.data.data;
                this.meta = response.data.meta;
            }).catch(error => {

            });
        },
        pageChange (page) {
            var app = this;
            app.onLoad(page);
        },
        onCreate () {
            var app = this;
            app.$router.push({ name: "supplier.form", params: { id: 0 } });
        },
        onDelete($data)
        {
            var app = this;

            this.$swal({
                title: 'Delete Record',
                text: "Sure? This action is non-reversable",
                type: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            })
            .then(() => {

                axios.delete('/api/' + this.profile + '/back-office/suppliers' + $data.id)
                .then(() => {

                    let index = this.list.findIndex(x => x.id === $data.id);
                    this.list.splice(index, 1);

                    this.$toast.open({
                        duration: 750,
                        message: 'The record has been deleted',
                        position: 'is-bottom-right',
                        type: 'is-danger'
                    })
                })
                .catch(ex => {
                    console.log(ex.response);
                    this.$toast.open({
                        duration: 5000,
                        message: 'Error trying to delete record',
                        type: 'is-danger'
                    })
                });
            });
        },
    },
    mounted: function mounted()
    {
        var app = this;
        app.onLoad();
    }
}
</script>
