@extends('admin.layouts.adminlayout')

@section('title')
    Manage Feedback
@endsection

@section('content')
    <div class="card shadow">

        <div class="card-header border-bottom d-sm-flex justify-content-between align-items-center">
            <h5 class="card-header-title mb-0">Manage Feedback Page</h5>
            <a href="{{ route('admin.viewfeedback') }}" class="btn btn-danger mb-0">Back</a>
        </div>

        <!-- Card body START -->
        <div class="card-body">
            <form action="{{ route('admin.savefeedback') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4 bg-light-input">
                    <label for="yourName" class="form-label">Your name<span class="red_alert">*</span></label>
                    <input type="text" class="form-control form-control-lg" name="name" required>
                </div>
                <div class="mb-4 bg-light-input">
                    <label for="textareaBox" class="form-label">Message<span class="red_alert">*</span></label>
                    <textarea class="form-control" name="message1" rows="4" required></textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">Profile Image</label>
                    <div class="d-flex align-items-center">
                        <label class="position-relative me-4" for="uploadfile-1" title="Replace this pic">
                            <span class="avatar avatar-xl">
                                <img id="logo_image_display"
                                    class="avatar-img rounded-circle border border-white border-3 shadow"
                                    @if (isset($admin_details->profile_image)) src="{{ $admin_details->profile_image }}"
                                    @else
                            src="{{ asset('assets/img/newimg/bg-img/29.jpg') }}" @endif
                                    alt="Profile Image">
                            </span>
                        </label>
                        <label class="btn btn-primary-soft mb-0" for="uploadfile-1">Change</label>
                        <input type="file" id="uploadfile-1" class="form-control d-none" name="image">
                    </div>
                </div>
                <div class="d-sm-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mb-0">Save Feedback</button>
                </div>
            </form>
        </div>
        <!-- Card body END -->

    </div>
@endsection
