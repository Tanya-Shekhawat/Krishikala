@extends('admin.layouts.adminlayout')

@section('title')
    Admin Officer View Page
@endsection

@section('content')
    <div class="card shadow">

        <div class="card-header border-bottom d-sm-flex justify-content-between align-items-center">
            <h5 class="card-header-title mb-0">Manage Police Station</h5>
            <a href="{{ route('admin.allstations') }}" class="btn btn-danger mb-0">Back</a>
        </div>

        <!-- Card body START -->
        <div class="card-body">
            <form class="row g-4" action="{{ route('admin.savestation') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id"
                    @if (isset($station_details)) value="{{ $station_details->id }}" @else value="0" @endif>
                <!-- Input item -->

                {{-- Station Name --}}
                <div class="col-6">
                    <label class="form-label">Enter Police Station Name</label><span class="asktrick_label"> *</span>
                    <input type="text" class="form-control" placeholder="Enter Police Station Name" name="name"
                        @if (isset($station_details)) value="{{ $station_details->name }}" @endif>
                </div>

                {{-- Station Number  --}}
                <div class="col-6">
                    <label class="form-label">Enter Police Station Number</label><span class="asktrick_label"> *</span>
                    <input type="text" class="form-control" placeholder="Enter Police Station Number" name="number"
                        @if (isset($station_details)) value="{{ $station_details->number }}" @endif>
                </div>

                {{-- Station Address --}}
                <div class="col-6">
                    <label class="form-label">Enter Police Station Address</label><span class="asktrick_label"> *</span>
                    <input type="text" class="form-control" placeholder="Enter Police Station Address" name="address"
                        @if (isset($station_details)) value="{{ $station_details->address }}" @endif>
                </div>

                {{-- Station Pincode --}}
                <div class="col-6">
                    <label class="form-label">Enter Police Station Pincode</label><span class="asktrick_label"> *</span>
                    <input type="text" class="form-control" placeholder="Enter Police Station Pincode" name="pincode"
                        @if (isset($station_details)) value="{{ $station_details->pincode }}" @endif>
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
