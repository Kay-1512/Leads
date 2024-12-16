@extends('layouts.app')

@section('title')
Edit Client - {{ $client->name }}
@endsection

@section('content')
<div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
    <div class="card-body px-4 py-3">
        <div class="row align-items-center">
            <div class="col-9">
                <h4 class="fw-semibold mb-8">Edit {{ $client->name }}</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a class="text-muted text-decoration-none" href="{{ route('clients') }}">Clients</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
            <div class="col-3">
                <div class="text-center mb-n5">
                    <img src="{{ asset('assets/images/breadcrumb/ChatBc.png') }}" alt="{{ $client->name }}"
                        class="img-fluid mb-n4" />
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{ route('client.update', $client) }}" method="POST">
                    @csrf
                    @method('PUT') 
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="tb-fname" name="companyName"
                                    value="{{ old('name', $client->name) }}">
                                <label for="tb-fname">Name</label>
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="tb-email"
                                    value="{{ old('contactPerson', $client->contact_person->first_name) }}"
                                    name="contact_person_id">
                                <label for="tb-email">Contact Person</label>
                            </div>
                        </div> --}}
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="tb-pwd" name="email"
                                    value="{{ old('email', $client->email) }}">
                                <label for="tb-pwd">Email</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="tb-cpwd"
                                    value="{{ old('phone', $client->phone) }}" name="phone">
                                <label for="tb-cpwd">Phone</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-md-flex align-items-center">

                                <div class="ms-auto mt-3 mt-md-0">
                                    <button type="submit" class="btn btn-primary hstack gap-6">
                                        <i class="ti ti-send fs-4"></i>
                                        Update
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection