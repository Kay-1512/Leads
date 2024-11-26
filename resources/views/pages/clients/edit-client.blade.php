@extends('layouts.app')

@section('title') Edit Client - {{ $client->companyName }} @endsection

@section('content')
<div class="row justify-content-center">
    <h2 class="mb-4 text-center">Edit Client: {{ $client->companyName }}</h2>
    <form action="{{ route('client.update', $client) }}" method="POST" class="slim-form-container">
        @csrf
        @method('PUT') <!-- Ensures the form uses the PUT method for updating -->

        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="block block-rounded">
                <div class="block-content block-content-full">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="companyName" name="companyName" placeholder="Company Name" value="{{ old('companyName', $client->name) }}" required>
                                <label for="companyName">Company Name</label>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="contactPerson" name="contactPerson" placeholder="Contact Person" value="{{ old('contactPerson', $client->contact_person->first_name) }}" required>
                                <label for="contactPerson">Contact Person</label>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email', $client->email) }}" required>
                                <label for="email">Email</label>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="{{ old('phone', $client->phone) }}" required>
                                <label for="phone">Phone</label>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">Update Client</button>
            </div>
        </div>
    </form>
</div>

<style>
    .slim-form-container {
        max-width: 600px; 
        width: 100%; 
        margin: 0 auto; 
        padding: 20px;
    }

    .slim-form-container .block {
        border: 1px solid #ddd; 
        border-radius: 8px; 
        padding: 20px; 
    }

    .slim-form-container .form-floating {
        margin-bottom: 1rem; 
    }
</style>
@endsection
