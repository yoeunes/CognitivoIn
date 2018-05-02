
@extends('layouts.form')

@section('content')
    <div class="block">
        <div class="block-content">
            <form class="form-horizontal push-30-t push-30" action="{{ route('members.store', request()->route('profile')) }}" method="post" >
                {{ csrf_field() }}

                <select required id="dropDown" required name="followable_id" >
                    <option>Select a Member</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                    @endforeach
                </select>
                <select required id="dropDown" required name="role_id" >
                    <option>Select a Role</option>
                    <option value="1">Admin</option>
                    <option value="2">Manager</option>
                    <option value="3">Employee</option>
                    <option value="4">Member</option>
                </select>
                <button class="btn btn-primary" type="submit">Save</button>
            </form>
        </div>
    </div>
    <div class="block-content">
        <table class="table table-borderless table-striped table-vcenter">
            <thead>
                <tr>
                    <th class="text-center">Member List</th>
                    <th class="text-center">Role</th>
                    {{-- <th class="text-center">Actions</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($profile_followers as $member)
                    <tr>
                        <td class="hidden-xs text-center">{{$member->name}}</td>
                        <td class="hidden-xs text-center">
                            @if ($member->role == 1)
                                Administrator
                            @elseif ($member->role == 2)
                                Manager
                            @elseif ($member->role == 3)
                                Employee
                            @elseif ($member->role == 4)
                                Member
                            @endif
                        </td>
                        {{-- <td>
                            <form class="form-horizontal push-30-t push-30" action="{{ route('members.destroy', [request()->route('profile'),$member]) }}" method="post" >
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <a>
                                <button class="btn btn-primary" type="submit">Delete</button>
                                </a>
                            </form>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('javascript')
    <script src="/js/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/js/pages/base_tables_datatables.js"></script>
@endsection
