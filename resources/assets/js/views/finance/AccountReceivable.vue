<template>
    <div>

        <table>
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>InvoiceDate</th>
                    <th>Balance</th>
                    <th>CurrencyCode</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="customer in list">
                    <td>{{ customer.relationship.customer_alias }}</td>
                    <td>{{ customer.date }}</td>
                    <td>{{ customer.balance }}</td>
                    <td>{{ customer.currency }}</td>

                </tr>
            </tbody>
        </table>

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
            .get('/api/' + this.profile + '/back-office/list/account-receivables/1?page=' + page  )
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
