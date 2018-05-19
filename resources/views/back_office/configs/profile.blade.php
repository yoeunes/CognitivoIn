<!-- Page Content -->
<div class="content">
    <div class="my-50 text-center">
        <h2 class="font-w700 text-black mb-10">{{ request()->route('profile')->name }}</h2>
        <h3 class="h5 text-muted mb-0">{{ request()->route('profile')->short_description }}</h3>
    </div>
    <div class="block block-fx-shadow">
        <div class="block-content">
            <form action="{{ route('profile.update', [request()->route('profile')]) }}" method="post">
                {{ csrf_field() }}
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
                                <input type="text" class="form-control form-control-lg" value="{{ request()->route('profile')->taxid }}" name="taxid" placeholder="Government Assigned Taxpayer ID">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="crypto-settings-email">Company Name</label>
                                <input type="text" class="form-control form-control-lg" value="{{ request()->route('profile')->name }}" name="name" placeholder="Official Company Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="crypto-settings-email">Commercial Name (Alias)</label>
                                <input type="text" class="form-control form-control-lg" value="{{ request()->route('profile')->alias }}" name="alias" placeholder="How would people know you. Sometimes a brand.">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="crypto-settings-nickname">Slug</label>
                                <input type="text" class="form-control form-control-lg" value="{{ request()->route('profile')->slug }}" name="slug" disabled="">
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
                                <input type="text" value="{{ request()->route('profile')->short_description }}" name="short_description" class="form-control form-control-lg">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <label>Long Description</label>
                                <textarea class="form-control form-control-lg" name="long_description">{{ request()->route('profile')->long_description }}</textarea>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group row">
                            <div class="col-12">
                                <label>Telephone</label>
                                <input type="tel" value="{{ request()->route('profile')->telephone }}" name="telephone" class="form-control form-control-lg">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label>Email</label>
                                <input type="email" value="{{ request()->route('profile')->email }}" name="email" class="form-control form-control-lg">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label>Website</label>
                                <input type="text" value="{{ request()->route('profile')->website }}" name="website" class="form-control form-control-lg" value="http://">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label>Address</label>
                                <textarea class="form-control form-control-lg" name="address">{{ request()->route('profile')->address }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-4">
                                <label>Postal Code</label>
                                <input type="text" value="{{ request()->route('profile')->zip }}" name="zip" class="form-control form-control-lg">
                            </div>
                            <div class="col-4">
                                <label>State</label>
                                <input type="text" value="{{ request()->route('profile')->state }}" name="state" class="form-control form-control-lg">
                            </div>
                            <div class="col-4">
                                <label>Country</label>
                                <input type="text" value="{{ request()->route('profile')->country }}" name="country" class="form-control form-control-lg" disabled="">
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
                                <input type="text" value="{{ request()->route('profile')->currency }}" name="currency" class="form-control form-control-lg">
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

                <button class="button" type="submit" name="button">Update</button>
            </form>
            <!-- END Security -->
        </div>
    </div>
</div>
<!-- END Page Content -->
