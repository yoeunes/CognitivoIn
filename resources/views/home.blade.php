@extends('layouts.app')

@section('main')

    @php
    $listOfCompanies = App\Profile::GetProfiles()->where('type', 2)->get();
    @endphp

    <a class="dropdown-item" href="{{ route('profile.create') }}">
        <span class="text-primary">
            <i class="si si-plus"></i> Create Company
        </span>
    </a>

    @isset($listOfCompanies)
        @if ($listOfCompanies->count() > 0)
            @foreach ($listOfCompanies->sortBy('alias') as $company)
                <a class="dropdown-item" href="{{ route('home', $company)}}">
                    <i class="si si-briefcase"></i> {{ mb_strimwidth($company->alias, 0, 15, "...") }}
                </a>
            @endforeach
        @endif
    @endisset


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="">
                        <passport-clients></passport-clients>
                        <passport-authorized-clients></passport-authorized-clients>
                        <passport-personal-access-tokens></passport-personal-access-tokens>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
