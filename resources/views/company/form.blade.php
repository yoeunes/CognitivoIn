
@extends('layouts.app')

@section('main')

    <div class="bg-white push-50-t">
        <div class="content content-boxed overflow-hidden">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
                    <div class="push-30-t push-20 animated fadeIn">
                        <!-- Register Title -->
                        <div class="text-center">
                            <img src="/img/cognitivo/logo.svg" width="64" alt="">
                            <h1 class="h3 push-10-t">Create Company Profile</h1>
                        </div>
                        <!-- END Register Title -->

                        <form  action="{{ route('profile.store') }}" method="POST">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="form-material form-material-success">
                                        <input class="form-control" type="text" id="register-username" name="name" placeholder="Please enter a company name">
                                        <label for="register-username">Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="form-material form-material-success">
                                        <input class="form-control" type="text" id="register-username" name="alias" placeholder="Its like a nickname for your company">
                                        <label for="register-username">Alias</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="form-material form-material-success">
                                        <input class="form-control" type="text" id="register-email" name="taxID" placeholder="Unique identification for your company">
                                        <label for="register-email">Tax ID (Government Code)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="form-material form-material-success">
                                        <textarea class="form-control" id="material-textarea-small" name="address" rows="3" placeholder="Where your company at?"></textarea>
                                        {{-- <input class="form-control" type="text" id="register-password" name="register-password" placeholder="Where your company at?"> --}}
                                        <label for="register-password">Address</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                                    <button class="btn btn-block btn-success" type="submit">Create Profile</button>
                                </div>
                            </div>
                            {{-- <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="form-material">
                                        <div class="select2-wrapper">
                                            <select id="single" class="form-control select2-single"  name="country">
                                                <option></option>
                                                @foreach (Countries::all() as $country)
                                                    <option value="{{ $country->cca3 }}">{{ $country->name->common }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- <span class="select2 select2-container select2-container--default select2-container--above" dir="ltr" style="width: 100%;">
                                        <span class="selection">
                                        <span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-val-select22-container">
                                        <span class="select2-selection__rendered" id="select2-val-select22-container">
                                        <span class="select2-selection__placeholder">Choose one..</span>
                                    </span>
                                    <span class="select2-selection__arrow" role="presentation">
                                    <b role="presentation"></b>
                                </span>
                            </span>
                        </span>
                        <span class="dropdown-wrapper" aria-hidden="true"></span>
                    </span>
                    <label for="val-select2">Country</label>--}}
                </div>
            </div>
        </div>
        {{-- <div class="form-group">
            <div class="col-xs-7 col-sm-8">
                <label class="css-input switch switch-sm switch-success">
                    <input type="checkbox" id="register-terms" name="register-terms"><span></span> I Acknowledge Ownership
                </label>
            </div>
            <div class="col-xs-5 col-sm-4">
                <div class="font-s13 text-right push-5-t">
                    <a href="#" data-toggle="modal" data-target="#modal-terms">View Terms</a>
                </div>
            </div>
        </div> --}}
    
    </form>
    <!-- END Register Form -->
</div>
</div>
</div>
</div>
</div>

@endsection
