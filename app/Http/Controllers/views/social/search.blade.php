@extends('layouts.web')

@section('content')

    <div class="content bg-gray-lighter">
        <div class="row items-push">
            <div class="col-sm-7">
                <h1 class="page-heading">
                    Search Results
                    <small>Search all of Cognitivo</small>
                </h1>
            </div>
            <div class="col-sm-5 text-right hidden-xs">
                <ol class="breadcrumb push-10-t">
                    <li>Generic</li>
                    <li><a class="link-effect" href="">Search Results</a></li>
                </ol>
            </div>
        </div>
    </div>
    <div class="content">
        <form action="{{ route('search.profiles') }}" method="post">
            {{ csrf_field() }}
            <div class="input-group input-group-lg">
                <input class="form-control" type="text" name="searchText" value="{{ $searchText }}" placeholder="Search application..">
                <div class="input-group-btn">
                    <button class="btn btn-default">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
            <h5 class="push-10">{{ $results->count() }} <span class="h5 font-w400 text-muted">Records Found</span></h5>
        </form>
    </div>
    {{ $results }}
    <div class="content">
        <div class="block">
            @if ($results->where('type', 2)->count() > 0)
                <h2 class="push-10">{{ $results->where('type', 2)->count() }} <span class="h5 font-w400 text-muted">Companies Found</span></h2>
                <table class="table table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 100px;"><i class="si si-user"></i></th>
                            <th>Name</th>
                            <th class="hidden-xs" style="width: 30%;">Email</th>
                            <th class="hidden-xs hidden-sm" style="width: 15%;">Access</th>
                            <th class="text-center" style="width: 80px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results->where('type', 2)->take(10) as $result)
                            <tr>
                                <td class="text-center">
                                    <img class="img-avatar img-avatar48" src="{{ $result->avatar_file_name }}" alt="">
                                </td>
                                <td class="font-w600">
                                    {{ $result->name }}
                                </td>
                                <td class="hidden-xs">{{ $result->email }}</td>
                                <td class="hidden-xs hidden-sm">
                                    <span class="label label-success">{{ $result->created_at }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="" data-original-title="Edit Client"><i class="fa fa-pencil"></i></button>
                                        <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="" data-original-title="Remove Client"><i class="fa fa-times"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            @if ($results->where('type', 1)->count() > 0)
                <h2 class="push-10">{{ $results->where('type', 1)->count() }} <span class="h5 font-w400 text-muted">Users Found</span></h2>
                <table class="table table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 100px;"><i class="si si-user"></i></th>
                            <th>Name</th>
                            <th class="hidden-xs" style="width: 30%;">Email</th>
                            <th class="hidden-xs hidden-sm" style="width: 15%;">Access</th>
                            <th class="text-center" style="width: 80px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results->where('type', 1)->take(10) as $result)
                            <tr>
                                <td class="text-center">
                                    <img class="img-avatar img-avatar48" src="{{ $result->avatar_file_name }}" alt="">
                                </td>
                                <td class="font-w600">{{ $result->name }}</td>
                                <td class="hidden-xs">{{ $result->email }}</td>
                                <td class="hidden-xs hidden-sm">
                                    <span class="label label-success">{{ $result->created_at }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="" data-original-title="Edit Client"><i class="fa fa-pencil"></i></button>
                                        <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="" data-original-title="Remove Client"><i class="fa fa-times"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

@endsection
