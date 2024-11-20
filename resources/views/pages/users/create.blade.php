@extends('layouts.app')
@section('title')
Add User
@endsection

@section('content')
<div class="row">
  <h2 class="mb-4 text-center">Add New User</h2>
  <form action="{{ route('user.store') }}" method="post">
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
      <!-- First Name -->
      <div class="col-md-6 mb-3">
        <label for="firstName" class="form-label">First Name</label>
        <input type="text" class="form-control" id="firstName" name="first_name" placeholder="Enter first name">
      </div>

      <!-- Last Name -->
      <div class="col-md-6 mb-3">
        <label for="lastName" class="form-label">Last Name</label>
        <input type="text" class="form-control" id="lastName" name="last_name" placeholder="Enter last name">
      </div>
    </div>

    <!-- Email -->
    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
      </div>


      <div class="col-md-6 mb-3">
        <label for="role" class="form-label">Role</label>
        <select name="role" class="form-control">
          @foreach ($roles as $role)
        <option id="{{ $role->name }}">{{ $role->name }}</option>
      @endforeach
        </select>
      </div>
    </div>

    <div class="row">
      <!-- Password -->
      <div class="col-md-6 mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
      </div>

      <!-- Confirm Password -->
      <div class="col-md-6 mb-3">
        <label for="confirmPassword" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="confirmPassword" name="password_confirmation"
          placeholder="Confirm password">
      </div>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary w-100">Add User</button>
  </form>
</div>
@endsection