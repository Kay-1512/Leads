@extends('layouts.app')
@section('title')
Leads
@endsection

@section('content')
<div class="row">
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-vcenter">
      <thead>
        <tr>
          <th>Title</th>
          <th>Is Referral</th>
          <th>Referrer</th>
          <th>Revenue</th>
          <th>Potential Users</th>
        </tr>
      </thead>
      <tbody>

        @foreach($leads as $lead)
      <tr>
        <td>{{ $lead->title }}</td>
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
        <td>{{ $lead->revenue }}</td>
        <td>{{ $lead->potential_users }}</td>
      </tr>
    @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection