@extends('layouts.app')
@section('title')
Clients
@endsection

@section('content')


<div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Clients</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a class="text-muted text-decoration-none" href="{{ route('clients')}}">Clients</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">List</li>
          </ol>
        </nav>
      </div>
      <div class="col-3">
        <div class="text-center mb-n5">
          <img src="{{ asset('assets/images/breadcrumb/ChatBc.png') }}" alt="modernize-img" class="img-fluid mb-n4" />
        </div>
      </div>
    </div>
  </div>
</div>
<div class="action-btn layout-top-spacing mb-7 d-flex align-items-center justify-content-between flex-wrap gap-6">
  <h5 class="mb-0 fs-5">Active Clients</h5>
  <div class="col-md-4">
    <a class="btn btn-primary text-center float-end" href="{{route('new-client')}}">
      Add Client
    </a>
  </div>

</div>

<div class="row">

  @foreach ($clients as $client)
    <div class="col-lg-4 col-xxl-4 col-6">
    <a class="block block-rounded block-link-pop h-100 mb-0" href="{{route('client.show', $client)}}">
      <div class="card text-white" style=" background-color: {{ $client->colour ?? '#28a745' }};">
      <div class="card-body p-4">
        <span>
        <i class="ti ti-archive fs-8"></i>
        </span>
        <h4 class="card-title mt-3 mb-0 text-white">{{ $client->name }}</h4>
        <p class="card-text text-white opacity-75 fs-3 fw-normal">
        {{ $client->leads->count() }} Leads
        </p>
      </div>
      </div>
    </a>
    </div>
  @endforeach

</div>
@endsection