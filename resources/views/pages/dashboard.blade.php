@extends('layouts.app')
@section('title')
Dashboard
@endsection

@section('content')
<div class="owl-carousel counter-carousel owl-theme">
    <div class="item">
        <div class="card border-0 zoom-in bg-primary-subtle shadow-none">
            <div class="card-body">
                <div class="text-center">
                    <img src="{{ asset('assets/images/svgs/icon-user-male.svg') }}" width="50" height="50" class="mb-3"
                        alt="modernize-img" />
                    <p class="fw-semibold fs-3 text-primary mb-1">
                        Users
                    </p>
                    <h5 class="fw-semibold text-primary mb-0">{{ $totalUsers }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="item">
        <div class="card border-0 zoom-in bg-warning-subtle shadow-none">
            <div class="card-body">
                <div class="text-center">
                    <img src="{{ asset('assets/images/svgs/icon-briefcase.svg') }}" width="50" height="50" class="mb-3"
                        alt="modernize-img" />
                    <p class="fw-semibold fs-3 text-warning mb-1">Clients</p>
                    <h5 class="fw-semibold text-warning mb-0">{{ $totalClients }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="item">
        <div class="card border-0 zoom-in bg-info-subtle shadow-none">
            <div class="card-body">
                <div class="text-center">
                    <img src="{{ asset('assets/images/svgs/icon-mailbox.svg') }}" width="50" height="50" class="mb-3"
                        alt="modernize-img" />
                    <p class="fw-semibold fs-3 text-info mb-1">Projects</p>
                    <h5 class="fw-semibold text-info mb-0">{{ $totalProjects }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="item">
        <div class="card border-0 zoom-in bg-danger-subtle shadow-none">
            <div class="card-body">
                <div class="text-center">
                    <img src="{{ asset('assets/images/svgs/icon-wallet.svg') }}" width="50" height="50" class="mb-3"
                        alt="modernize-img" />
                    <p class="fw-semibold fs-3 text-danger mb-1">Revenue</p>
                    <h5 class="fw-semibold text-danger mb-0">R{{ $convertedRevenue }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="item">
        <div class="card border-0 zoom-in bg-success-subtle shadow-none">
            <div class="card-body">
                <div class="text-center">
                    <img src="{{ asset('assets/images/svgs/icon-speech-bubble.svg')}}" width="50" height="50"
                        class="mb-3" alt="modernize-img" />
                    <p class="fw-semibold fs-3 text-success mb-1">Potential</p>
                    <h5 class="fw-semibold text-success mb-0">R{{$potentialRevenue}}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="item">
        <div class="card border-0 zoom-in bg-info-subtle shadow-none">
            <div class="card-body">
                <div class="text-center">
                    <img src="{{ asset('assets/images/svgs/icon-connect.svg')}}" width="50" height="50" class="mb-3"
                        alt="modernize-img" />
                    <p class="fw-semibold fs-3 text-info mb-1">Leads</p>
                    <h5 class="fw-semibold text-info mb-0">{{ $totalLeads }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="float-end">
        <form action="{{ route('dashboard') }}" method="GET" id="filterForm">
            <label for="days">Select Date Range:</label>
            <select name="days" id="days" class="form-select w-auto"
                onchange="document.getElementById('filterForm').submit();">
                <option value="30" {{ $days == 30 ? 'selected' : '' }}>Last 30 Days</option>
                <option value="60" {{ $days == 60 ? 'selected' : '' }}>Last 60 Days</option>
                <option value="90" {{ $days == 90 ? 'selected' : '' }}>Last 90 Days</option>
            </select>
        </form>
    </div>

</div>

<div class="row">

    <div class="col-lg-6 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h4 class="card-title fw-semibold">Revenue by Client</h4>
                    </div>

                </div>
                <div class="row align-items-center">
                    <div class="col">
                        <div id="clientsRevenueChart" class="mx-n6"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h4 class="card-title fw-semibold">Revenue by Consultant</h4>
                    </div>

                </div>
                <div class="row align-items-center">
                    <div class="col">
                        <div id="salespeopleRevenueChart" class="mx-n6"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h4 class="card-title fw-semibold">Lost vs Gained Revenue</h4>
                    </div>

                </div>
                <div class="row align-items-center">
                    <div class="col">
                        <div id="lostGainedRevenueChart" class="mx-n6"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h4 class="card-title fw-semibold">Lost vs Gained Opportunities</h4>
                    </div>

                </div>
                <div class="row align-items-center">
                    <div class="col">
                        <div id="conversionStatusChart" class="mx-n6"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h4 class="card-title fw-semibold">Lead Stages</h4>
                        <p class="card-subtitle mb-0">Lost Oppornities vs Gained Business</p>
                    </div>

                </div>
                <div class="row align-items-center">
                    <div class="col">
                        <div id="leadStagesLineChart" class="mx-n6"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h4 class="card-title fw-semibold">Top Clients</h4>
                    </div>

                </div>
                <div class="row align-items-center">
                    <div class="col">
                        <div class="mx-n6">
                            <ul class="list-group">
                                @foreach ($topConvertedClients as $client => $revenue)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $client }}
                                        <span class="badge bg-primary">R{{ number_format($revenue, 2) }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h4 class="card-title fw-semibold">Leading Consultants</h4>
                    </div>

                </div>
                <div class="row align-items-center">
                    <div class="col">
                        <div class="mx-n6">
                            <ul class="list-group">
                                @foreach ($leadingConsultants as $consultant => $revenue)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $consultant }}
                                        <span class="badge bg-success">R{{ number_format($revenue, 2) }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h4 class="card-title fw-semibold">Revenue Summary</h4>
                    </div>

                </div>
                <div class="row align-items-center">
                    <div class="col">
                        <div class="mx-n6">
                            <div class="mb-4">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong>Gained Revenue:</strong>
                                        <span class="badge bg-success">{{ $gainedRevenue }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong>Lost Revenue:</strong>
                                        <span class="badge bg-danger">{{ $lostRevenue }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h4 class="card-title fw-semibold">Latest Leads</h4>
                    </div>

                </div>
                <div class="row align-items-center">
                    <div class="col">
                        <div class="mx-n6">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Client</th>
                                        <th>Consultant</th>
                                        <th>Product/Service</th>
                                        <th>Current Stage</th>
                                        <th>Status</th>
                                        <th>Revenue</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $row)
                                        <tr>
                                            <td>{{ $row->client_name }}</td>
                                            <td>{{ $row->salesperson }}</td>
                                            <td>{{ $row->lead_title }}</td>
                                            <td>{{ $row->current_stage }}</td>
                                            <td>{{ $row->conversion_status }}</td>
                                            <td>R{{ number_format($row->revenue, 2) }}</td>
                                            <td>
                                                <a href="#" {{-- href="{{ route('leads.show', $row->lead_id) }}" --}}
                                                    class="btn btn-primary btn-sm">
                                                    View Details
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const clientsRevenue = @json(array_values($clientsRevenue));
        const clientLabels = @json(array_keys($clientsRevenue));

        const clientsRevenueOptions = {
            series: [{
                name: 'Converted Revenue',
                data: clientsRevenue
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            xaxis: {
                categories: clientLabels,
                title: {
                    text: 'Clients'
                }
            },
            yaxis: {
                title: {
                    text: 'Revenue'
                },
                labels: {
                    formatter: function (value) {
                        return 'R ' + value.toLocaleString(); // Format with "R" and thousand separators
                    }
                }
            },
            tooltip: {
                y: {
                    formatter: function (value) {
                        return 'R ' + value.toLocaleString(); // Format with "R" and thousand separators
                    }
                }
            },
            colors: ['#008FFB'], // Customize color
            title: {
                text: 'Revenue by Client (Converted Only)',
                align: 'center'
            }
        };

        new ApexCharts(document.querySelector("#clientsRevenueChart"), clientsRevenueOptions).render();

        const salespeopleRevenue = @json(array_values($salespeopleRevenue));
        const salespersonLabels = @json(array_keys($salespeopleRevenue));

        const salespeopleRevenueOptions = {
            series: [{
                name: 'Converted Revenue',
                data: salespeopleRevenue
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            xaxis: {
                categories: salespersonLabels,
                title: {
                    text: 'Consultants'
                }
            },
            yaxis: {
                title: {
                    text: 'Revenue'
                },
                labels: {
                    formatter: function (value) {
                        return 'R ' + value.toLocaleString(); // Format with "R" and thousand separators
                    }
                }
            },
            tooltip: {
                y: {
                    formatter: function (value) {
                        return 'R ' + value.toLocaleString(); // Format with "R" and thousand separators
                    }
                }
            },
            colors: ['#00E396'], // Customize color
            title: {
                text: 'Revenue by Consultant (Converted Only)',
                align: 'center'
            }
        };

        new ApexCharts(document.querySelector("#salespeopleRevenueChart"), salespeopleRevenueOptions).render();

        // Data for Conversion Status Chart
        const conversionStatusData = @json(array_values($conversionStatuses));
        const conversionStatusLabels = @json(array_keys($conversionStatuses));

        const conversionStatusOptions = {
            series: conversionStatusData,
            chart: {
                type: 'pie',
                height: 350
            },
            labels: conversionStatusLabels
        };

        new ApexCharts(document.querySelector("#conversionStatusChart"), conversionStatusOptions).render();

        // Data for Lost vs. Gained Revenue Chart
        const lostGainedRevenueData = [@json($lostRevenue), @json($gainedRevenue)];
        const lostGainedLabels = ['Lost Revenue', 'Gained Revenue'];

        const lostGainedRevenueOptions = {
            series: lostGainedRevenueData,
            chart: {
                type: 'pie',
                height: 350,
            },
            labels: lostGainedLabels,
            colors: ['#FF4560', '#00E396'], // Red for lost revenue, green for gained revenue
            tooltip: {
                y: {
                    formatter: function (value) {
                        return 'R ' + value.toLocaleString(); // Format with "R" and thousand separators
                    }
                }
            },
            title: {
                text: 'Loss vs Gain',
                align: 'center',
            }
        };

        new ApexCharts(document.querySelector("#lostGainedRevenueChart"), lostGainedRevenueOptions).render();

        let series = @json($series);
        let dates = @json($dates);

        // Validate and clean series data
        series = series.map(s => ({
            ...s,
            data: s.data.map(point => (isNaN(point) || point === null ? 0 : point)), // Replace NaN/null with 0
        }));

        // Validate and clean categories (dates)
        dates = dates.filter(date => date !== null && date !== ''); // Ensure no empty/null dates

        if (series.length === 0 || dates.length === 0) {
            console.error('ApexCharts: No valid data found for rendering.');
            return;
        }

        const leadStagesLineChartOptions = {
            series: series,
            chart: {
                type: 'area',
                height: 350,
            },
            xaxis: {
                categories: dates,
                title: {
                    text: 'Date',
                },
            },
            yaxis: {
                title: {
                    text: 'Number of Leads',
                },
            },
            stroke: {
                curve: 'smooth',
            },
            tooltip: {
                shared: true,
                intersect: false,
            },
            title: {
                text: 'Lead Stages Over Time',
                align: 'center',
            },
        };

        new ApexCharts(document.querySelector("#leadStagesLineChart"), leadStagesLineChartOptions).render();
    });
</script>
@endsection