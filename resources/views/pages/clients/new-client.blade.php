@extends('layouts.app') 

@section('title') Add Client @endsection

@section('content')
<div class="row justify-content-center">
    <h2 class="mb-4 text-center">Add New Client</h2>
    <form action="{{route('client.store')}}" method="post" class="slim-form-container">
        @csrf
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
                                <input type="text" class="form-control" id="companyName" name="companyName" placeholder="Company Name">
                                <label for="companyName" required>Company Name</label>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="contactPerson" name="contactPerson" placeholder="Contact Person">
                                <label for="contactPerson" required>Contact Person</label>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                <label for="email" required>Email</label>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
                                <label for="phone" required>Phone</label>
                            </div>
                        </div>
                    </div>
                </div>

                
                <button type="submit" class="btn btn-primary w-100">Add Client</button>
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
