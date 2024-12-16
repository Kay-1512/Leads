@extends('layouts.app')

@section('title')
Clients - {{ $client->name }}
@endsection

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.3/dragula.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.3/dragula.min.js"></script>

<style>
    /* Sticky Notes Container */
    #sticky-notes-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 20px;
    }

    /* Visual feedback for drop areas */
    .gu-mirror {
        position: fixed !important;
        z-index: 9999 !important;
        opacity: 0.8;
    }

    /* Sticky Note Styling */
    .sticky-note {
        background-color: #fdfd96;
        /* Classic sticky note yellow */
        width: 220px;
        min-height: 150px;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 4px 4px 6px rgba(0, 0, 0, 0.2);
        font-family: 'Comic Sans MS', sans-serif;
        /* Playful font for sticky notes */
        color: #333;
        position: relative;
        transform: rotate(-2deg);
        /* Slight tilt for a casual look */
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    /* Slight Hover Effect */
    .sticky-note:hover {
        transform: rotate(0deg) scale(1.05);
        /* Straighten and enlarge slightly */
        box-shadow: 6px 6px 8px rgba(0, 0, 0, 0.3);
    }

    /* Sticky Note Title */
    .sticky-note h5 {
        font-size: 16px;
        margin-bottom: 10px;
        text-align: center;
        font-weight: bold;
        text-transform: uppercase;
        color: #555;
    }

    /* Sticky Note Text */
    .sticky-note p {
        font-size: 14px;
        margin: 0;
        line-height: 1.4;
        word-wrap: break-word;
    }

    /* Delete Button */
    .sticky-note .delete-note {
        position: absolute;
        top: 8px;
        right: 8px;
        font-size: 20px;
        color: #d9534f;
        cursor: pointer;
        transition: color 0.2s;
    }

    .sticky-note .delete-note:hover {
        color: #c9302c;
    }

    /* Optional Variants for Colors */
    .sticky-note.blue {
        background-color: #a2d5f2;
        /* Light blue */
    }

    .sticky-note.green {
        background-color: #b2f2a2;
        /* Light green */
    }

    .sticky-note.pink {
        background-color: #f2a2c2;
        /* Light pink */
    }
</style>

<div class="card overflow-hidden">
    <div class="card-body p-0">
        <img src="../assets/images/backgrounds/profilebg.jpg" alt="modernize-img" class="img-fluid">
        <div class="row align-items-center">
            <div class="col-lg-4 order-lg-1 order-2">
                <div class="d-flex align-items-center justify-content-around m-4">
                    <div class="text-center">
                        <i class="ti ti-file-description fs-6 d-block mb-2"></i>
                        <h4 class="mb-0 lh-1">{{ $client->leads->count() }}</h4>
                        <p class="mb-0 ">Leads</p>
                    </div>
                    <div class="text-center">
                        <i class="ti ti-user-circle fs-6 d-block mb-2"></i>
                        <h4 class="mb-0 lh-1">0</h4>
                        <p class="mb-0 ">Projects</p>
                    </div>
                    <!-- <div class="text-center">
                      <i class="ti ti-user-check fs-6 d-block mb-2"></i>
                      <h4 class="mb-0 lh-1">2,659</h4>
                      <p class="mb-0 ">Following</p>
                    </div> -->
                </div>
            </div>
            <div class="col-lg-4 mt-n3 order-lg-2 order-1">
                <div class="mt-n5">
                    <div class="d-flex align-items-center justify-content-center mb-2">
                        <div class="d-flex align-items-center justify-content-center round-110">
                            <div
                                class="border border-4 border-white d-flex align-items-center justify-content-center rounded-circle overflow-hidden round-100">
                                <img src="../assets/images/profile/user-1.jpg" alt="modernize-img" class="w-100 h-100">
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <h5 class="mb-0">{{ $client->name }}</h5>
                        <p class="mb-0">{{ $client->email }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 order-last">
                <ul
                    class="list-unstyled d-flex align-items-center justify-content-center justify-content-lg-end my-3 mx-4 pe-xxl-4 gap-3">
                    <li>
                        <a class="btn btn-primary text-center" href="{{ route('lead.new-lead', $client)}}">
                            Add Lead
                        </a>
                    </li>
                    @role('Admin')
                    <li>
                        <a class="btn btn-primary text-center" href="{{ route('edit-client', $client) }}">
                            Edit Client
                        </a>
                    </li>
                    <li>
                        <a class="btn btn-primary text-center" href="javascript:void(0)">
                            Add Representative
                        </a>
                    </li>
                    @endrole
                </ul>
            </div>
        </div>
        <ul class="nav nav-pills user-profile-tab justify-content-end mt-2 bg-primary-subtle rounded-2 rounded-top-0"
            id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active hstack gap-2 rounded-0 py-6" id="pills-leads-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-leads" type="button" role="tab" aria-controls="pills-leads"
                    aria-selected="true">
                    <i class="ti ti-user-circle fs-5"></i>
                    <span class="d-none d-md-block">Leads</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link hstack gap-2 rounded-0 py-6" id="pills-notes-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-notes" type="button" role="tab" aria-controls="pills-notes"
                    aria-selected="false">
                    <i class="ti ti-notes fs-5"></i>
                    <span class="d-none d-md-block">Notes</span>
                </button>
            </li>
            <!-- <li class="nav-item" role="presentation">
                  <button class="nav-link hstack gap-2 rounded-0 py-6" id="pills-friends-tab" data-bs-toggle="pill" data-bs-target="#pills-friends" type="button" role="tab" aria-controls="pills-friends" aria-selected="false">
                    <i class="ti ti-user-circle fs-5"></i>
                    <span class="d-none d-md-block">Friends</span>
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link hstack gap-2 rounded-0 py-6" id="pills-gallery-tab" data-bs-toggle="pill" data-bs-target="#pills-gallery" type="button" role="tab" aria-controls="pills-gallery" aria-selected="false">
                    <i class="ti ti-photo-plus fs-5"></i>
                    <span class="d-none d-md-block">Gallery</span>
                  </button>
                </li> -->
        </ul>
    </div>
</div>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-leads" role="tabpanel" aria-labelledby="pills-leads-tab"
        tabindex="0">
        <div class="block block-rounded">
            <div id="kanban-board" class="kanban-board">
                <!-- Columns will be dynamically rendered here -->
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="pills-noted" role="tabpanel" aria-labelledby="pills-notes-tab" tabindex="0">

        <div id="note-full-container" class="note-has-grid row">
            @foreach ($client->notes as $note)
                <div class="col-md-4 single-note-item all-category" style="">
                    <div class="card card-body">
                        <span class="side-stick"></span>
                        <h6 class="note-title text-truncate w-75 mb-0" data-noteheading="{{ $note->title }}">
                            {{ $note->title }}
                        </h6>
                        <p class="note-date fs-2">{{ $note->created_at }}/p>
                        <div class="note-content">
                            <p class="note-inner-content" data-notecontent="{{ $note->content }}">
                                {{ $note->content }}
                            </p>
                        </div>
                        <div class="d-flex align-items-center">
                            <a href="javascript:void(0)" class="link me-1">
                                <i class="ti ti-star fs-4 favourite-note"></i>
                            </a>
                            <a href="javascript:void(0)" class="link text-danger ms-2">
                                <i class="ti ti-trash fs-4 remove-note"></i>
                            </a>
                            <div class="ms-auto">
                                <div class="category-selector btn-group">
                                    <a class="nav-link category-dropdown label-group p-0" data-bs-toggle="dropdown"
                                        href="javascript:void(0)" role="button" aria-haspopup="true" aria-expanded="false">
                                        <div class="category">
                                            <div class="category-business"></div>
                                            <div class="category-social"></div>
                                            <div class="category-important"></div>
                                            <span class="more-options text-dark">
                                                <i class="ti ti-dots-vertical fs-5"></i>
                                            </span>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right category-menu" style="">
                                        <a class="
                                                                                      note-business
                                                                                      badge-group-item badge-business
                                                                                      dropdown-item
                                                                                      position-relative
                                                                                      category-business
                                                                                      d-flex
                                                                                      align-items-center
                                                                                    "
                                            href="javascript:void(0);">Business</a>
                                        <a class="
                                                                                      note-social
                                                                                      badge-group-item badge-social
                                                                                      dropdown-item
                                                                                      position-relative
                                                                                      category-social
                                                                                      d-flex
                                                                                      align-items-center
                                                                                    " href="javascript:void(0);">
                                            Social</a>
                                        <a class="
                                                                                      note-important
                                                                                      badge-group-item badge-important
                                                                                      dropdown-item
                                                                                      position-relative
                                                                                      category-important
                                                                                      d-flex
                                                                                      align-items-center
                                                                                    " href="javascript:void(0);">
                                            Important</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- <div class="tab-pane fade" id="pills-friends" role="tabpanel" aria-labelledby="pills-friends-tab" tabindex="0">
              <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-4">
                <h3 class="mb-3 mb-sm-0 fw-semibold d-flex align-items-center">Friends <span class="badge text-bg-secondary fs-2 rounded-4 py-1 px-2 ms-2">20</span>
                </h3>
                <form class="position-relative">
                  <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh" placeholder="Search Friends">
                  <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y text-dark ms-3"></i>
                </form>
              </div>
              <div class="row">
                <div class="col-sm-6 col-lg-4">
                  <div class="card hover-img">
                    <div class="card-body p-4 text-center border-bottom">
                      <img src="../assets/images/profile/user-1.jpg" alt="modernize-img" class="rounded-circle mb-3" width="80" height="80">
                      <h5 class="fw-semibold mb-0">Betty Adams</h5>
                      <span class="text-dark fs-2">Medical Secretary</span>
                    </div>
                    <ul class="px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0">
                      <li class="position-relative">
                        <a class="text-primary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold" href="javascript:void(0)">
                          <i class="ti ti-brand-facebook"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-danger d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-instagram"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-info d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-github"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-secondary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-twitter"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                  <div class="card hover-img">
                    <div class="card-body p-4 text-center border-bottom">
                      <img src="../assets/images/profile/user-2.jpg" alt="modernize-img" class="rounded-circle mb-3" width="80" height="80">
                      <h5 class="fw-semibold mb-0">Inez Lyons</h5>
                      <span class="text-dark fs-2">Medical Technician</span>
                    </div>
                    <ul class="px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0">
                      <li class="position-relative">
                        <a class="text-primary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold" href="javascript:void(0)">
                          <i class="ti ti-brand-facebook"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-danger d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-instagram"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-info d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-github"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-secondary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-twitter"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                  <div class="card hover-img">
                    <div class="card-body p-4 text-center border-bottom">
                      <img src="../assets/images/profile/user-3.jpg" alt="modernize-img" class="rounded-circle mb-3" width="80" height="80">
                      <h5 class="fw-semibold mb-0">Lydia Bryan</h5>
                      <span class="text-dark fs-2">Preschool Teacher</span>
                    </div>
                    <ul class="px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0">
                      <li class="position-relative">
                        <a class="text-primary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold" href="javascript:void(0)">
                          <i class="ti ti-brand-facebook"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-danger d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-instagram"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-info d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-github"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-secondary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-twitter"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                  <div class="card hover-img">
                    <div class="card-body p-4 text-center border-bottom">
                      <img src="../assets/images/profile/user-4.jpg" alt="modernize-img" class="rounded-circle mb-3" width="80" height="80">
                      <h5 class="fw-semibold mb-0">Carolyn Bryant</h5>
                      <span class="text-dark fs-2">Legal Secretary</span>
                    </div>
                    <ul class="px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0">
                      <li class="position-relative">
                        <a class="text-primary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold" href="javascript:void(0)">
                          <i class="ti ti-brand-facebook"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-danger d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-instagram"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-info d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-github"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-secondary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-twitter"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                  <div class="card hover-img">
                    <div class="card-body p-4 text-center border-bottom">
                      <img src="../assets/images/profile/user-5.jpg" alt="modernize-img" class="rounded-circle mb-3" width="80" height="80">
                      <h5 class="fw-semibold mb-0">Paul Benson</h5>
                      <span class="text-dark fs-2">Safety Engineer</span>
                    </div>
                    <ul class="px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0">
                      <li class="position-relative">
                        <a class="text-primary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold" href="javascript:void(0)">
                          <i class="ti ti-brand-facebook"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-danger d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-instagram"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-info d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-github"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-secondary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-twitter"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                  <div class="card hover-img">
                    <div class="card-body p-4 text-center border-bottom">
                      <img src="../assets/images/profile/user-6.jpg" alt="modernize-img" class="rounded-circle mb-3" width="80" height="80">
                      <h5 class="fw-semibold mb-0">Robert Francis</h5>
                      <span class="text-dark fs-2">Nursing Administrator</span>
                    </div>
                    <ul class="px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0">
                      <li class="position-relative">
                        <a class="text-primary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold" href="javascript:void(0)">
                          <i class="ti ti-brand-facebook"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-danger d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-instagram"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-info d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-github"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-secondary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-twitter"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                  <div class="card hover-img">
                    <div class="card-body p-4 text-center border-bottom">
                      <img src="../assets/images/profile/user-7.jpg" alt="modernize-img" class="rounded-circle mb-3" width="80" height="80">
                      <h5 class="fw-semibold mb-0">Billy Rogers</h5>
                      <span class="text-dark fs-2">Legal Secretary</span>
                    </div>
                    <ul class="px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0">
                      <li class="position-relative">
                        <a class="text-primary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold" href="javascript:void(0)">
                          <i class="ti ti-brand-facebook"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-danger d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-instagram"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-info d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-github"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-secondary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-twitter"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                  <div class="card hover-img">
                    <div class="card-body p-4 text-center border-bottom">
                      <img src="../assets/images/profile/user-8.jpg" alt="modernize-img" class="rounded-circle mb-3" width="80" height="80">
                      <h5 class="fw-semibold mb-0">Rosetta Brewer</h5>
                      <span class="text-dark fs-2">Comptroller</span>
                    </div>
                    <ul class="px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0">
                      <li class="position-relative">
                        <a class="text-primary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold" href="javascript:void(0)">
                          <i class="ti ti-brand-facebook"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-danger d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-instagram"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-info d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-github"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-secondary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-twitter"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                  <div class="card hover-img">
                    <div class="card-body p-4 text-center border-bottom">
                      <img src="../assets/images/profile/user-9.jpg" alt="modernize-img" class="rounded-circle mb-3" width="80" height="80">
                      <h5 class="fw-semibold mb-0">Patrick Knight</h5>
                      <span class="text-dark fs-2">Retail Store Manager</span>
                    </div>
                    <ul class="px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0">
                      <li class="position-relative">
                        <a class="text-primary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold" href="javascript:void(0)">
                          <i class="ti ti-brand-facebook"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-danger d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-instagram"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-info d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-github"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-secondary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-twitter"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                  <div class="card hover-img">
                    <div class="card-body p-4 text-center border-bottom">
                      <img src="../assets/images/profile/user-10.jpg" alt="modernize-img" class="rounded-circle mb-3" width="80" height="80">
                      <h5 class="fw-semibold mb-0">Francis Sutton</h5>
                      <span class="text-dark fs-2">Astronomer</span>
                    </div>
                    <ul class="px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0">
                      <li class="position-relative">
                        <a class="text-primary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold" href="javascript:void(0)">
                          <i class="ti ti-brand-facebook"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-danger d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-instagram"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-info d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-github"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-secondary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-twitter"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                  <div class="card hover-img">
                    <div class="card-body p-4 text-center border-bottom">
                      <img src="../assets/images/profile/user-1.jpg" alt="modernize-img" class="rounded-circle mb-3" width="80" height="80">
                      <h5 class="fw-semibold mb-0">Bernice Henry</h5>
                      <span class="text-dark fs-2">Security Consultant</span>
                    </div>
                    <ul class="px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0">
                      <li class="position-relative">
                        <a class="text-primary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold" href="javascript:void(0)">
                          <i class="ti ti-brand-facebook"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-danger d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-instagram"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-info d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-github"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-secondary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-twitter"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                  <div class="card hover-img">
                    <div class="card-body p-4 text-center border-bottom">
                      <img src="../assets/images/profile/user-2.jpg" alt="modernize-img" class="rounded-circle mb-3" width="80" height="80">
                      <h5 class="fw-semibold mb-0">Estella Garcia</h5>
                      <span class="text-dark fs-2">Lead Software Test Engineer</span>
                    </div>
                    <ul class="px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0">
                      <li class="position-relative">
                        <a class="text-primary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold" href="javascript:void(0)">
                          <i class="ti ti-brand-facebook"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-danger d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-instagram"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-info d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-github"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-secondary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-twitter"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                  <div class="card hover-img">
                    <div class="card-body p-4 text-center border-bottom">
                      <img src="../assets/images/profile/user-3.jpg" alt="modernize-img" class="rounded-circle mb-3" width="80" height="80">
                      <h5 class="fw-semibold mb-0">Norman Moran</h5>
                      <span class="text-dark fs-2">Engineer Technician</span>
                    </div>
                    <ul class="px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0">
                      <li class="position-relative">
                        <a class="text-primary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold" href="javascript:void(0)">
                          <i class="ti ti-brand-facebook"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-danger d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-instagram"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-info d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-github"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-secondary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-twitter"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                  <div class="card hover-img">
                    <div class="card-body p-4 text-center border-bottom">
                      <img src="../assets/images/profile/user-4.jpg" alt="modernize-img" class="rounded-circle mb-3" width="80" height="80">
                      <h5 class="fw-semibold mb-0">Jessie Matthews</h5>
                      <span class="text-dark fs-2">Lead Software Engineer</span>
                    </div>
                    <ul class="px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0">
                      <li class="position-relative">
                        <a class="text-primary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold" href="javascript:void(0)">
                          <i class="ti ti-brand-facebook"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-danger d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-instagram"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-info d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-github"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-secondary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-twitter"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                  <div class="card hover-img">
                    <div class="card-body p-4 text-center border-bottom">
                      <img src="../assets/images/profile/user-5.jpg" alt="modernize-img" class="rounded-circle mb-3" width="80" height="80">
                      <h5 class="fw-semibold mb-0">Elijah Perez</h5>
                      <span class="text-dark fs-2">Special Education Teacher</span>
                    </div>
                    <ul class="px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0">
                      <li class="position-relative">
                        <a class="text-primary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold" href="javascript:void(0)">
                          <i class="ti ti-brand-facebook"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-danger d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-instagram"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-info d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-github"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-secondary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-twitter"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                  <div class="card hover-img">
                    <div class="card-body p-4 text-center border-bottom">
                      <img src="../assets/images/profile/user-6.jpg" alt="modernize-img" class="rounded-circle mb-3" width="80" height="80">
                      <h5 class="fw-semibold mb-0">Robert Martin</h5>
                      <span class="text-dark fs-2">Transportation Manager</span>
                    </div>
                    <ul class="px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0">
                      <li class="position-relative">
                        <a class="text-primary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold" href="javascript:void(0)">
                          <i class="ti ti-brand-facebook"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-danger d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-instagram"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-info d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-github"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-secondary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-twitter"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                  <div class="card hover-img">
                    <div class="card-body p-4 text-center border-bottom">
                      <img src="../assets/images/profile/user-7.jpg" alt="modernize-img" class="rounded-circle mb-3" width="80" height="80">
                      <h5 class="fw-semibold mb-0">Elva Wong</h5>
                      <span class="text-dark fs-2">Logistics Manager</span>
                    </div>
                    <ul class="px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0">
                      <li class="position-relative">
                        <a class="text-primary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold" href="javascript:void(0)">
                          <i class="ti ti-brand-facebook"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-danger d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-instagram"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-info d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-github"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-secondary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-twitter"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                  <div class="card hover-img">
                    <div class="card-body p-4 text-center border-bottom">
                      <img src="../assets/images/profile/user-8.jpg" alt="modernize-img" class="rounded-circle mb-3" width="80" height="80">
                      <h5 class="fw-semibold mb-0">Edith Taylor</h5>
                      <span class="text-dark fs-2">Union Representative</span>
                    </div>
                    <ul class="px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0">
                      <li class="position-relative">
                        <a class="text-primary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold" href="javascript:void(0)">
                          <i class="ti ti-brand-facebook"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-danger d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-instagram"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-info d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-github"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-secondary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-twitter"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                  <div class="card hover-img">
                    <div class="card-body p-4 text-center border-bottom">
                      <img src="../assets/images/profile/user-9.jpg" alt="modernize-img" class="rounded-circle mb-3" width="80" height="80">
                      <h5 class="fw-semibold mb-0">Violet Jackson</h5>
                      <span class="text-dark fs-2">Agricultural Inspector</span>
                    </div>
                    <ul class="px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0">
                      <li class="position-relative">
                        <a class="text-primary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold" href="javascript:void(0)">
                          <i class="ti ti-brand-facebook"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-danger d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-instagram"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-info d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-github"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-secondary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-twitter"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                  <div class="card hover-img">
                    <div class="card-body p-4 text-center border-bottom">
                      <img src="../assets/images/profile/user-10.jpg" alt="modernize-img" class="rounded-circle mb-3" width="80" height="80">
                      <h5 class="fw-semibold mb-0">Phoebe Owens</h5>
                      <span class="text-dark fs-2">Safety Engineer</span>
                    </div>
                    <ul class="px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0">
                      <li class="position-relative">
                        <a class="text-primary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold" href="javascript:void(0)">
                          <i class="ti ti-brand-facebook"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-danger d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-instagram"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-info d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-github"></i>
                        </a>
                      </li>
                      <li class="position-relative">
                        <a class="text-secondary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                          <i class="ti ti-brand-twitter"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-gallery" role="tabpanel" aria-labelledby="pills-gallery-tab" tabindex="0">
              <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-4">
                <h3 class="mb-3 mb-sm-0 fw-semibold d-flex align-items-center">Gallery <span class="badge text-bg-secondary fs-2 rounded-4 py-1 px-2 ms-2">12</span>
                </h3>
                <form class="position-relative">
                  <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh" placeholder="Search Friends">
                  <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y text-dark ms-3"></i>
                </form>
              </div>
              <div class="row">
                <div class="col-md-6 col-lg-4">
                  <div class="card hover-img overflow-hidden">
                    <div class="card-body p-0">
                      <img src="../assets/images/products/s1.jpg" alt="modernize-img" height="220" class="w-100 object-fit-cover">
                      <div class="p-4 d-flex align-items-center justify-content-between">
                        <div>
                          <h6 class="mb-0">Isuava wakceajo fe.jpg</h6>
                          <span class="text-dark fs-2">Wed, Dec 14, 2024</span>
                        </div>
                        <div class="dropdown">
                          <a class="text-muted fw-semibold d-flex align-items-center p-1" href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                          </a>
                          <ul class="dropdown-menu overflow-hidden">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0)">Isuava wakceajo fe.jpg</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-lg-4">
                  <div class="card hover-img overflow-hidden">
                    <div class="card-body p-0">
                      <img src="../assets/images/products/s2.jpg" alt="modernize-img" height="220" class="w-100 object-fit-cover">
                      <div class="p-4 d-flex align-items-center justify-content-between">
                        <div>
                          <h6 class="mb-0">Ip docmowe vemremrif.jpg</h6>
                          <span class="text-dark fs-2">Wed, Dec 14, 2024</span>
                        </div>
                        <div class="dropdown">
                          <a class="text-muted fw-semibold d-flex align-items-center p-1" href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                          </a>
                          <ul class="dropdown-menu overflow-hidden">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0)">Ip docmowe vemremrif.jpg</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-lg-4">
                  <div class="card hover-img overflow-hidden">
                    <div class="card-body p-0">
                      <img src="../assets/images/products/s3.jpg" alt="modernize-img" height="220" class="w-100 object-fit-cover">
                      <div class="p-4 d-flex align-items-center justify-content-between">
                        <div>
                          <h6 class="mb-0">Duan cosudos utaku.jpg</h6>
                          <span class="text-dark fs-2">Wed, Dec 14, 2024</span>
                        </div>
                        <div class="dropdown">
                          <a class="text-muted fw-semibold d-flex align-items-center p-1" href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                          </a>
                          <ul class="dropdown-menu overflow-hidden">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0)">Duan cosudos utaku.jpg</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-lg-4">
                  <div class="card hover-img overflow-hidden">
                    <div class="card-body p-0">
                      <img src="../assets/images/products/s4.jpg" alt="modernize-img" height="220" class="w-100 object-fit-cover">
                      <div class="p-4 d-flex align-items-center justify-content-between">
                        <div>
                          <h6 class="mb-0">Fu netbuv oggu.jpg</h6>
                          <span class="text-dark fs-2">Wed, Dec 14, 2024</span>
                        </div>
                        <div class="dropdown">
                          <a class="text-muted fw-semibold d-flex align-items-center p-1" href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                          </a>
                          <ul class="dropdown-menu overflow-hidden">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0)">Fu netbuv oggu.jpg</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-lg-4">
                  <div class="card hover-img overflow-hidden">
                    <div class="card-body p-0">
                      <img src="../assets/images/products/s5.jpg" alt="modernize-img" height="220" class="w-100 object-fit-cover">
                      <div class="p-4 d-flex align-items-center justify-content-between">
                        <div>
                          <h6 class="mb-0">Di sekog do.jpg</h6>
                          <span class="text-dark fs-2">Wed, Dec 14, 2024</span>
                        </div>
                        <div class="dropdown">
                          <a class="text-muted fw-semibold d-flex align-items-center p-1" href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                          </a>
                          <ul class="dropdown-menu overflow-hidden">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0)">Di sekog do.jpg</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-lg-4">
                  <div class="card hover-img overflow-hidden">
                    <div class="card-body p-0">
                      <img src="../assets/images/products/s6.jpg" alt="modernize-img" height="220" class="w-100 object-fit-cover">
                      <div class="p-4 d-flex align-items-center justify-content-between">
                        <div>
                          <h6 class="mb-0">Lo jogu camhiisi.jpg</h6>
                          <span class="text-dark fs-2">Thu, Dec 15, 2024</span>
                        </div>
                        <div class="dropdown">
                          <a class="text-muted fw-semibold d-flex align-items-center p-1" href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                          </a>
                          <ul class="dropdown-menu overflow-hidden">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0)">Lo jogu camhiisi.jpg</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-lg-4">
                  <div class="card hover-img overflow-hidden">
                    <div class="card-body p-0">
                      <img src="../assets/images/products/s7.jpg" alt="modernize-img" height="220" class="w-100 object-fit-cover">
                      <div class="p-4 d-flex align-items-center justify-content-between">
                        <div>
                          <h6 class="mb-0">Orewac huosazud robuf.jpg</h6>
                          <span class="text-dark fs-2">Fri, Dec 16, 2024</span>
                        </div>
                        <div class="dropdown">
                          <a class="text-muted fw-semibold d-flex align-items-center p-1" href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                          </a>
                          <ul class="dropdown-menu overflow-hidden">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0)">Orewac huosazud robuf.jpg</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-lg-4">
                  <div class="card hover-img overflow-hidden">
                    <div class="card-body p-0">
                      <img src="../assets/images/products/s8.jpg" alt="modernize-img" height="220" class="w-100 object-fit-cover">
                      <div class="p-4 d-flex align-items-center justify-content-between">
                        <div>
                          <h6 class="mb-0">Nira biolaizo tuzi.jpg</h6>
                          <span class="text-dark fs-2">Sat, Dec 17, 2024</span>
                        </div>
                        <div class="dropdown">
                          <a class="text-muted fw-semibold d-flex align-items-center p-1" href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                          </a>
                          <ul class="dropdown-menu overflow-hidden">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0)">Nira biolaizo tuzi.jpg</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-lg-4">
                  <div class="card hover-img overflow-hidden">
                    <div class="card-body p-0">
                      <img src="../assets/images/products/s9.jpg" alt="modernize-img" height="220" class="w-100 object-fit-cover">
                      <div class="p-4 d-flex align-items-center justify-content-between">
                        <div>
                          <h6 class="mb-0">Peri metu ejvu.jpg</h6>
                          <span class="text-dark fs-2">Sun, Dec 18, 2024</span>
                        </div>
                        <div class="dropdown">
                          <a class="text-muted fw-semibold d-flex align-items-center p-1" href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                          </a>
                          <ul class="dropdown-menu overflow-hidden">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0)">Peri metu ejvu.jpg</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-lg-4">
                  <div class="card hover-img overflow-hidden">
                    <div class="card-body p-0">
                      <img src="../assets/images/products/s10.jpg" alt="modernize-img" height="220" class="w-100 object-fit-cover">
                      <div class="p-4 d-flex align-items-center justify-content-between">
                        <div>
                          <h6 class="mb-0">Vurnohot tajraje isusufuj.jpg</h6>
                          <span class="text-dark fs-2">Mon, Dec 19, 2024</span>
                        </div>
                        <div class="dropdown">
                          <a class="text-muted fw-semibold d-flex align-items-center p-1" href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                          </a>
                          <ul class="dropdown-menu overflow-hidden">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0)">Vurnohot tajraje isusufuj.jpg</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-lg-4">
                  <div class="card hover-img overflow-hidden">
                    <div class="card-body p-0">
                      <img src="../assets/images/products/s11.jpg" alt="modernize-img" height="220" class="w-100 object-fit-cover">
                      <div class="p-4 d-flex align-items-center justify-content-between">
                        <div>
                          <h6 class="mb-0">Juc oz ma.jpg</h6>
                          <span class="text-dark fs-2">Tue, Dec 20, 2024</span>
                        </div>
                        <div class="dropdown">
                          <a class="text-muted fw-semibold d-flex align-items-center p-1" href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                          </a>
                          <ul class="dropdown-menu overflow-hidden">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0)">Juc oz ma.jpg</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-lg-4">
                  <div class="card hover-img overflow-hidden">
                    <div class="card-body p-0">
                      <img src="../assets/images/products/s12.jpg" alt="modernize-img" height="220" class="w-100 object-fit-cover">
                      <div class="p-4 d-flex align-items-center justify-content-between">
                        <div>
                          <h6 class="mb-0">Povipvez marjelliz zuuva.jpg</h6>
                          <span class="text-dark fs-2">Wed, Dec 21, 2024</span>
                        </div>
                        <div class="dropdown">
                          <a class="text-muted fw-semibold d-flex align-items-center p-1" href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                          </a>
                          <ul class="dropdown-menu overflow-hidden">
                            <li>
                              <a class="dropdown-item" href="javascript:void(0)">Povipvez marjelliz zuuva.jpg</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->
</div>



<script>
    document.addEventListener('DOMContentLoaded', () => {
        const kanbanBoard = document.getElementById('kanban-board');
        const clientId = {{ $client->id }}; // Blade variable for client ID

        if (!kanbanBoard) {
            console.error('Kanban board element not found.');
            return;
        }

        // Load stages and leads from the server
        fetch(`/clients/${clientId}/lead-stages`)
            .then(response => response.json())
            .then(stages => {
                renderKanbanBoard(stages, kanbanBoard); // Render the Kanban board
                initializeDragula(); // Initialize drag-and-drop functionality
            })
            .catch(error => console.error('Error fetching stages:', error));

        loadStickyNotes(clientId); // Load sticky notes for the specific client
    });

    // Format currency with spaces
    function formatCurrency(amount) {
        return new Intl.NumberFormat('en-ZA', {
            style: 'currency',
            currency: 'ZAR',
            minimumFractionDigits: 2,
        }).format(amount).replace('ZAR', 'R').trim();
    }

    function renderKanbanBoard(stages, kanbanBoard) {
        kanbanBoard.innerHTML = ''; // Clear existing content

        stages.forEach(stage => {
            const column = createKanbanColumn(stage);
            kanbanBoard.appendChild(column);
        });
    }

    function createKanbanColumn(stage) {
        const column = document.createElement('div');
        column.className = 'kanban-column';
        column.id = `stage-${stage.id}`;

        // Column title
        const title = document.createElement('h3');
        title.innerText = stage.title || 'Untitled Stage';
        column.appendChild(title);

        // Total revenue display
        const revenueTotal = document.createElement('div');
        revenueTotal.className = 'kanban-revenue-total';
        revenueTotal.id = `revenue-total-${stage.id}`;
        revenueTotal.innerHTML = `<strong>Total Revenue: </strong>R0`;
        column.appendChild(revenueTotal);

        // Cards container
        const cardContainer = document.createElement('div');
        cardContainer.className = 'kanban-cards';
        cardContainer.id = `cards-${stage.id}`;
        column.appendChild(cardContainer);

        let totalRevenue = 0;

        // Create cards for each lead
        stage.leads.forEach(lead => {
            const card = createKanbanCard(lead);
            cardContainer.appendChild(card);
            totalRevenue += parseFloat(lead.revenue || 0);
        });

        // Update the total revenue for this stage
        revenueTotal.innerHTML = `<strong>Total Revenue: </strong>${formatCurrency(totalRevenue)}`;

        return column;
    }

    function createKanbanCard(lead) {
        const card = document.createElement('div');
        card.className = 'kanban-card';
        card.dataset.id = lead.id;

        // Random background color
        card.style.backgroundColor = getRandomColor();

        // Card content
        card.innerHTML = `
    <h4>${lead.title}</h4>
    <p>${lead.description}</p>
    <p>${formatCurrency(parseFloat(lead.revenue || 0))}</p>
  `;

        return card;
    }

    function getRandomColor() {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    function initializeDragula() {
        const containers = Array.from(document.querySelectorAll('.kanban-cards'));

        dragula(containers, {
            moves: () => true,
            accepts: (el, target) => target.classList.contains('kanban-cards'),
        }).on('drop', (el, target, source) => {
            if (!target || !source) {
                console.error('Invalid drag-and-drop operation.');
                return;
            }

            const newStageId = target.id.split('-')[1];
            const updatedLeads = Array.from(target.children).map((child, index) => ({
                id: child.dataset.id,
                lead_stage_id: newStageId,
                order: index,
            }));

            // Update leads on the server
            updateLeadsOnServer(updatedLeads);

            // Immediately update revenue totals for both source and target columns
            updateRevenueTotal(source.closest('.kanban-column'));
            updateRevenueTotal(target.closest('.kanban-column'));
        });
    }

    function updateLeadsOnServer(updatedLeads) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch('/lead/stage/update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken, // Add the CSRF token to the headers
            },
            body: JSON.stringify({ leads: updatedLeads }),
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => console.log(data.message))
            .catch(error => console.error('Error updating leads:', error));
    }

    function updateRevenueTotal(stageElement) {
        if (!stageElement) {
            console.error('Stage element is null or undefined');
            return;
        }

        const cardContainer = stageElement.querySelector('.kanban-cards');
        if (!cardContainer) {
            console.error('No .kanban-cards container found in stage:', stageElement);
            return;
        }

        let totalRevenue = 0;

        // Sum up all card revenues
        cardContainer.querySelectorAll('.kanban-card').forEach(card => {
            const revenueText = card.querySelector('p:last-of-type').innerText;
            const cleanedRevenue = revenueText.replace(/[^\d.-]/g, ''); // Remove non-numeric characters
            const revenue = parseFloat(cleanedRevenue);

            if (!isNaN(revenue)) {
                totalRevenue += revenue;
            }
        });

        const revenueTotal = stageElement.querySelector('.kanban-revenue-total');
        if (revenueTotal) {
            revenueTotal.innerHTML = `<strong>Total Revenue: </strong>${formatCurrency(totalRevenue)}`;
        }
    }

    function loadStickyNotes(clientId) {
        console.log(`Loading sticky notes for client ${clientId}...`);
        // Placeholder for sticky notes logic
    }


</script>
@endsection