@extends('users.layouts.userlayout')

@section('title')
    Manage Crop Expense
@endsection

@section('content')
    <div class="card shadow">

        <div class="card-header border-bottom d-sm-flex justify-content-between align-items-center">
            <h5 class="card-header-title mb-0">Manage Crop Expense Page</h5>
            <a href="{{ route('user.mycrops') }}" class="btn btn-danger mb-0">Back</a>
        </div>

        <!-- Card body START -->
        <div class="card-body text-dark">
            <form class="row g-4" action="{{ route('user.saveexpense') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{$seasoncropdetails->user_id}}"
                    @if (isset($crop_expense)) value="{{ $crop_expense->id }}" @else value="0" @endif>
                <input type="hidden" name="crop_id" value="{{$seasoncropdetails->id}}"
                    @if (isset($crop_expense)) value="{{ $crop_expense->id }}" @else value="0" @endif>
                <!-- Input item -->
                <div class="col-12">
                    <label class="form-label">Fertilizer Cost</label><span class="asktrick_label"> *</span>
                    <input type="text" class="form-control" placeholder="Fertilizer Cost" name="fertilizer_price" value="{{ $seasoncropdetails->fertilizer_price }}"
                        @if (isset($crop_expense)) value="{{ $crop_expense->fertilizer_price }}" @endif>
                </div>
                <div class="col-12">
                    <label class="form-label">Seeds Cost</label><span class="asktrick_label"> *</span>
                    <input type="text" class="form-control" placeholder="Seeds Cost" name="seed_price" value="{{ $seasoncropdetails->seed_price }}"
                        @if (isset($crop_expense)) value="{{ $crop_expense->seed_price }}" @endif>
                </div>
                <div class="col-12">
                    <label class="form-label">Labour Cost</label><span class="asktrick_label"> *</span>
                    <input type="text" class="form-control" placeholder="labour Cost" name="labour_price" value="{{ $seasoncropdetails->labour_price }}"
                        @if (isset($crop_expense)) value="{{ $crop_expense->labour_price }}" @endif>
                </div>
                <div class="col-12">
                    <label class="form-label">Harvesting Cost</label><span class="asktrick_label"> *</span>
                    <input type="text" class="form-control" placeholder="Harvesting Cost" name="harvesting_price" value="{{ $seasoncropdetails->harvesting_price }}"
                        @if (isset($crop_expense)) value="{{ $crop_expense->harvesting_price }}" @endif>
                </div>
                <div class="col-12">
                    <label class="form-label">Date</label><span class="asktrick_label"> *</span>
                    <input type="date" class="form-control" placeholder="Address" name="date"
                        @if (isset($crop_expense)) value="{{ $crop_expense->date }}" @endif>
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
