@extends('layouts.header_footer')

@section('main_content')
    <section class="mt-5">
        <div class="container">
            <h5 class="text-center">Provide your valuable Feedback</h5>
            <div class="row">
                <div class="col-md-6 align-items-center text-center">
                    <img src="{{ asset('assets/img/newimg/bg-img/33.jpg') }}" class="h-400px" alt="" style="height: 400px">
                </div>
                <div class="col-md-6">
                    <!-- Title -->
                    <h2 class="mt-4 mt-md-0">Let's talk</h2>
                    <form action="{{ route('savefeedback') }}" method="POST" enctype="multipart/form-data">
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
                        <div class="d-grid">
                            <button type="submit" class="btn btn-lg btn-primary mb-0" type="button">Send
                                Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
