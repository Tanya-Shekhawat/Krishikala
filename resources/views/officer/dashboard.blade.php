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
                        <h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0" data-purecounter-end="{{count($user)}}"
                            data-purecounter-delay="200">0</h5>
                    </div>
                    <span class="mb-0 h6 fw-light">Total Staff Member</span>
                </div>
            </div>
        </div>
        <!-- Counter item -->
        <div class="col-sm-6 col-lg-4">
            <div class="d-flex justify-content-center align-items-center p-4 bg-purple bg-opacity-10 rounded-3">
                <span class="display-6 text-purple mb-0"><i class="fas fa-user-graduate fa-fw"></i></span>
                <div class="ms-4">
                    <div class="d-flex">
                        <h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0" data-purecounter-end="{{count($tasks)}}"
                            data-purecounter-delay="200">0</h5>
                        <span class="mb-0 h5"></span>
                    </div>
                    <span class="mb-0 h6 fw-light">Total Tasks</span>
                </div>
            </div>
        </div>
        <!-- Counter item -->
        <div class="col-sm-6 col-lg-4">
            <div class="d-flex justify-content-center align-items-center p-4 bg-info bg-opacity-10 rounded-3">
                <span class="display-6 text-info mb-0"><i class="fas fa-gem fa-fw"></i></span>
                <div class="ms-4">
                    <div class="d-flex">
                        <h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0" data-purecounter-end="{{$completed_task}}"
                            data-purecounter-delay="300">0</h5>
                        <span class="mb-0 h5"></span>
                    </div>
                    <span class="mb-0 h6 fw-light">Completed Tasks</span>
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
                        <span class="badge text-bg-dark">Total Tasks</span>
                        <h4 class="text-primary my-2">100</h4>
                    </div>
                    <!-- Content -->
                    <div class="col-sm-6 col-md-4">
                        <span class="badge text-bg-dark">Completed Tasks</span>
                        <h4 class="my-2">60</h4>
                    </div>
                </div>

                <!-- Apex chart -->
                <div id="ChartPayout"></div>

            </div>
        </div>
    </div>
    <!-- Chart END -->
@endsection
