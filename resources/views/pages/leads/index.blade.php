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
                    <td></td>
                    <td>{{ $lead->potential_revenue }}</td>
                    <td></td>
                    <td></td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              </div>
@endsection