@extends('layouts.app')

@section('title')
Clients - {{ $client->name }}
@endsection

@section('content')
<div class="row">
    <div class="col-6">
        <a class="btn btn-primary text-center" href="{{ route('lead.new-lead', $client)}}">
            Add Lead
        </a>
        <a class="btn btn-primary text-center" href="{{ route('edit-client', $client) }}">
            Edit Client
        </a>
        @role('Admin')
        <a class="btn btn-primary text-center" href="javascript:void(0)">
            Add Representative
        </a>
        @endrole
    </div>
</div>
<!-- END Quick Actions -->

<!-- User Info -->
<div class="block block-rounded">
    <div class="block-content text-center">
        <div class="py-4">
            <div class="mb-3">
                <img class="img-avatar" src="assets/media/avatars/avatar13.jpg" alt="">
            </div>
            <h1 class="fs-lg mb-0">
                <span>{{ $client->name }}</span>
            </h1>
            <p class="fs-sm fw-medium text-muted">{{ $client->email }}</p>
            <p class="fs-sm fw-medium text-muted">{{ $client->phone }}</p>
        </div>
    </div>
</div>

<!-- Shopping Cart -->
<div class="block block-rounded">
    <div class="block-header block-header-default">
        <h3 class="block-title">Current Leads</h3>
    </div>
    <div class="block-content">
        <div class="table-responsive">
            <table class="table table-borderless table-striped table-vcenter">
                <thead>
                    <tr>
                        <th class="d-none d-md-table-cell">Title</th>
                        <th class="d-none d-md-table-cell">Potential Users</th>
                        <th class="d-none d-sm-table-cell text-center">Potential Revenue</th>
                        <th>Referral</th>
                        <th class="d-none d-sm-table-cell text-end">Name of referrer</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($client->leads as $lead)

                        <tr>
                            <td>{{ $lead->title }}</td>
                            <td>{{ $lead->potential_users }}</td>
                            <td>{{ $lead->revenue }}</td>
                            <td>
                                @if ($lead->is_referral)
                                    <span class="badge rounded-pill bg-success">Yes</span>
                                @else
                                    <span class="badge rounded-pill bg-danger">No</span>
                                @endif
                            </td>
                            <td>
                                @if ($lead->is_referral)
                                    {{ $lead->referrer }}
                                @else
                                    No referral info
                                @endif
                            </td>

                            <td class="text-center fs-sm">

                                <a class="btn btn-sm btn-alt-danger" href="javascript:void(0)" data-bs-toggle="tooltip"
                                    title="Delete">
                                    <i class="fa fa-fw fa-times text-danger"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- END Shopping Cart -->

<!-- Past Orders -->
<div class="block block-rounded">
    <div class="block-header block-header-default">
        <h3 class="block-title">Past Leads</h3>
    </div>
    <div class="block-content">
        <div class="table-responsive">
            <table class="table table-borderless table-striped table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 100px;">ID</th>
                        <th class="d-none d-md-table-cell text-center">Products</th>
                        <th class="d-none d-sm-table-cell text-center">Submitted</th>
                        <th>Status</th>
                        <th class="d-none d-sm-table-cell text-end">Value</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($client->leads as $lead)
                        <tr>
                            <td class="text-center fs-sm">
                                <a class="fw-semibold" href="be_pages_ecom_order.html">
                                    <strong>{{ $lead->title }}</strong>
                                </a>
                            </td>

                            <td class="d-none d-sm-table-cell text-center fs-sm">{{ $lead->created_at }}</td>
                            <td>
                                <span class="badge bg-success">Delivered</span>
                            </td>
                            <td class="text-end d-none d-sm-table-cell fs-sm">
                                <strong>R{{$lead->revenue}}</strong>
                            </td>

                            <td class="text-end d-none d-sm-table-cell fs-sm">
                                <strong>{{$lead->potential_users}}</strong>
                            </td>
                            <td class="text-center fs-sm">
                                <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_product_edit.html"
                                    data-bs-toggle="tooltip" title="View">
                                    <i class="fa fa-fw fa-eye"></i>
                                </a>
                                <a class="btn btn-sm btn-alt-danger" href="javascript:void(0)" data-bs-toggle="tooltip"
                                    title="Delete">
                                    <i class="fa fa-fw fa-times text-danger"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- END Past Orders -->



<!-- Private Notes -->
<div class="block block-rounded">
    <div class="block-header block-header-default">
        <h3 class="block-title">Private Notes</h3>
    </div>
    <div class="block-content">
        <p class="alert alert-dark fs-sm">
            <i class="fa fa-fw fa-info me-1"></i> This note will not be displayed to the customer.
        </p>
        <form action="be_pages_ecom_customer.html" onsubmit="return false;">
            <div class="mb-4">
                <label class="form-label" for="one-ecom-customer-note">Note</label>
                <textarea class="form-control" id="one-ecom-customer-note" name="one-ecom-customer-note" rows="4"
                    placeholder="Update - Set up meeting?"></textarea>
            </div>
            <div class="mb-4">
                <button type="submit" class="btn btn-alt-primary">Add Note</button>
            </div>
        </form>
    </div>
</div>
<!-- END Private Notes -->
@endsection