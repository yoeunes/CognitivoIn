<template>
    <div>

        <div class="content">
            <div class="my-50 text-center">
                <h2 class="font-w700 text-black mb-10">{{ profile.name }}</h2>
                <h3 class="h5 text-muted mb-0">{{ profile.short_description }}</h3>
            </div>
            <div class="block block-fx-shadow">
                <div class="block-content">

                    <!-- Company Profile -->
                    <h2 class="content-heading text-black"> Company Profile </h2>
                    <div class="row items-push">
                        <div class="col-lg-3">
                            <p class="text-muted">
                                Your account’s vital info. Your nickname will be publicly visible.
                            </p>
                        </div>
                        <div class="col-lg-7 offset-lg-1">
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="crypto-settings-nickname">Taxpayer ID</label>
                                    <input type="text" class="form-control form-control-lg" v-model="profile.taxid" name="taxid" placeholder="Government Assigned Taxpayer ID">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="crypto-settings-email">Company Name</label>
                                    <input type="text" class="form-control form-control-lg" v-model="profile.name" name="name" placeholder="Official Company Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="crypto-settings-email">Commercial Name (Alias)</label>
                                    <input type="text" class="form-control form-control-lg" v-model="profile.alias " name="alias" placeholder="How would people know you. Sometimes a brand.">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="crypto-settings-nickname">Slug</label>
                                    <input type="text" class="form-control form-control-lg" v-model="profile.slug" name="slug" disabled="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END User Profile -->

                    <!-- Personal Details -->
                    <h2 class="content-heading text-black">Personal Details</h2>
                    <div class="row items-push">
                        <div class="col-lg-3">
                            <p class="text-muted">
                                This data will be publicly available
                            </p>
                        </div>
                        <div class="col-lg-7 offset-lg-1">
                            <div class="form-group row">
                                <div class="col-12">
                                    <label>Short Description</label>
                                    <input type="text" v-model="profile.short_description" name="short_description" class="form-control form-control-lg">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <label>Long Description</label>
                                    <textarea class="form-control form-control-lg" name="long_description">{{ profile.long_description }}</textarea>
                                </div>
                            </div>

                            <hr>

                            <div class="form-group row">
                                <div class="col-12">
                                    <label>Telephone</label>
                                    <input type="tel" v-model="profile.telephone" name="telephone" class="form-control form-control-lg">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label>Email</label>
                                    <input type="email" v-model="profile.email" name="email" class="form-control form-control-lg">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label>Website</label>
                                    <input type="text" v-model="profile.website" name="website" class="form-control form-control-lg" value="http://">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label>Address</label>
                                    <textarea class="form-control form-control-lg" name="address">{{ profile.address }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-4">
                                    <label>Postal Code</label>
                                    <input type="text" v-model="profile.zip" name="zip" class="form-control form-control-lg">
                                </div>
                                <div class="col-4">
                                    <label>State</label>
                                    <input type="text" v-model="profile.state" name="state" class="form-control form-control-lg">
                                </div>
                                <div class="col-4">
                                    <label>Country</label>
                                    <input type="text" v-model="profile.country" name="country" class="form-control form-control-lg" disabled="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Personal Details -->

                    <!-- Settings -->
                    <h2 class="content-heading text-black"> Settings </h2>
                    <div class="row items-push">
                        <div class="col-lg-3">
                            <p class="text-muted">
                                Keep your account as secure and as private as you like.
                            </p>
                        </div>

                        <div class="col-lg-7 offset-lg-1">
                            <div class="form-group row">
                                <div class="col-6">
                                    <label>Default Currency</label>
                                    <input type="text" v-model="profile.currency" name="currency" class="form-control form-control-lg">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="custom-control custom-checkbox mb-5">
                                    <input class="custom-control-input" type="checkbox" name="is_public" checked="">
                                    <label class="custom-control-label">Make profile public</label>
                                </div>
                                <div class="text-muted">Marking this options makes your site public for potential customers.</div>
                            </div>
                        </div>
                    </div>

                    <button class="button" v-on:click="onSave($data.profile, false)" name="button">Update</button>

                    <!-- END Security -->
                </div>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    data() {
        return {
            profile:[],



        };
    },


    methods: {


        onLoad()
        {

            var app = this;
            app.profile=JSON.parse(this.$route.params.profile);


        },

        onSave($data)
        {
            var app = this;
            axios.put('/api/profile/' + $data.id, $data)
            .then(() =>
            {

                this.$toast.open({
                    message: 'Awsome! Your work has been saved',
                    type: 'is-success'
                })


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


    },
    mounted: function mounted()
    {
        var app = this;
        app.onLoad();
    }
}
</script>
