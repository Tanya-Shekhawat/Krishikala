@extends('officer.layouts.officerlayout')

@section('title')
    Officer Task Page
@endsection

@section('content')
    <div class="card shadow">
        <div class="card-header border-bottom d-sm-flex justify-content-between align-items-center my-2">
            <h5 class="card-header-title mb-0">Station Officer Page</h5>
            <a href="{{ route('officer.addtasks') }}" class="btn btn-info mb-0">Add new Task</a>
        </div>

        <div class="container my-2">

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
                    @foreach ($tasks as $item)
                        @php ++$index; @endphp
                        <tr>
                            <td>{{ $index }}</td>
                            <td>{{ $item->station_name }}</td>
                            <td>{{ $item->case_category }}</td>
                            <td>
                                @foreach (json_decode($item->assigned_to) as $user_id)
                                    @foreach (getInfoById('users',$user_id) as $user_name)
                                        {{$user_name->name}}
                                    @endforeach
                                @endforeach
                            </td>
                            <td>{{ $item->assigned_by }}</td>
                            <td>{{ $item->assigned_date}}</td>
                            <td>{{ $item->completed_date}}</td>
                            <td>{{ $item->case_location}}</td>
                            <td>{{ $item->user_message}}</td>
                            <td>{{ $item->feedback}}</td>
                            <td>
                                <div class="form-check form-switch form-check-md mb-0">
                                    <input class="form-check-input" type="checkbox" id="tab_{{ $item->id }}"
                                        @if ($item->status == 1) @checked(true) @endif
                                        onclick="changeStatus('station_officers','status','{{ $item->id }}')"
                                        data-status="{{ $item->status }}">
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('officer.managetask.edit', ['id' => $item->id]) }}"
                                    class="btn btn-success-soft btn-round me-1 mb-1 mb-md-0" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="" data-bs-original-title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <button onclick="deleteDataDb('{{$item->id}}','tasks')"
                                    class="btn btn-danger-soft btn-round me-1 mb-1 mb-md-0" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="" data-bs-original-title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
