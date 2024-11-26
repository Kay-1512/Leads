@extends('layouts.app')

@section('title')
Clients - {{ $client->name }}
@endsection

@section('content')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
<style>
    .kanban-board {
        display: flex;
        gap: 16px;
        justify-content: center;
    }

    .kanban-column {
        background-color: #f3f3f3;
        border-radius: 8px;
        padding: 16px;
        width: 300px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .kanban-column h3 {
        margin-bottom: 16px;
        text-align: center;
        color: #333;
    }

    .kanban-card {
        background-color: #ffffff;
        border-radius: 8px;
        padding: 12px;
        margin-bottom: 12px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        cursor: grab;
    }
</style>

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
        <div x-data="kanbanBoard" x-init="initializeBoard()" class="kanban-board">
            <template x-for="stage in stages" :key="stage . id">
                <div class="kanban-column">
                    <!-- Stage Title -->
                    <h3 x-text="stage.title" class="text-xl font-bold text-center text-gray-800"></h3>
                    <!-- Leads within the Stage -->
                    <div :id="'stage-' + stage . id" class="kanban-cards" x-data="sortable(stage.id)"
                        x-init="initSortable()">
                        <template x-for="lead in stage.leads" :key="lead . id">
                            <div class="kanban-card" :data-id="lead.id">
                                <!-- Lead Title -->
                                <h4 x-text="lead.title" class="font-semibold"></h4>
                                <!-- Lead Description -->
                                <p x-text="lead.description" class="text-sm text-gray-600"></p>
                            </div>
                        </template>
                    </div>
                </div>
            </template>
        </div>
        <!-- <div class="table-responsive">
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
        </div> -->
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

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('kanbanBoard', () => ({
            stages: [],

            async initializeBoard() {
                // Fetch stages and leads from the backend
                const response = await fetch('/api/leads');
                this.stages = await response.json();
            },

            async updateOrder(leadUpdates) {
                // Send updates to the backend
                await fetch('/lead/stage/update', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ leads: leadUpdates }),
                });
            },
        }));

        Alpine.data('sortable', (stageId) => ({
            stageId,

            initSortable() {
                const container = document.getElementById(`stage-${this.stageId}`);
                new Sortable(container, {
                    group: {
                        name: 'kanban',
                        pull: true,
                        put: true,
                    },
                    animation: 150,
                    onEnd: (evt) => {
                        const updatedLeads = Array.from(evt.to.children).map((child, index) => ({
                            id: child.dataset.id,
                            lead_stage_id: evt.to.id.split('-')[1], // Extract stage ID from container ID
                            order: index,
                        }));

                        console.log('Updated Leads:', updatedLeads);

                        // Update the backend
                        document.querySelector('[x-data="kanbanBoard"]').__x.$data.updateOrder(updatedLeads);
                    },
                });
            },
        }));
    });
</script>
@endsection