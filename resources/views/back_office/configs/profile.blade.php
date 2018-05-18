<!-- Page Content -->
<div class="content">
    <div class="my-50 text-center">
        <h2 class="font-w700 text-black mb-10">John Smith</h2>
        <h3 class="h5 text-muted mb-0">Crypto Investor</h3>
    </div>
    <div class="block block-fx-shadow">
        <div class="block-content">
            <!-- User Profile -->
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
                            <input type="text" class="form-control form-control-lg" placeholder="Government Assigned Taxpayer ID">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="crypto-settings-email">Company Name</label>
                            <input type="text" class="form-control form-control-lg" placeholder="Official Company Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="crypto-settings-email">Commercial Name (Alias)</label>
                            <input type="text" class="form-control form-control-lg" placeholder="How would people know you. Sometimes a brand.">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="crypto-settings-nickname">Slug</label>
                            <input type="text" class="form-control form-control-lg" value="{{ request()->route('profile')->slug }}" disabled="">
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
                            <input type="text" class="form-control form-control-lg">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-12">
                            <label>Long Description</label>
                            <textarea class="form-control form-control-lg">

                            </textarea>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group row">
                        <div class="col-12">
                            <label>Telephone</label>
                            <input type="tel" class="form-control form-control-lg">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label>Email</label>
                            <input type="email" class="form-control form-control-lg">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label>Website</label>
                            <input type="url" class="form-control form-control-lg" value="http://">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label>Address</label>
                            <textarea class="form-control form-control-lg">

                            </textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-4">
                            <label>City</label>
                            <input type="text" class="form-control form-control-lg">
                        </div>
                        <div class="col-4">
                            <label>Postal Code</label>
                            <input type="text" class="form-control form-control-lg">
                        </div>
                        <div class="col-4">
                            <label>Country</label>
                            <input type="text" class="form-control form-control-lg" disabled="">
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Personal Details -->

            <!-- Security -->
            <form action="be_pages_crypto_settings.html" method="post" onsubmit="return false;">
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
                                <input type="text" class="form-control form-control-lg">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="custom-control custom-checkbox mb-5">
                                <input class="custom-control-input" type="checkbox" checked="">
                                <label class="custom-control-label">Make profile public</label>
                            </div>
                            <div class="text-muted">Marking this options makes your site public for potential customers.</div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- END Security -->
        </div>
    </div>
</div>
<!-- END Page Content -->
