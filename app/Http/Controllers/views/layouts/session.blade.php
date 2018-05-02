<li>
    <div class="btn-group">
        <button class="btn btn-default btn-image dropdown-toggle" data-toggle="dropdown" type="button" aria-expanded="false">


            {{-- <img src="" alt="Avatar"> --}}
            {{ Auth::user()->profile->name }}


            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu dropdown-menu-right">

            <li class="dropdown-header">Profile</li>
            <li>
                <a tabindex="-1" href="{{ route('messages') }}">
                    <i class="si si-envelope-open pull-right"></i>
                    <span class="badge badge-primary pull-right">3</span>Inbox
                </a>
            </li>
            <li>
                <a tabindex="-1" href="{{ route('profile.show', Auth::user()->Profile) }}">
                    <i class="si si-user pull-right"></i>
                    Profile
                </a>
            </li>
            <li>
                <a tabindex="-1" href="javascript:void(0)">
                    <i class="si si-settings pull-right"></i>
                    Settings
                </a>
            </li>

            <li class="divider"></li>

            <li class="dropdown-header">
                Company List
            </li>

            @php
            $listOfCompanies = App\Profile::GetProfiles()->get();
            @endphp

            @isset($listOfCompanies)
                @if ($listOfCompanies->count() > 0)
                    @foreach ($listOfCompanies->sortBy('name') as $company)
                        <li>
                            <a href="{{ route('home', $company)}}">
                                @if (request()->route('profile') != null && $company->slug == request()->route('profile')->slug)
                                    <i class="si si-briefcase pull-right"></i> <b>{{ mb_strimwidth($company->name, 0, 20, "...") }}</b>
                                @else
                                    <i class="si si-briefcase pull-right"></i> {{ $company->name }}
                                @endif
                            </a>
                        </li>
                    @endforeach
                @endif
            @endisset
            <li>
                <a href="{{ route('profile.create') }}">
                    <span class="text-primary"><i class="si si-plus pull-right"></i>Create Company</span>
                </a>
            </li>

            <li class="divider"></li>
            <li>
                <a tabindex="-1" href="{{ route('logout') }}">
                    <span class="text-danger"><i class="si si-logout pull-right"></i>Log out</span>
                </a>
            </li>
        </ul>
    </div>

    <li >
        @if (request()->route('profile'))
            <input type="hidden" id="slug" value="{{request()->route('profile')->slug}}"/>
            <input type="hidden" id="slugid" value="{{request()->route('profile')->id}}"/>
        @endif
        <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
        <router-view name="CartCount"></router-view>
    </li>
</li>
