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
    <div class="block-content bg-body-light text-center">
        <div class="row items-push text-uppercase">
            <div class="col-6 col-md-3">
                <div class="fw-semibold text-dark mb-1">Number of potential users</div>
                <p class="fs-sm fw-medium text-muted">{{ $client->email }}</p>
            </div>
            <div class="col-6 col-md-3">
                <div class="fw-semibold text-dark mb-1">Potential Revenue</div>
                <p class="fs-sm fw-medium text-muted">{{ $client->email }}</p>
            </div>
            <div class="col-6 col-md-3">
                <div class="fw-semibold text-dark mb-1">Referral</div>
                <p class="fs-sm fw-medium text-muted">{{ $client->email }}</p>
            </div>
            <div class="col-6 col-md-3">
                <div class="fw-semibold text-dark mb-1">Name of Referrer</div>
                <p class="fs-sm fw-medium text-muted">{{ $client->email }}</p>
            </div>
        </div>
    </div>
</div>
<!-- Addresses -->
<div class="block block-rounded">
    <div class="block-header block-header-default">
        <h3 class="block-title">Addresses (2)</h3>
    </div>
    <div class="block-content">
        <div class="row">
            <div class="col-lg-6">
                <!-- Billing Address -->
                <div class="block block-rounded block-bordered">
                    <div class="block-header border-bottom">
                        <h3 class="block-title">Billing Address</h3>
                    </div>
                    <div class="block-content">
                        <div class="fs-4 mb-1">John Parker</div>
                        <address class="fs-sm">
                            Sunrise Str 620<br>
                            Melbourne<br>
                            Australia, 11-587<br><br>
                            <i class="fa fa-phone"></i> (999) 888-55555<br>
                            <i class="fa fa-envelope-o"></i> <a href="javascript:void(0)">company@example.com</a>
                        </address>
                    </div>
                </div>
                <!-- END Billing Address -->
            </div>
            <div class="col-lg-6">
                <!-- Shipping Address -->
                <div class="block block-rounded block-bordered">
                    <div class="block-header border-bottom">
                        <h3 class="block-title">Shipping Address</h3>
                    </div>
                    <div class="block-content">
                        <div class="fs-4 mb-1">John Parker</div>
                        <address class="fs-sm">
                            Sunrise Str 620<br>
                            Melbourne<br>
                            Australia, 11-587<br><br>
                            <i class="fa fa-phone"></i> (999) 888-55555<br>
                            <i class="fa fa-envelope-o"></i> <a href="javascript:void(0)">company@example.com</a>
                        </address>
                    </div>
                </div>
                <!-- END Shipping Address -->
            </div>
        </div>
    </div>
</div>
<!-- END Addresses -->

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
                        <th class="text-center" style="width: 100px;">  </th>
                        <th class="d-none d-md-table-cell">Product</th>
                        <th class="d-none d-sm-table-cell text-center">Added</th>
                        <th>Status</th>
                        <th class="d-none d-sm-table-cell text-end">Value</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center fs-sm">
                            <a class="fw-semibold" href="be_pages_ecom_product_edit.html">
                                <strong>PID.0154</strong>
                            </a>
                        </td>
                        <td class="d-none d-md-table-cell fs-sm">
                            <a href="be_pages_ecom_product_edit.html">Product #4</a>
                        </td>
                        <td class="d-none d-sm-table-cell text-center fs-sm">27/05/2024</td>
                        <td>
                            <span class="badge bg-danger">Out of Stock</span>
                        </td>
                        <td class="text-end d-none d-sm-table-cell fs-sm">
                            <strong>$63,00</strong>
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
                    <tr>
                        <td class="text-center fs-sm">
                            <a class="fw-semibold" href="be_pages_ecom_product_edit.html">
                                <strong>PID.0153</strong>
                            </a>
                        </td>
                        <td class="d-none d-md-table-cell fs-sm">
                            <a href="be_pages_ecom_product_edit.html">Product #3</a>
                        </td>
                        <td class="d-none d-sm-table-cell text-center fs-sm">21/10/2024</td>
                        <td>
                            <span class="badge bg-success">Available</span>
                        </td>
                        <td class="text-end d-none d-sm-table-cell fs-sm">
                            <strong>$16,00</strong>
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
                    <tr>
                        <td class="text-center fs-sm">
                            <a class="fw-semibold" href="be_pages_ecom_product_edit.html">
                                <strong>PID.0152</strong>
                            </a>
                        </td>
                        <td class="d-none d-md-table-cell fs-sm">
                            <a href="be_pages_ecom_product_edit.html">Product #2</a>
                        </td>
                        <td class="d-none d-sm-table-cell text-center fs-sm">02/05/2024</td>
                        <td>
                            <span class="badge bg-success">Available</span>
                        </td>
                        <td class="text-end d-none d-sm-table-cell fs-sm">
                            <strong>$76,00</strong>
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
                    <tr>
                        <td class="text-center fs-sm">
                            <a class="fw-semibold" href="be_pages_ecom_product_edit.html">
                                <strong>PID.0151</strong>
                            </a>
                        </td>
                        <td class="d-none d-md-table-cell fs-sm">
                            <a href="be_pages_ecom_product_edit.html">Product #1</a>
                        </td>
                        <td class="d-none d-sm-table-cell text-center fs-sm">03/03/2024</td>
                        <td>
                            <span class="badge bg-success">Available</span>
                        </td>
                        <td class="text-end d-none d-sm-table-cell fs-sm">
                            <strong>$70,00</strong>
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





