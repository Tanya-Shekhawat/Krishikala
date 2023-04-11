@extends('officer.layouts.officerlayout')

@section('title')
    Officer Dashboard
@endsection

@section('content')
    <!-- Counter boxes START -->
    <div class="row g-4">
        <!-- Counter item -->
        <div class="col-sm-6 col-lg-4">
            <div class="d-flex justify-content-center align-items-center p-4 bg-warning bg-opacity-15 rounded-3">
                <span class="display-6 text-warning mb-0"><i class="fas fa-tv fa-fw"></i></span>
                <div class="ms-4">
                    <div class="d-flex">
                        <h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0" data-purecounter-end="25"
                            data-purecounter-delay="200">0</h5>
                    </div>
                    <span class="mb-0 h6 fw-light">Total Courses</span>
                </div>
            </div>
        </div>
        <!-- Counter item -->
        <div class="col-sm-6 col-lg-4">
            <div class="d-flex justify-content-center align-items-center p-4 bg-purple bg-opacity-10 rounded-3">
                <span class="display-6 text-purple mb-0"><i class="fas fa-user-graduate fa-fw"></i></span>
                <div class="ms-4">
                    <div class="d-flex">
                        <h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0" data-purecounter-end="25"
                            data-purecounter-delay="200">0</h5>
                        <span class="mb-0 h5">K+</span>
                    </div>
                    <span class="mb-0 h6 fw-light">Total Students</span>
                </div>
            </div>
        </div>
        <!-- Counter item -->
        <div class="col-sm-6 col-lg-4">
            <div class="d-flex justify-content-center align-items-center p-4 bg-info bg-opacity-10 rounded-3">
                <span class="display-6 text-info mb-0"><i class="fas fa-gem fa-fw"></i></span>
                <div class="ms-4">
                    <div class="d-flex">
                        <h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0" data-purecounter-end="12"
                            data-purecounter-delay="300">0</h5>
                        <span class="mb-0 h5">K</span>
                    </div>
                    <span class="mb-0 h6 fw-light">Enrolled Students</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Counter boxes END -->

    <!-- Chart START -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card card-body bg-transparent border p-4 h-100">
                <div class="row g-4">
                    <!-- Content -->
                    <div class="col-sm-6 col-md-4">
                        <span class="badge text-bg-dark">Current Month</span>
                        <h4 class="text-primary my-2">$35000</h4>
                        <p class="mb-0"><span class="text-success me-1">0.20%<i class="bi bi-arrow-up"></i></span>vs last
                            month</p>
                    </div>
                    <!-- Content -->
                    <div class="col-sm-6 col-md-4">
                        <span class="badge text-bg-dark">Last Month</span>
                        <h4 class="my-2">$28000</h4>
                        <p class="mb-0"><span class="text-danger me-1">0.10%<i class="bi bi-arrow-down"></i></span>Then
                            last month</p>
                    </div>
                </div>

                <!-- Apex chart -->
                <div id="ChartPayout"></div>

            </div>
        </div>
    </div>
    <!-- Chart END -->

    <!-- Course List table START -->
    <div class="row">
        <div class="col-12">
            <div class="card border bg-transparent rounded-3 mt-5">
                <!-- Card header START -->
                <div class="card-header bg-transparent border-bottom">
                    <div class="d-sm-flex justify-content-sm-between align-items-center">
                        <h3 class="mb-2 mb-sm-0">Most Selling Courses</h3>
                        <a href="#" class="btn btn-sm btn-primary-soft mb-0">View all</a>
                    </div>
                </div>
                <!-- Card header END -->

                <!-- Card body START -->
                <div class="card-body">
                    <div class="table-responsive border-0 rounded-3">
                        <!-- Table START -->
                        <table class="table table-dark-gray align-middle p-4 mb-0">
                            <!-- Table head -->
                            <thead>
                                <tr>
                                    <th scope="col" class="border-0 rounded-start">Course Name</th>
                                    <th scope="col" class="border-0">Selling</th>
                                    <th scope="col" class="border-0">Amount</th>
                                    <th scope="col" class="border-0">Period</th>
                                    <th scope="col" class="border-0 rounded-end">Action</th>
                                </tr>
                            </thead>
                            <!-- Table body START -->
                            <tbody>

                                <!-- Table item -->
                                <tr>
                                    <!-- Course item -->
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!-- Image -->
                                            <div class="w-60px">
                                                <img src="assets/images/courses/4by3/08.jpg" class="rounded" alt="">
                                            </div>
                                            <!-- Title -->
                                            <h6 class="mb-0 ms-2 table-responsive-title">
                                                <a href="#">Building Scalable APIs with GraphQL</a>
                                            </h6>
                                        </div>
                                    </td>
                                    <!-- Selling item -->
                                    <td>34</td>
                                    <!-- Amount item -->
                                    <td>$1,25,478</td>
                                    <!-- Period item -->
                                    <td>
                                        <span class="badge bg-primary bg-opacity-10 text-primary">9 months</span>
                                    </td>
                                    <!-- Action item -->
                                    <td>
                                        <a href="#" class="btn btn-sm btn-success-soft btn-round me-1 mb-0"><i
                                                class="far fa-fw fa-edit"></i></a>
                                        <button class="btn btn-sm btn-danger-soft btn-round mb-0"><i
                                                class="fas fa-fw fa-times"></i></button>
                                    </td>
                                </tr>

                                <!-- Table item -->
                                <tr>
                                    <!-- Course item -->
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!-- Image -->
                                            <div class="w-60px">
                                                <img src="assets/images/courses/4by3/10.jpg" class="rounded" alt="">
                                            </div>
                                            <!-- Title -->
                                            <h6 class="mb-0 ms-2 table-responsive-title">
                                                <a href="#">Bootstrap 5 From Scratch</a>
                                            </h6>
                                        </div>
                                    </td>
                                    <!-- Selling item -->
                                    <td>45</td>
                                    <!-- Amount item -->
                                    <td>$2,85,478</td>
                                    <!-- Period item -->
                                    <td>
                                        <span class="badge bg-primary bg-opacity-10 text-primary">6 months</span>
                                    </td>
                                    <!-- Action item -->
                                    <td>
                                        <a href="#" class="btn btn-sm btn-success-soft btn-round me-1 mb-0"><i
                                                class="far fa-fw fa-edit"></i></a>
                                        <button class="btn btn-sm btn-danger-soft btn-round mb-0"><i
                                                class="fas fa-fw fa-times"></i></button>
                                    </td>
                                </tr>

                                <!-- Table item -->
                                <tr>
                                    <!-- Course item -->
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!-- Image -->
                                            <div class="w-60px">
                                                <img src="assets/images/courses/4by3/02.jpg" class="rounded"
                                                    alt="">
                                            </div>
                                            <!-- Title -->
                                            <h6 class="mb-0 ms-2 table-responsive-title">
                                                <a href="#">Graphic Design Masterclass</a>
                                            </h6>
                                        </div>
                                    </td>
                                    <!-- Selling item -->
                                    <td>21</td>
                                    <!-- Amount item -->
                                    <td>$85,478</td>
                                    <!-- Period item -->
                                    <td>
                                        <span class="badge bg-primary bg-opacity-10 text-primary">4 months</span>
                                    </td>
                                    <!-- Action item -->
                                    <td>
                                        <a href="#" class="btn btn-sm btn-success-soft btn-round me-1 mb-0"><i
                                                class="far fa-fw fa-edit"></i></a>
                                        <button class="btn btn-sm btn-danger-soft btn-round mb-0"><i
                                                class="fas fa-fw fa-times"></i></button>
                                    </td>
                                </tr>

                                <!-- Table item -->
                                <tr>
                                    <!-- Course item -->
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!-- Image -->
                                            <div class="w-60px">
                                                <img src="assets/images/courses/4by3/04.jpg" class="rounded"
                                                    alt="">
                                            </div>
                                            <!-- Title -->
                                            <h6 class="mb-0 ms-2 table-responsive-title">
                                                <a href="#">Learn Invision</a>
                                            </h6>
                                        </div>
                                    </td>
                                    <!-- Selling item -->
                                    <td>28</td>
                                    <!-- Amount item -->
                                    <td>$98,478</td>
                                    <!-- Period item -->
                                    <td>
                                        <span class="badge bg-primary bg-opacity-10 text-primary">8 months</span>
                                    </td>
                                    <!-- Action item -->
                                    <td>
                                        <a href="#" class="btn btn-sm btn-success-soft btn-round me-1 mb-0"><i
                                                class="far fa-fw fa-edit"></i></a>
                                        <button class="btn btn-sm btn-danger-soft btn-round mb-0"><i
                                                class="fas fa-fw fa-times"></i></button>
                                    </td>
                                </tr>

                                <!-- Table item -->
                                <tr>
                                    <!-- Course item -->
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!-- Image -->
                                            <div class="w-60px">
                                                <img src="assets/images/courses/4by3/06.jpg" class="rounded"
                                                    alt="">
                                            </div>
                                            <!-- Title -->
                                            <h6 class="mb-0 ms-2 table-responsive-title">
                                                <a href="#">Angular – The Complete Guider</a>
                                            </h6>
                                        </div>
                                    </td>
                                    <!-- Selling item -->
                                    <td>38</td>
                                    <!-- Amount item -->
                                    <td>$1,02,478</td>
                                    <!-- Period item -->
                                    <td>
                                        <span class="badge bg-primary bg-opacity-10 text-primary">1 year</span>
                                    </td>
                                    <!-- Action item -->
                                    <td>
                                        <a href="#" class="btn btn-sm btn-success-soft btn-round me-1 mb-0"><i
                                                class="far fa-fw fa-edit"></i></a>
                                        <button class="btn btn-sm btn-danger-soft btn-round mb-0"><i
                                                class="fas fa-fw fa-times"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                            <!-- Table body END -->
                        </table>
                        <!-- Table END -->
                    </div>

                    <!-- Pagination -->
                    <div class="d-sm-flex justify-content-sm-between align-items-sm-center mt-3">
                        <!-- Content -->
                        <p class="mb-0 text-center text-sm-start">Showing 1 to 8 of 20 entries</p>
                        <!-- Pagination -->
                        <nav class="d-flex justify-content-center mb-0" aria-label="navigation">
                            <ul
                                class="pagination pagination-sm pagination-primary-soft d-inline-block d-md-flex rounded mb-0">
                                <li class="page-item mb-0"><a class="page-link" href="#" tabindex="-1"><i
                                            class="fas fa-angle-left"></i></a></li>
                                <li class="page-item mb-0"><a class="page-link" href="#">1</a></li>
                                <li class="page-item mb-0 active"><a class="page-link" href="#">2</a></li>
                                <li class="page-item mb-0"><a class="page-link" href="#">3</a></li>
                                <li class="page-item mb-0"><a class="page-link" href="#"><i
                                            class="fas fa-angle-right"></i></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Card body START -->
            </div>
        </div>
    </div>
    <!-- Course List table END -->
@endsection
