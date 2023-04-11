@extends('officer.layouts.officerlayout')

@section('title')
    Officer Add Staff Page
@endsection

@section('content')
    <div class="card shadow">

        <div class="card-header border-bottom d-sm-flex justify-content-between align-items-center">
            <h5 class="card-header-title mb-0">Station Staff Page</h5>
            <a href="{{ route('officer.tasks') }}" class="btn btn-danger mb-0">Back</a>
        </div>

        <!-- Card body START -->
        <div class="card-body">
            <form class="row g-4" action="{{ route('officer.savetasks') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id"
                    @if (isset($task_details)) value="{{ $task_details->id }}" @else value="0" @endif>

                {{-- Station Name --}}
                <div class="col-6">
                    <label class="form-label">Enter Police Station Name</label><span class="asktrick_label"> *</span>
                    <input type="text" class="form-control" placeholder="Enter Police Station Name" name="station_name"
                        @if (isset($task_details)) value="{{ $task_details->station_name }}" 
                        @else value="{{getStationNameById($station_details->station_name,'name')}}"
                        @endif readonly
                    >
                </div>

                {{-- Case Category Name --}}
                <div class="col-6">
                    <label class="form-label">Select Case Category</label><span class="asktrick_label"> *</span>
                    <select name="case_category" class="form-control">
                        <option value="" disabled selected>--Select Case Category--</option>
                        @foreach ($task_category as $items)
                            <option value="{{$items->id}}"
                                @if (isset($task_details)) @selected(true) @endif >
                                {{$items->cate_name}}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Staff Name --}}
                <div class="col-6">
                    <label class="form-label">Select Staff Name</label><span class="asktrick_label"> *</span>
                    <select name="assigned_to[]" class="form-control" multiple>
                        <option value="" disabled selected>--Select Staff Name--</option>
                        @foreach ($staff as $items1)
                            <option value="{{$items1->id}}"
                                @if (isset($task_details)) @selected(true) @endif >
                                {{$items1->name}}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Station Officer Name --}}
                <div class="col-6">
                    <label class="form-label">Enter Police Station Officer Name</label><span class="asktrick_label"> *</span>
                    <input type="text" class="form-control" placeholder="Enter Police Station Officer Name" name="assigned_by"
                        @if (isset($task_details)) value="{{ $task_details->assigned_by }}" 
                        @else value="{{$station_details->name}}"
                        @endif readonly
                    >
                </div>

                {{-- Task Assigned Date --}}
                <div class="col-6">
                    <label class="form-label">Enter Station Task Assigned Date</label><span class="asktrick_label"> *</span>
                    <input type="date" class="form-control" placeholder="Enter Station Task Assigned Date" name="assigned_date"
                        @if (isset($task_details)) value="{{ $task_details->assigned_date }}" @endif>
                </div>

                {{-- Task Completed Date --}}
                <div class="col-6">
                    <label class="form-label">Enter Station Task Completed Date</label><span class="asktrick_label"> *</span>
                    <input type="date" class="form-control" placeholder="Enter Station Task Completed Date" name="completed_date"
                        @if (isset($task_details)) value="{{ $task_details->completed_date }}" @endif>
                </div>

                {{-- Task Location --}}
                <div class="col-6">
                    <label class="form-label">Enter Task Location</label><span class="asktrick_label"> *</span>
                    <input type="text" class="form-control" placeholder="Enter Task Location" name="case_location"
                        @if (isset($task_details)) value="{{ $task_details->case_location }}" @endif >
                </div>

                {{-- Task Feedback --}}
                <div class="col-6">
                    <label class="form-label">Enter Task Feedback</label><span class="asktrick_label"> *</span>
                    <input type="text" class="form-control" placeholder="Enter Task Feedback" name="feedback"
                        @if (isset($task_details)) value="{{ $task_details->feedback }}" @endif >
                </div>

                {{-- Task Description --}}
                <div class="col-12">
                    <label class="form-label">Staff Message</label><span class="asktrick_label"> *</span>
                    <input type="text" class="form-control" placeholder="Staff Message" name="staff_message"
                        @if (isset($task_details)) value="{{ $task_details->user_message }}" @endif >
                </div>

                {{-- Task Description --}}
                <div class="col-12">
                    <label class="form-label">Enter Task Description</label><span class="asktrick_label"> *</span>
                    <textarea name="case_description">@if (isset($task_details)){{ $task_details->case_description }}@endif</textarea>
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
