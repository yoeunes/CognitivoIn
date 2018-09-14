@extends('layouts.app')

@section('main')

    @php
    $listOfCompanies = Auth::user()->profile->followings(App\Profile::class)->where('role', '<', 4)->get();
    @endphp

    <a class="dropdown-item" href="/profile/create">
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

<div class="">
    <passport-clients></passport-clients>
    <passport-authorized-clients></passport-authorized-clients>
    <passport-personal-access-tokens></passport-personal-access-tokens>
</div>


    @include('profile.setting')

@endsection
