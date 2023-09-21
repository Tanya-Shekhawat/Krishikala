@extends('users.layouts.userlayout')

@section('title')
    User Task Update Page
@endsection

@section('content')
    <div class="card shadow">

        <div class="card-header border-bottom d-sm-flex justify-content-between align-items-center">
            <h5 class="card-header-title mb-0">User Task Update Page</h5>
            <a href="{{ route('user.mytasks') }}" class="btn btn-danger mb-0">Back</a>
        </div>

        <!-- Card body START -->
        <div class="card-body">
            <form class="row g-4" action="{{ route('user.saveupdatetask') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id"
                    @if (isset($task_details)) value="{{ $task_details->id }}" @else value="0" @endif>

                {{-- Station Name --}}
                <div class="col-6">
                    <label class="form-label">Enter Police Station Name</label><span class="asktrick_label"> *</span>
                    <input type="text" class="form-control" placeholder="Enter Police Station Name" name="station_name"
                        @if (isset($task_details)) value="{{ $task_details->station_name }}" 
                        @else value="{{ getStationNameById($station_details->station_name, 'name') }}" @endif
                        readonly>
                </div>

                {{-- Case Category Name --}}
                <div class="col-6">
                    <label class="form-label">Select Case Category</label><span class="asktrick_label"> *</span>
                    <select name="case_category" class="form-control" @readonly(true)>
                        <option value="" disabled selected>{{ App\Models\CaseCategory::find($task_details->case_category)->cate_name }}</option>
                    </select>
                </div>

                {{-- Staff Name --}}
                <div class="col-6">
                    <label class="form-label">Select Staff Name</label><span class="asktrick_label"> *</span>
                    <input name="assigned_to[]" class="form-control" multiple size="2"
                    @if (isset($task_details))
                    value="@foreach (json_decode($task_details->assigned_to) as $user_id) {{App\Models\User::find($user_id)->name }} ,@endforeach"
                    @endif readonly>
                </div>

                {{-- Station Officer Name --}}
                <div class="col-6">
                    <label class="form-label">Enter Police Station Officer Name</label><span class="asktrick_label">
                        *</span>
                    <input type="text" class="form-control" placeholder="Enter Police Station Officer Name"
                        name="assigned_by"
                        @if (isset($task_details)) value="{{ $task_details->assigned_by }}" 
                        @else value="{{ $station_details->name }}" @endif
                        readonly>
                </div>

                {{-- Task Assigned Date --}}
                <div class="col-6">
                    <label class="form-label">Enter Station Task Assigned Date</label><span class="asktrick_label"> *</span>
                    <input type="date" class="form-control" placeholder="Enter Station Task Assigned Date"
                        name="assigned_date"
                        @if (isset($task_details)) value="{{ $task_details->assigned_date }}" @endif readonly>
                </div>

                {{-- Task Location --}}
                <div class="col-6">
                    <label class="form-label">Enter Task Location</label><span class="asktrick_label"> *</span>
                    <input type="text" class="form-control" placeholder="Enter Task Location" name="case_location"
                        @if (isset($task_details)) value="{{ $task_details->case_location }}" @endif readonly>
                </div>

                {{-- Task Feedback --}}
                <div class="col-6">
                    <label class="form-label">Enter Task Feedback</label><span class="asktrick_label"> *</span>
                    <input type="text" class="form-control" placeholder="Enter Task Feedback" name="feedback"
                        @if (isset($task_details)) value="{{ $task_details->feedback }}" @endif readonly>
                </div>

                {{-- Task Description --}}
                <div class="col-12">
                    <label class="form-label">Enter Task Description</label><span class="asktrick_label"> *</span>
                    <textarea name="case_description" readonly>@if (isset($task_details)){{ $task_details->case_description }}@endif </textarea>
                </div>

                <hr>
                <h6>Please Fill this fields to notify your Task to Admin</h6>
                {{-- Task Completed Date --}}
                <div class="col-6">
                    <label class="form-label">Enter Station Task Completed Date</label><span class="asktrick_label">*</span>
                    <input type="date" class="form-control" placeholder="Enter Station Task Completed Date" name="completed_date"
                        @if (isset($task_details)) value="{{ $task_details->completed_date }}" @endif>
                </div>

                <div class="col-6">
                    <label class="form-label">Task Status</label><span class="asktrick_label"> *</span>
                    <select name="status" class="form-control">
                        <option value="Completed" selected>Completed</option>
                        <option value="NotCompleted" selected>Not Completed</option>
                    </select>
                </div>

                {{-- Staff Message --}}
                <div class="col-12">
                    <label class="form-label">Staff Message</label><span class="asktrick_label"> *</span>
                    <input type="text" class="form-control" placeholder="Staff Message" name="staff_message"
                        @if (isset($task_details)) value="{{ $task_details->user_message }}" @endif>
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
