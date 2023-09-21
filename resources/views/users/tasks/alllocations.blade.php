@extends('users.layouts.userlayout')

@section('title')
    User Tasks Page
@endsection

@section('content')
    <section class="mt-5">
        <div class="container">
            <!-- Title -->
            <div class="row mb-4" style="margin-top: -60px">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="fs-1">Today's Shift</h2>
                </div>
            </div>

            <!-- Tabs START -->
            <ul class="nav nav-pills nav-pills-bg-soft justify-content-sm-center mb-4 px-3" id="course-pills-tab"
                role="tablist">
                <!-- Tab item -->
                <li class="nav-item me-2 me-sm-5">
                    <button class="nav-link mb-2 mb-md-0 active" id="course-pills-tab-1" data-bs-toggle="pill"
                        data-bs-target="#course-pills-tabs-1" type="button" role="tab"
                        aria-controls="course-pills-tabs-1" aria-selected="false">Pervious Shift</button>
                </li>
                <!-- Tab item -->
                <li class="nav-item me-2 me-sm-5">
                    <button class="nav-link mb-2 mb-md-0" id="course-pills-tab-2" data-bs-toggle="pill"
                        data-bs-target="#course-pills-tabs-2" type="button" role="tab"
                        aria-controls="course-pills-tabs-2" aria-selected="false">Current Shift</button>
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
                                    <th>Time Slot</th>
                                    <th>Assigned By</th>
                                    <th>Station Name</th>
                                    <th>Station Pincode</th>
                                    <th>Station Address</th>
                                    <th>Assigned Address</th>
                                    <th>Assigned Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $index = 0;
                                @endphp
                                @foreach ($incompleted_task as $item)
                                    @php ++$index; @endphp
                                    <tr>
                                        <td>{{ $index }}</td>
                                        <td>{{ $item->time_slot }}</td>
                                        <td>{{ $item->assigned_date }}</td>
                                        <td>{{ App\Models\PoliceStation::find($item->main_station_name)->name }}</td>
                                        <td>{{ $item->main_station_pincode }}</td>
                                        <td>{{ $item->main_station_address }}</td>
                                        <td>{{ $item->assigned_address }}</td>
                                        <td>{{ date('d M, Y') }}</td>
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
                                    <th>Time Slot</th>
                                    <th>Assigned By</th>
                                    <th>Station Name</th>
                                    <th>Station Pincode</th>
                                    <th>Station Address</th>
                                    <th>Assigned Address</th>
                                    <th>Assigned Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $index = 0;
                                @endphp
                                @foreach ($completed_task as $item)
                                    @php ++$index; @endphp
                                    <tr>
                                        <td>{{ $index }}</td>
                                        <td>{{ $item->time_slot }}</td>
                                        <td>{{ $item->assigned_date }}</td>
                                        <td>{{ App\Models\PoliceStation::find($item->main_station_name)->name }}</td>
                                        <td>{{ $item->main_station_pincode }}</td>
                                        <td>{{ $item->main_station_address }}</td>
                                        <td>{{ $item->assigned_address }}</td>
                                        <td>{{ date('d M, Y') }}</td>
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
