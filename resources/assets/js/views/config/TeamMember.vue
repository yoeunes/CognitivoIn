<template>
    <div>
        <table class="table table-borderless table-striped">
            <thead>
                <tr>
                    <th style="width: 100px;">ID</th>
                    <th class="d-none d-sm-table-cell">@lang('global.Name')</th>
                    <th>@lang('global.Address')</th>
                    <th class="d-none d-md-table-cell">@lang('global.Role')</th>
                    <th class="text-right">@lang('global.Actions')</th>
                </tr>
            </thead>
            <tbody>
                <div class="">
                    <tr v-for="followers in list">
                        <td>
                            <a class="font-w600" href="be_pages_ecom_product_edit.html">@{{ followers.id }}</a>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            @{{ followers.profile.name }}
                        </td>
                        <td class="d-none d-sm-table-cell">
                            @{{ followers.profile.address }}
                        </td>
                        <td v-if="followers.role===1">
                            Admin
                        </td>
                        <td v-if="followers.role===2">
                            Manager
                        </td>
                        <td v-if="followers.role===3">
                            Employee
                        </td>
                        <td v-if="followers.role===4">
                            Member
                        </td>
                        <td v-if="followers.role===5">
                            Follower
                        </td>
                        <td class="text-right">
                            <a @click="onEdit(followers,false)" class="m-btn btn btn-secondary"><i class="la la-pencil m--font-brand"></i></a>
                            <a @click="onDelete(followers)" class="m-btn btn btn-secondary"><i class="la la-trash m--font-danger"></i></a>
                        </td>
                    </tr>
                </div>
            </tbody>
        </table>
        <b-pagination
        :total="meta.total"
        :current.sync="meta.current_page"
        :simple="false"
        :per-page="meta.per_page"
        @change="pageChange">
    </b-pagination>
</div>
</template>
<script>
export default {
    data() {
        return {
            profile:'',
            list: [],
            meta: [{total:0}],
            links: {
                first: null,
                last: null,
                next: null,
                prev: null,
            },

        };
    },



    methods: {
        setData(page) {
            this.profile=this.$route.params.profile;
            axios
            .get('/api/' + this.profile + '/back-office/list/followers/1?page=' + page  )
            .then(response => {

                this.list = response.data.data;
                this.links = response.data.links;
                this.meta = response.data.meta;

            }).catch(error => {

            });

        },
        pageChange (page) {
            var app = this;
            app.setData(page);
        }

    },
    mounted: function mounted()
    {
        var app = this;
        app.setData(1);
    }
}

</script>
