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

                        <input type="hidden"  class="form-control" id="example-password-input-floating" name="client_id"
                            value="{{$client->id}}" />

                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" id="title" name="title"
                                placeholder="John Doe">
                            <label for="title"> Title</label>
                        </div>

                        <div class="form-floating mb-4">
                            <select class="form-select" id="example-select-floating" name="is_referral"
                                aria-label="Floating label select example">
                                <option selected>Select an option</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            <label for="example-select-floating">Referral</label>
                        </div>
                        <div class="form-floating mb-4" id="referrerNameDiv" style="display: none;">
                            <input type="text" class="form-control" id="referrer" name="referrer">
                            <label for="referrer">Name of Referrer</label>
                        </div>
                        <div class="form-floating mb-4">
                            <textarea class="form-control" id="description" name="description" style="height: 200px"
                                placeholder="Leave a comment here"></textarea>
                            <label for="description">Description of Lead</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="number" class="form-control" id="potential_users" name="potential_users">
                            <label for="potential_users">Number of users</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="number" class="form-control" id="revenue" name="revenue"
                                placeholder="John Doe">
                            <label for="revenue">Potential Revenue</label>
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