@extends('layouts.app')
@section('title')
Clients
@endsection

@section('content')
<a class="btn btn-primary text-center" href="{{route('new-client')}}">
            Add Client
        </a>
<div class="row items-push py-4">
  @foreach ($clients as $client)
  <div class="col-md-6 col-lg-4 col-xl-3">  
    <a class="block block-rounded block-link-pop h-100 mb-0" href="{{route('client.show', $client)}}">
      <div class="block-content block-content-full text-center bg-city">
        <div class="item item-2x item-circle bg-white-10 py-3 my-3 mx-auto">
          <i class="fab fa-html5 fa-2x text-white-75"></i>
        </div>
        <!-- <div class="fs-sm text-white-75">
          10 lessons &bull; 3 hours
        </div> -->
      </div>
      <div class="block-content block-content-full">
        <h4 class="h5 mb-1">
          {{ $client->name }}
        </h4>
      </div>
    </a>
  </div>
  @endforeach

</div>
@endsection