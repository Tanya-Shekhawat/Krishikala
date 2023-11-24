@extends('admin.layouts.adminlayout')

@section('title')
    Manage Mandi
@endsection

@section('content')
    <div class="card shadow">

        <div class="card-header border-bottom d-sm-flex justify-content-between align-items-center">
            <h5 class="card-header-title mb-0">Manage Mandi Page</h5>
            <a href="{{ route('admin.mandiprice') }}" class="btn btn-danger mb-0">Back</a>
        </div>

        <!-- Card body START -->
        <div class="card-body">
            <form class="row g-4" action="{{ route('admin.savemandiprice') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id"
                    @if (isset($crop_price)) value="{{ $crop_price->id }}" @else value="0" @endif>
                <!-- Input item -->
                <div class="col-12">
                    <label class="form-label">Crop Name</label><span class="asktrick_label"> *</span>
                    <input type="text" class="form-control" placeholder="Crop Name" name="cropname"
                        @if (isset($crop_price)) value="{{ $crop_price->cropname }}" @endif>
                </div>
                <div class="col-12">
                    <label class="form-label">Crop Price</label><span class="asktrick_label"> *</span>
                    <input type="text" class="form-control" placeholder="Crop Price per Quintal" name="cropprice"
                        @if (isset($crop_price)) value="{{ $crop_price->cropprice }}" @endif>
                </div>
                <div class="col-12">
                    <label class="form-label">Date</label><span class="asktrick_label"> *</span>
                    <input type="date" class="form-control" placeholder="Address" name="date"
                        @if (isset($crop_price)) value="{{ $crop_price->date }}" @endif>
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
