@section('scripts')
    <script src='https://www.google.com/recaptcha/api.js'></script>
@endsection

@extends('layouts.app')

@section('main')
    <div class="bg-image" style="background-image: url('assets/img/photos/photo34@2x.jpg');">
        <div class="row mx-0 bg-earth-op">
            <div class="hero-static col-md-6 col-xl-8 d-none d-md-flex align-items-md-end">
                <div class="p-30 invisible" data-toggle="appear">
                    <p class="font-size-h3 font-w600 text-white">
                        We're very happy you are joining our community!
                    </p>
                    <p class="font-italic text-white-op">
                        Copyright &copy; <span class="js-year-copy"></span>
                    </p>
                </div>
            </div>
            <div class="hero-static col-md-6 col-xl-4 d-flex align-items-center bg-white invisible" data-toggle="appear" data-class="animated fadeInRight">
                <div class="content content-full">
                    <!-- Header -->
                    <div class="px-30 py-10">
                        <a class="link-effect font-w700" href="/">
                            <img src="/img/logo/cognitivo-64.svg" alt="" width="64">
                        </a>
                        <h1 class="h3 font-w700 mt-30 mb-10">{{ __('Register') }}</h1>
                        {{-- <h2 class="h5 font-w400 text-muted mb-0">Please sign in</h2> --}}
                    </div>
                    <!-- END Header -->

                    <!-- Sign In Form -->
                    <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.js) -->
                    <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                    <form class="js-validation-signin px-30" action="{{ route('register') }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="form-material floating">
                                    <input type="text" class="form-control" id="name" name="name">
                                    <label for="name">{{ __('Name') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="form-material floating">
                                    <input type="email" class="form-control" id="email" name="email">
                                    <label for="email">{{ __('Email') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="form-material floating">
                                    <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" required>
                                    <label for="password">{{ __('Password') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="form-material floating">
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                    <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                                </div>
                            </div>
                        </div>

                        <br/>
                        <br/>

                        <div class="form-group row">
                            <div class="col-12">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="signup-terms" name="signup-terms">
                                    <label class="custom-control-label" for="signup-terms">I agree to Terms &amp; Conditions</label>
                                </div>
                                @if ($errors->has('signup-terms'))
                                    <div id="val-currency-error" class="invalid-feedback animated fadeInDown">
                                        {{ $errors->first('signup-terms') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="g-recaptcha" data-sitekey="6LdtgV4UAAAAAGH53fzq326PImq4ggJfiOGneCbG"></div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-hero">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                    <!-- END Sign In Form -->
                </div>
            </div>
        </div>
    </div>
@endsection
