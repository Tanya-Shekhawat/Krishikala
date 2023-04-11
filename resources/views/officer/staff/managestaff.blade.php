@extends('officer.layouts.officerlayout')

@section('title')
    Officer Add Staff Page
@endsection

@section('content')
    <div class="card shadow">

        <div class="card-header border-bottom d-sm-flex justify-content-between align-items-center">
            <h5 class="card-header-title mb-0">Station Staff Page</h5>
            <a href="{{ route('officer.allstaff') }}" class="btn btn-danger mb-0">Back</a>
        </div>

        <!-- Card body START -->
        <div class="card-body">
            <form class="row g-4" action="{{ route('officer.savestaff') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id"
                    @if (isset($staff_details)) value="{{ $staff_details->id }}" @else value="0" @endif>
                <!-- Input item -->
                <div class="col-6">
                    <label class="form-label">Name</label><span class="asktrick_label"> *</span>
                    <input type="text" class="form-control" placeholder="Station Officer Name" name="name"
                        @if (isset($staff_details)) value="{{ $staff_details->name }}" @endif>
                </div>

                {{-- Phone Number of Station Officer --}}
                <div class="col-6">
                    <label class="form-label">Phone Number</label><span class="asktrick_label"> *</span>
                    <input type="text" class="form-control" placeholder="Station Officer Phone Number" name="phone"
                        @if (isset($staff_details)) value="{{ $staff_details->phone }}" @endif>
                </div>

                <div class="row mt-4 col-12">
                    @if (isset($staff_details))
                        {{-- When doing Update --}}
                        <div class="col-12">
                            <label class="form-label">Email</label><span class="asktrick_label"> *</span>
                            <input type="email" class="form-control" placeholder="Station Officer Email" name="email"
                                @if (isset($staff_details)) value="{{ $staff_details->email }}" @endif>
                        </div>
                    @else
                        {{-- When not doing update, adding for first time --}}
                        <div class="col-6">
                            <label class="form-label">Email</label><span class="asktrick_label"> *</span>
                            <input type="email" class="form-control" placeholder="Station Officer Email" name="email"
                                @if (isset($staff_details)) value="{{ $staff_details->email }}" @endif>
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
                        @if (isset($staff_details)) value="{{ $staff_details->image }}" @endif >
                </div>

                {{-- Station Name --}}
                <div class="col-6">
                    <label class="form-label">Enter Police Station Name</label><span class="asktrick_label"> *</span>
                    <input type="text" class="form-control" placeholder="Enter Police Station Name" name="station_name"
                        @if (isset($staff_details)) value="{{ $staff_details->station_name }}" 
                        @else value="{{getStationNameById($station_details->station_name,'name')}}"
                        @endif readonly
                    >
                </div>

                {{-- Station Address --}}
                <div class="col-6">
                    <label class="form-label">Enter Police Station Address</label><span class="asktrick_label"> *</span>
                    <input type="text" class="form-control" placeholder="Enter Police Station Address" name="station_address"
                        @if (isset($staff_details)) value="{{ $staff_details->station_address }}" 
                        @else value="{{getStationNameById($station_details->station_name,'address')}}"
                        @endif readonly
                    >
                </div>

                {{-- Station Pincode --}}
                <div class="col-6">
                    <label class="form-label">Enter Police Station Pincode</label><span class="asktrick_label"> *</span>
                    <input type="text" class="form-control" placeholder="Enter Police Station Pincode" name="station_pincode"
                        @if (isset($staff_details)) value="{{ $staff_details->station_pincode }}" 
                        @else value="{{getStationNameById($station_details->station_name,'pincode')}}"
                        @endif readonly
                    >
                </div>

                {{-- Officer Joining Date --}}
                <div class="col-6">
                    <label class="form-label">Enter Station Officer Joining Date</label><span class="asktrick_label"> *</span>
                    <input type="date" class="form-control" placeholder="Enter Station Officer Joining Date" name="joining_date"
                        @if (isset($staff_details)) value="{{ $staff_details->joining_date }}" @endif>
                </div>

                {{-- Phone Number of Station Officer --}}
                <div class="col-6">
                    <label class="form-label">Post of Station Officer</label><span class="asktrick_label"> *</span>
                    <input type="text" class="form-control" placeholder="Post of Station Officer" name="post"
                        @if (isset($staff_details)) value="{{ $staff_details->post }}" @endif>
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
