@extends('layouts.app') 
@section('title')
 Add Lead
 @endsection

@section('content')
<div class="row">
    <h2 class="mb-4 text-center">Add New Lead</h2>
    <form action="{{ route('lead.store') }}" method="post">
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

                        <input type="hidden" class="form-control" id="example-password-input-floating" name="client_id"
                            value="{{$client->id}}" />

                        <div class="form-floating mb-4">
                            <select class="form-select" id="example-select-floating" name="example-select-floating"
                                aria-label="Floating label select example">
                                <option selected>Select an option</option>
                                <option value="1">Yes</option>
                                <option value="2">No</option>
                            </select>
                            <label for="example-select-floating">Referral</label>
                        </div>
                        <div class="form-floating mb-4" id="referrerNameDiv" style="display: none;">
                            <input type="text" class="form-control" id="referrerName" name="referrerName"
                                placeholder="Referrer Name">
                            <label for="referrerName">Name of Referrer</label>
                        </div>
                        <div class="form-floating mb-4">
                            <textarea class="form-control" id="Description"
                                name="Description" style="height: 200px"
                                placeholder="Leave a comment here"></textarea>
                            <label for="Description">Description of Lead</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" id="contactPerson" name="contactPerson"
                                placeholder="John Doe">
                            <label for="contactPerson">Number of users</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" id="contactPerson" name="contactPerson"
                                placeholder="John Doe">
                            <label for="contactPerson">Potential Revenue</label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Add Lead</button>
                    </div>
                </div>

                <!-- Submit Button -->

            </div>
    </form>
    
</div>

<!-- JavaScript for dynamic field visibility -->
<script>
    // Function to toggle the Referrer Name field
    document.getElementById('example-select-floating').addEventListener('change', function () {
        var referrerNameDiv = document.getElementById('referrerNameDiv');
        if (this.value == '1') { // If "Yes" is selected
            referrerNameDiv.style.display = 'block';
        } else { // If "No" is selected
            referrerNameDiv.style.display = 'none';
        }
    });
</script>

@endsection