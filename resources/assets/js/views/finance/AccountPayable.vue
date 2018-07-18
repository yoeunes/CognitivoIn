<template>
    <div>

      <b-table :data="list" hoverable>
                <template slot-scope="props">
                    <b-table-column field="customer_alias" v-bind:label="lang('back-office.Customer')">
                        {{ props.row.relationship.customer_alias }}
                    </b-table-column>
                    <b-table-column field="date" v-bind:label="lang('global.Date')">
                        {{ props.row.date }}
                    </b-table-column>
                    <b-table-column field="balance" v-bind:label="lang('global.Balance')">
                        {{ props.row.balance }}
                    </b-table-column>
                    <b-table-column field="currency" v-bind:label="lang('global.Currency')">
                        {{ props.row.currency }}
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
            .get('/api/' + this.profile + '/back-office/list/account-payables/1?page=' + page  )
            .then(response => {
                console.log(response.data);
                this.list = response.data.data;
                this.meta = response.data.meta;
            }).catch(error => {

            });
        },
        pageChange (page) {
            var app = this;
            app.onLoad(page);
        }

    },
    mounted: function mounted()
    {
        var app = this;
        app.onLoad(1);
    }
}
</script>
