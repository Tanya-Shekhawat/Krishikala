@extends('users.layouts.userlayout')

@section('title')
    User Tasks Page
@endsection

@section('content')
    <section>
        <div class="container">
            <!-- Title -->
            <div class="row mb-4" style="margin-top: -60px">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="fs-1">Task Details</h2>
                </div>
            </div>

            <!-- Tabs START -->
            <ul class="nav nav-pills nav-pills-bg-soft justify-content-sm-center mb-4 px-3" id="course-pills-tab"
                role="tablist">
                <!-- Tab item -->
                <li class="nav-item me-2 me-sm-5">
                    <button class="nav-link mb-2 mb-md-0 active" id="course-pills-tab-1" data-bs-toggle="pill"
                        data-bs-target="#course-pills-tabs-1" type="button" role="tab"
                        aria-controls="course-pills-tabs-1" aria-selected="false">Pending Tasks</button>
                </li>
                <!-- Tab item -->
                <li class="nav-item me-2 me-sm-5">
                    <button class="nav-link mb-2 mb-md-0" id="course-pills-tab-2" data-bs-toggle="pill"
                        data-bs-target="#course-pills-tabs-2" type="button" role="tab"
                        aria-controls="course-pills-tabs-2" aria-selected="false">Completed Tasks</button>
                </li>
            </ul>
            <!-- Tabs END -->

            <!-- Tabs content START -->
            <div class="tab-content" id="course-pills-tabContent">
                <!-- Content START -->
                <div class="tab-pane fade show active" id="course-pills-tabs-1" role="tabpanel"
                    aria-labelledby="course-pills-tab-1">
                    <div class="container-fluid">
                        <table id="example3" class="border">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Station Name</th>
                                    <th>Case Category</th>
                                    <th>Assigned To</th>
                                    <th>Assigned By</th>
                                    <th>Assigned Date</th>
                                    <th>Completed Date</th>
                                    <th>Case Location</th>
                                    <th>User Message</th>
                                    <th>SHO Feedback</th>
                                    <th>Days Left</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $index = 0;
                                @endphp
                                @foreach ($incompleted_task as $items)
                                    @php ++$index; @endphp
                                    @foreach (getTaskById($items) as $item)
                                        <tr>
                                            <td>{{ $index }}</td>
                                            <td>{{ $item->station_name }}</td>
                                            <td>{{ App\Models\CaseCategory::find($item->case_category)->cate_name }}</td>
                                            <td>
                                                @foreach (json_decode($item->assigned_to) as $user_id)
                                                    @foreach (getInfoById('users', $user_id) as $user_name)
                                                        {{ $user_name->name }}
                                                    @endforeach
                                                @endforeach
                                            </td>
                                            <td>{{ $item->assigned_by }}</td>
                                            <td>{{ $item->assigned_date }}</td>
                                            <td>{{ $item->completed_date }}</td>
                                            <td>{{ $item->case_location }}</td>
                                            <td>{{ $item->user_message }}</td>
                                            <td>{{ $item->feedback }}</td>
                                            <td>{{ findLeftDays($item->task_priority, $item->assigned_date) }} </td>
                                            <td>@if ($item->status == "NotCompleted")
                                                Not Completed
                                            @endif</td>
                                            <td>
                                                <a href="{{ route('user.updatetask', ['id' => $item->id]) }}"
                                                    class="btn btn-success-soft btn-round me-1 mb-1 mb-md-0"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Update">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Content END -->

                <!-- Content START -->
                <div class="tab-pane fade" id="course-pills-tabs-2" role="tabpanel" aria-labelledby="course-pills-tab-2">
                    <div class="container-fluid">
                        <table id="example1" class="border">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Station Name</th>
                                    <th>Case Category</th>
                                    <th>Assigned To</th>
                                    <th>Assigned By</th>
                                    <th>Assigned Date</th>
                                    <th>Completed Date</th>
                                    <th>Case Location</th>
                                    <th>User Message</th>
                                    <th>SHO Feedback</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $index = 0;
                                @endphp
                                @foreach ($completed_task as $items)
                                    @php ++$index; @endphp
                                    @foreach (getTaskById($items) as $item)
                                        <tr>
                                            <td>{{ $index }}</td>
                                            <td>{{ $item->station_name }}</td>
                                            <td>{{ App\Models\CaseCategory::find($item->case_category)->cate_name }}</td>
                                            <td>
                                                @foreach (json_decode($item->assigned_to) as $user_id)
                                                    @foreach (getInfoById('users', $user_id) as $user_name)
                                                        {{ $user_name->name }}
                                                    @endforeach
                                                @endforeach
                                            </td>
                                            <td>{{ $item->assigned_by }}</td>
                                            <td>{{ $item->assigned_date }}</td>
                                            <td>{{ $item->completed_date }}</td>
                                            <td>{{ $item->case_location }}</td>
                                            <td>{{ $item->user_message }}</td>
                                            <td>{{ $item->feedback }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>
                                                <a href="{{ route('user.updatetask', ['id' => $item->id]) }}"
                                                    class="btn btn-success-soft btn-round me-1 mb-1 mb-md-0"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Content END -->

            </div>
            <!-- Tabs content END -->
        </div>
    </section>
    <!-- =======================
            Popular course END -->
@endsection
