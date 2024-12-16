@extends('layouts.app') 

@section('title') Add Client @endsection

@section('content')
<link rel="stylesheet" href="{{ asset('assets/libs/@claviska/jquery-minicolors/jquery.minicolors.css') }}">

<div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
    <div class="card-body px-4 py-3">
        <div class="row align-items-center">
            <div class="col-9">
                <h4 class="fw-semibold mb-8">Create Client</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a class="text-muted text-decoration-none" href="{{ route('clients') }}">Clients</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
            <div class="col-3">
                <div class="text-center mb-n5">
                    <img src="{{ asset('assets/images/breadcrumb/ChatBc.png') }}" alt="Create Client"
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
                <form action="{{route('client.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <input type="hidden" class="form-control" id="tb-email" name="sales_person_id"
                            value="{{ auth()->user()->id }}">

                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="tb-fname" name="name">
                                <label for="tb-fname">Name</label>
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="tb-email"
                                    value="{{ old('contactPerson', $client->contact_person->first_name) }}"
                                    name="representative_id">
                                <label for="tb-email">Contact Person</label>
                            </div>
                        </div> --}}



                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="tb-pwd" name="email">
                                <label for="tb-pwd">Email</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="tb-cpwd" name="phone">
                                <label for="tb-cpwd">Phone</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="tb-cpwd">Colour</label>

                            <div class="form-floating mb-3">
                                <input type="text" id="hue-demo" class="form-control demo" data-control="hue"
                                    name="colour" value="#ff6161" />

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select name="province_id" class="form-control" id="tb-cpwd">
                                    <option>Select Province</option>
                                    @foreach ($provinces as $province)
                                        <option value="{{$province->id}}">{{$province->name}}</option>
                                    @endforeach
                                </select>
                                <label for="tb-cpwd">Province</label>

                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-md-flex align-items-center">

                                <div class="ms-auto mt-3 mt-md-0">
                                    <button type="submit" class="btn btn-primary hstack gap-6">
                                        <i class="ti ti-send fs-4"></i>
                                        Add Client
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/libs/@claviska/jquery-minicolors/jquery.minicolors.min.js') }}"></script>
    <script>
        $(".demo").each(function () {
            $(this).minicolors({
                control: $(this).attr("data-control") || "hue",
                defaultValue: $(this).attr("data-defaultValue") || "",
                format: $(this).attr("data-format") || "hex",
                keywords: $(this).attr("data-keywords") || "",
                inline: $(this).attr("data-inline") === "true",
                letterCase: $(this).attr("data-letterCase") || "lowercase",
                opacity: $(this).attr("data-opacity"),
                position: $(this).attr("data-position") || "bottom left",
                swatches: $(this).attr("data-swatches")
                    ? $(this).attr("data-swatches").split("|")
                    : [],
                change: function (value, opacity) {
                    if (!value) return;
                    if (opacity) value += ", " + opacity;
                    if (typeof console === "object") {
                        console.log(value);
                    }
                },
                theme: "bootstrap",
            });
        });
    </script>
    @endsection