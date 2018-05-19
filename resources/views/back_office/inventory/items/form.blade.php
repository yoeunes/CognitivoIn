<item-form inline-template>
    <div>
        <!-- User Profile -->
        <form action="be_pages_crypto_settings.html" method="post" onsubmit="return false;">
            <h2 class="content-heading text-black">General</h2>
            <div class="row items-push">
                <div class="col-lg-3">
                    <p class="text-muted">
                        Your account’s vital info. Your nickname will be publicly visible.
                    </p>
                </div>
                <div class="col-lg-7 offset-lg-1">
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="crypto-settings-nickname">SKU or Code</label>
                            <input type="text" class="form-control form-control-lg" id="crypto-settings-nickname" name="crypto-settings-nickname" v-model="sku">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="crypto-settings-email">Name</label>
                            <input type="text" class="form-control form-control-lg" id="crypto-settings-email" name="crypto-settings-email" v-model="name">
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-alt-primary">Update</button>
                        </div>
                    </div> --}}
                </div>
            </div>
        </form>
        <!-- END User Profile -->

        <!-- Personal Details -->
        <form action="be_pages_crypto_settings.html" method="post" onsubmit="return false;">
            <h2 class="content-heading text-black">Commercial</h2>
            <div class="row items-push">
                <div class="col-lg-3">
                    <p class="text-muted">
                        Your personal information is never shown to other users.
                    </p>
                </div>
                <div class="col-lg-7 offset-lg-1">
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="crypto-settings-firstname">Firstname</label>
                            <input type="text" class="form-control form-control-lg" id="crypto-settings-firstname" name="crypto-settings-firstname" value="John" disabled="">
                        </div>
                        <div class="col-6">
                            <label for="crypto-settings-lastname">Lastname</label>
                            <input type="text" class="form-control form-control-lg" id="crypto-settings-lastname" name="crypto-settings-lastname" value="Smith" disabled="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="crypto-settings-street-1">Street Address 1</label>
                            <input type="text" class="form-control form-control-lg" id="crypto-settings-street-1" name="crypto-settings-street-1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="crypto-settings-street-2">Street Address 2</label>
                            <input type="text" class="form-control form-control-lg" id="crypto-settings-street-2" name="crypto-settings-street-2">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="crypto-settings-city">City</label>
                            <input type="text" class="form-control form-control-lg" id="crypto-settings-city" name="crypto-settings-city">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="crypto-settings-postal">Postal code</label>
                            <input type="text" class="form-control form-control-lg" id="crypto-settings-postal" name="crypto-settings-postal">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-alt-primary">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- END Personal Details -->

        <!-- Change Password -->
        <form action="be_pages_crypto_settings.html" method="post" onsubmit="return false;">
            <h2 class="content-heading text-black">Change Password</h2>
            <div class="row items-push">
                <div class="col-lg-3">
                    <p class="text-muted">
                        Changing your sign in password is an easy way to keep your account secure.
                    </p>
                </div>
                <div class="col-lg-7 offset-lg-1">
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="crypto-settings-password">Current Password</label>
                            <input type="password" class="form-control form-control-lg" id="crypto-settings-password" name="crypto-settings-password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="crypto-settings-password-new">New Password</label>
                            <input type="password" class="form-control form-control-lg" id="crypto-settings-password-new" name="crypto-settings-password-new">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="crypto-settings-password-new-confirm">Confirm New Password</label>
                            <input type="password" class="form-control form-control-lg" id="crypto-settings-password-new-confirm" name="crypto-settings-password-new-confirm">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-alt-primary">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- END Change Password -->

        <!-- Security -->
        <form action="be_pages_crypto_settings.html" method="post" onsubmit="return false;">
            <h2 class="content-heading text-black">Security</h2>
            <div class="row items-push">
                <div class="col-lg-3">
                    <p class="text-muted">
                        Keep your account as secure and as private as you like.
                    </p>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="custom-control custom-checkbox mb-5">
                                <input class="custom-control-input" type="checkbox" id="crypto-settings-security-status" name="crypto-settings-security-status" checked="">
                                <label class="custom-control-label" for="crypto-settings-security-status">Online Status</label>
                            </div>
                            <div class="text-muted">Show your status to all</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="custom-control custom-checkbox mb-5">
                                <input class="custom-control-input" type="checkbox" id="crypto-settings-security-verify" name="crypto-settings-security-verify">
                                <label class="custom-control-label" for="crypto-settings-security-verify">Verify on Login</label>
                            </div>
                            <div class="text-muted">Most secure option</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="custom-control custom-checkbox mb-5">
                                <input class="custom-control-input" type="checkbox" id="crypto-settings-security-updates" name="crypto-settings-security-updates" checked="">
                                <label class="custom-control-label" for="crypto-settings-security-updates">Auto Updates</label>
                            </div>
                            <div class="text-muted">Keep app updated</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="custom-control custom-checkbox mb-5">
                                <input class="custom-control-input" id="crypto-settings-security-notifications" name="crypto-settings-security-notifications" type="checkbox" checked="">
                                <label class="custom-control-label" for="crypto-settings-security-notifications">Notifications</label>
                            </div>
                            <div class="text-muted">For every transaction</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="custom-control custom-checkbox mb-5">
                                <input class="custom-control-input" id="crypto-settings-security-api" name="crypto-settings-security-api" type="checkbox" checked="">
                                <label class="custom-control-label" for="crypto-settings-security-api">API Access</label>
                            </div>
                            <div class="text-muted">Enable access from third party apps</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="custom-control custom-checkbox mb-5">
                                <input class="custom-control-input" id="crypto-settings-security-2fa" name="crypto-settings-security-2fa" type="checkbox">
                                <label class="custom-control-label" for="crypto-settings-security-2fa">Two Factor Auth</label>
                            </div>
                            <div class="text-muted">Using an authenticator</div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- END Security -->

        <div class="block block-rounded block-themed">
            <div class="block-header bg-gd-primary">
                <h3 class="block-title">Basic Information</h3>
                <div class="block-options">
                    <button v-on:click="onSave($data,false)" class="btn btn-sm btn-alt-primary">
                        <i class="fa fa-save"></i> @lang('global.Save')
                    </button>
                    <button v-on:click="onSave($data,true)" class="btn btn-sm btn-alt-primary">
                        <i class="fa fa-plus"></i> @lang('global.Save-and-New')
                    </button>
                    <button v-on:click="$parent.cancel()" class="btn btn-sm btn-alt-danger">
                        <i class="fa fa-close"></i> @lang('global.Cancel')
                    </button>
                </div>
            </div>

            <div class="block-content block-content-full">
                <div class="form-group row">
                    <label class="col-12" for="sku">Code</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="sku" name="sku" v-model="sku">
                        <div class="form-text text-muted">Further info about this input</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-12" for="sku">Name</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="name" name="name" v-model="name">
                        <div class="form-text text-muted">Further info about this input</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-12" for="sku">Selling Price</label>
                    <div class="col-md-9">
                        <input type="number" class="form-control" id="unit_price" name="unit_price" v-model="unit_price">
                        <div class="form-text text-muted">Further info about this input</div>
                    </div>

                </div>

                <div class="form-group row">
                    <label class="col-12" for="sku">Vat</label>
                    <div class="col-md-9">
                      <select v-model="vat_id" required class="custom-select" >
                          <option v-for="vat in vats" :value="vat.id">@{{ vat.name }}</option>
                      </select>
                        <div class="form-text text-muted">Further info about this input</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-12" for="example-textarea-input">Short Description</label>
                    <div class="col-9">
                        <textarea class="form-control" id="short_description" name="short_description" v-model="short_description" rows="3"></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-12" for="example-textarea-input">Long Description</label>
                    <div class="col-9">
                        <textarea class="form-control" id="long_description" name="long_description" v-model="long_description" rows="8"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</item-form>
