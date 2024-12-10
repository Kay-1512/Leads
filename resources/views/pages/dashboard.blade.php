@extends('layouts.app')
@section('title')
    Dashboard
@endsection

@section('content')
<div class="row">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-vcenter">
            <thead>
                <tr>
                    <th>Name</th>
                    <th style="width: 15%;">Roles</th>
                    <th style="width: 20%;">Number of Conversions</th>
                    <th style="width: 15%;">Number of Users</th>
                    <th style="width: 15%;">Turnover</th>

                    @role('Admin')
                        <th class="text-center" style="width: 100px;">Actions</th>
                    @endrole
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="fw-semibold fs-sm">
                            <a href="be_pages_generic_profile.html">{{ $user->first_name }} {{ $user->last_name }}</a>
                        </td>
                        <td class="fs-sm">{{ $user->getRoleNames()->first() }}</td>
                        
                        <!-- Number of Conversions -->
                        <td>
                            <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-warning-light text-warning">
                                {{ $user->leads->count() }} 
                            </span>
                        </td>
                        
                        <td>{{ $user->leads->count() }}</td>
                        
                        <!-- Turnover -->
                        <td>{{ $user->leads->sum('revenue') }}</td> <!-- Sum of revenue from leads -->
                        
                        @role('Admin')
                            <td class="text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Delete">
                                        <i class="fa fa-fw fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        @endrole
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $users->links() }}
    </div>
</div>
@endsection
