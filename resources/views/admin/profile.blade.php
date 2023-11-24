@extends('admin.layouts.adminlayout')

@section('title')
    Admin Profile
@endsection

@section('content')
    <div class="row">
        <div class="col-12 mb-3">
            <h1 class="h3 mb-2 mb-sm-0">Admin Profile</h1>
        </div>
    </div>

    <!-- Card body START -->
    <div class="card-body">
        <form class="row g-4" action="{{ route('admin.saveprofile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id"
                @if (isset($admin_details)) value="{{ $admin_details->id }}" @else value="0" @endif>
            <!-- Input item -->
            <div class="col-12">
                <label class="form-label">Doctor Name</label><span class="asktrick_label"> *</span>
                <input type="text" class="form-control" placeholder="Doctor Name" name="name"
                    @if (isset($admin_details)) value="{{ $admin_details->name }}" @endif>
            </div>
            <div class="col-12">
                <label class="form-label">Email</label><span class="asktrick_label"> *</span>
                <input type="email" class="form-control" placeholder="Email" name="email"
                    @if (isset($admin_details)) value="{{ $admin_details->email }}" @endif>
            </div>
            <!-- Image -->
            <div class="col-12">
                <label class="form-label">Profile Image</label>
                <!-- Avatar upload START -->
                <div class="d-flex align-items-center">
                    <label class="position-relative me-4" for="uploadfile-1" title="Replace this pic">
                        <!-- Avatar place holder -->
                        <span class="avatar avatar-xl">
                            <img id="logo_image_display"
                                class="avatar-img rounded-circle border border-white border-3 shadow"
                                @if (isset($admin_details->profile_image)) src="{{ $admin_details->profile_image }}"
                                @else
                                    src="{{ asset('assets/img/newimg/bg-img/29.jpg') }}" @endif
                                alt="Profile Image">
                        </span>
                    </label>
                    <!-- Upload button -->
                    <label class="btn btn-primary-soft mb-0" for="uploadfile-1">Change</label>
                    <input type="file" id="uploadfile-1" class="form-control d-none" name="image">
                </div>
                <!-- Avatar upload END -->
            </div>

            <!-- Save button -->
            <div class="d-sm-flex justify-content-end">
                <button type="submit" class="btn btn-primary mb-0">Save</button>
            </div>
        </form>
    </div>
    <!-- Card body END -->
@endsection
