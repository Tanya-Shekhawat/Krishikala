@extends('admin.layouts.adminlayout')

@section('title')
    Admin Officer View Page
@endsection

@section('content')
    <div class="card shadow">

        <div class="card-header border-bottom d-sm-flex justify-content-between align-items-center">
            <h5 class="card-header-title mb-0">Station Officer Page</h5>
            <a href="{{ route('admin.officers') }}" class="btn btn-danger mb-0">Back</a>
        </div>

        <!-- Card body START -->
        <div class="card-body">
            <form class="row g-4" action="{{ route('admin.saveofficer') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id"
                    @if (isset($officer_details)) value="{{ $officer_details->id }}" @else value="0" @endif>
                <!-- Input item -->
                <div class="col-6">
                    <label class="form-label">Name</label><span class="asktrick_label"> *</span>
                    <input type="text" class="form-control" placeholder="Station Officer Name" name="name"
                        @if (isset($officer_details)) value="{{ $officer_details->name }}" @endif>
                </div>

                {{-- Phone Number of Station Officer --}}
                <div class="col-6">
                    <label class="form-label">Phone Number</label><span class="asktrick_label"> *</span>
                    <input type="text" class="form-control" placeholder="Station Officer Phone Number" name="phone"
                        @if (isset($officer_details)) value="{{ $officer_details->phone }}" @endif>
                </div>

                <div class="row mt-4 col-12">
                    @if (isset($officer_details))
                        {{-- When doing Update --}}
                        <div class="col-12">
                            <label class="form-label">Email</label><span class="asktrick_label"> *</span>
                            <input type="email" class="form-control" placeholder="Station Officer Email" name="email"
                                @if (isset($officer_details)) value="{{ $officer_details->email }}" @endif>
                        </div>
                    @else
                        {{-- When not doing update, adding for first time --}}
                        <div class="col-6">
                            <label class="form-label">Email</label><span class="asktrick_label"> *</span>
                            <input type="email" class="form-control" placeholder="Station Officer Email" name="email"
                                @if (isset($officer_details)) value="{{ $officer_details->email }}" @endif>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Password</label><span class="asktrick_label"> *</span>
                            <input type="password" class="form-control" placeholder="Station Officer Password" name="password">
                            <div class="form-text">Set the temparary password for this Station Officer</div>
                        </div>
                    @endif
                </div>

                {{-- Image of Station Officer --}}
                <div class="col-6">
                    <label class="form-label">Image</label><span class="asktrick_label"> *</span>
                    <input type="file" class="form-control" placeholder="Station Officer Image" name="image"
                        @if (isset($officer_details)) value="{{ $officer_details->image }}" @endif >
                </div>

                {{-- Station Name --}}
                <div class="col-6">
                    <label class="form-label">Enter Police Station Name</label><span class="asktrick_label"> *</span>
                    <input type="text" class="form-control" placeholder="Enter Police Station Name" name="station_name"
                        @if (isset($officer_details)) value="{{ $officer_details->station_name }}" @endif>
                </div>

                {{-- Station Address --}}
                <div class="col-6">
                    <label class="form-label">Enter Police Station Address</label><span class="asktrick_label"> *</span>
                    <input type="text" class="form-control" placeholder="Enter Police Station Address" name="station_address"
                        @if (isset($officer_details)) value="{{ $officer_details->station_address }}" @endif>
                </div>

                {{-- Station Pincode --}}
                <div class="col-6">
                    <label class="form-label">Enter Police Station Pincode</label><span class="asktrick_label"> *</span>
                    <input type="text" class="form-control" placeholder="Enter Police Station Pincode" name="station_pincode"
                        @if (isset($officer_details)) value="{{ $officer_details->station_pincode }}" @endif>
                </div>

                {{-- Officer Joining Date --}}
                <div class="col-6">
                    <label class="form-label">Enter Station Officer Joining Date</label><span class="asktrick_label"> *</span>
                    <input type="date" class="form-control" placeholder="Enter Station Officer Joining Date" name="joining_date"
                        @if (isset($officer_details)) value="{{ $officer_details->joining_date }}" @endif>
                </div>

                {{-- Phone Number of Station Officer --}}
                <div class="col-6">
                    <label class="form-label">Post of Station Officer</label><span class="asktrick_label"> *</span>
                    <input type="text" class="form-control" placeholder="Post of Station Officer" name="post"
                        @if (isset($officer_details)) value="{{ $officer_details->post }}" @endif>
                </div>

                <!-- Save button -->
                <div class="d-sm-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mb-0">Save</button>
                </div>
            </form>
        </div>
        <!-- Card body END -->

    </div>
@endsection
