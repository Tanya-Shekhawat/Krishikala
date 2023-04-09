@extends('admin.layouts.adminlayout')

@section('title')
    Admin Dashboard
@endsection

@section('content')
    <!-- Title -->
    <div class="row">
        <div class="col-12 mb-3">
            <h1 class="h3 mb-2 mb-sm-0">Dashboard</h1>
        </div>
    </div>

    <!-- Counter boxes START -->
    <div class="row g-4 mb-4">
        <!-- Counter item -->
        <div class="col-md-6 col-xxl-3">
            <div class="card card-body bg-warning bg-opacity-15 p-4 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <!-- Digit -->
                    <div>
                        <h2 class="purecounter mb-0 fw-bold" data-purecounter-start="0" data-purecounter-end="1958"
                            data-purecounter-delay="200">0</h2>
                        <span class="mb-0 h6 fw-light">Total Officers</span>
                    </div>
                    <!-- Icon -->
                    <div class="icon-lg rounded-circle bg-warning text-white mb-0"><i class="fas fa-user-graduate fa-fw"></i></div>
                </div>
            </div>
        </div>

        <!-- Counter item -->
        <div class="col-md-6 col-xxl-3">
            <div class="card card-body bg-purple bg-opacity-10 p-4 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <!-- Digit -->
                    <div>
                        <h2 class="purecounter mb-0 fw-bold" data-purecounter-start="0" data-purecounter-end="1600"
                            data-purecounter-delay="200">0</h2>
                        <span class="mb-0 h6 fw-light">Total Police Personnels</span>
                    </div>
                    <!-- Icon -->
                    <div class="icon-lg rounded-circle bg-purple text-white mb-0"><i class="fas fa-user-tie fa-fw"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Counter item -->
        <div class="col-md-6 col-xxl-3">
            <div class="card card-body bg-primary bg-opacity-10 p-4 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <!-- Digit -->
                    <div>
                        <h2 class="purecounter mb-0 fw-bold" data-purecounter-start="0" data-purecounter-end="1235"
                            data-purecounter-delay="200">0</h2>
                        <span class="mb-0 h6 fw-light">Registered Cases</span>
                    </div>
                    <!-- Icon -->
                    <div class="icon-lg rounded-circle bg-primary text-white mb-0"><i
                            class="fas fa-tv fa-fw"></i></div>
                </div>
            </div>
        </div>

        <!-- Counter item -->
        <div class="col-md-6 col-xxl-3">
            <div class="card card-body bg-success bg-opacity-10 p-4 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <!-- Digit -->
                    <div>
                        <div class="d-flex">
                            <h2 class="purecounter mb-0 fw-bold" data-purecounter-start="0" data-purecounter-end="845"
                                data-purecounter-delay="200">0</h2>
                            <span class="mb-0 h2 ms-1">hrs</span>
                        </div>
                        <span class="mb-0 h6 fw-light">Solved Cases</span>
                    </div>
                    <!-- Icon -->
                    <div class="icon-lg rounded-circle bg-success text-white mb-0"><i
                            class="bi bi-stopwatch-fill fa-fw"></i></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Counter boxes END -->

    <!-- Chart and Ticket START -->
    <div class="row g-4 mb-4">

        <!-- Chart START -->
        <div class="col-xxl-12">
            <div class="card shadow h-100">

                <!-- Card header -->
                <div class="card-header p-4 border-bottom">
                    <h5 class="card-header-title">Cases Solved</h5>
                </div>

                <!-- Card body -->
                <div class="card-body">
                    <!-- Apex chart -->
                    <div id="ChartPayout"></div>
                </div>
            </div>
        </div>
        <!-- Chart END -->
    </div>
    <!-- Chart and Ticket END -->

    <div class="row g-4">
        <!-- Police Officers START -->
        <div class="col-lg-6 col-xxl-12">
            <div class="card shadow h-100">

                <!-- Card header -->
                <div class="card-header border-bottom d-flex justify-content-between align-items-center p-4">
                    <h5 class="card-header-title">All Officers</h5>
                    <a href="#" class="btn btn-link p-0 mb-0">View all</a>
                </div>

                <!-- Card body START -->
                <div class="card-body p-4">

                    <!-- Instructor item START -->
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <!-- Avatar and info -->
                        <div class="d-sm-flex align-items-center mb-1 mb-sm-0">
                            <!-- Avatar -->
                            <div class="avatar avatar-md flex-shrink-0">
                                <img class="avatar-img rounded-circle" src="assets/images/avatar/09.jpg" alt="avatar">
                            </div>
                            <!-- Info -->
                            <div class="ms-0 ms-sm-2 mt-2 mt-sm-0">
                                <h6 class="mb-1">Lori Stevens<i class="bi bi-patch-check-fill text-info small ms-1"></i>
                                </h6>
                                <ul class="list-inline mb-0 small">
                                    <li class="list-inline-item fw-light me-2 mb-1 mb-sm-0"><i
                                            class="fas fa-book text-purple me-1"></i>25 Courses</li>
                                    <li class="list-inline-item fw-light me-2 mb-1 mb-sm-0"><i
                                            class="fas fa-star text-warning me-1"></i>4.5/5.0</li>
                                </ul>
                            </div>
                        </div>
                        <!-- Button -->
                        <a href="#" class="btn btn-sm btn-light mb-0">View</a>
                    </div>
                    <!-- Instructor item END -->

                    <hr><!-- Divider -->

                    <!-- Instructor item START -->
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <!-- Avatar and info -->
                        <div class="d-sm-flex align-items-center mb-1 mb-sm-0">
                            <!-- Avatar -->
                            <div class="avatar avatar-md flex-shrink-0">
                                <img class="avatar-img rounded-circle" src="assets/images/avatar/03.jpg" alt="avatar">
                            </div>
                            <!-- Info -->
                            <div class="ms-0 ms-sm-2 mt-2 mt-sm-0">
                                <h6 class="mb-1">Dennis Barrett</h6>
                                <ul class="list-inline mb-0 small">
                                    <li class="list-inline-item fw-light me-2 mb-1 mb-sm-0"><i
                                            class="fas fa-book text-purple me-1"></i>18 Courses</li>
                                    <li class="list-inline-item fw-light me-2 mb-1 mb-sm-0"><i
                                            class="fas fa-star text-warning me-1"></i>4.5/5.0</li>
                                </ul>
                            </div>
                        </div>
                        <!-- Button -->
                        <a href="#" class="btn btn-sm btn-light mb-0">View</a>
                    </div>
                    <!-- Instructor item END -->

                    <hr><!-- Divider -->

                </div>
                <!-- Card body END -->
            </div>
        </div>
        <!-- Top Police Officers END -->
    </div>
@endsection
