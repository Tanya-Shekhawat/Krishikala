@extends('officer.layouts.officerlayout')

@section('title')
    Officer Staff Page
@endsection

@section('content')
    <div class="card shadow">
        <div class="card-header border-bottom d-sm-flex justify-content-between align-items-center my-2">
            <h5 class="card-header-title mb-0">Station Officer Page</h5>
            <a href="{{ route('officer.addstaffmember') }}" class="btn btn-info mb-0">Add new Staff</a>
        </div>

        <div class="container my-2">

            <table id="example1" class="border">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Station Name</th>
                        <th>Station Address</th>
                        <th>Station Pincode</th>
                        <th>Officer Post</th>
                        <th>Joining Date</th>
                        <th>Verified</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $index = 0;
                    @endphp
                    @foreach ($staff_members as $item)
                        @php ++$index; @endphp
                        <tr>
                            <td>{{ $index }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->station_name }}</td>
                            <td>{{ $item->station_address }}</td>
                            <td>{{ $item->station_pincode }}</td>
                            <td>{{ $item->post}}</td>
                            <td>{{ $item->joining_date}}</td>
                            <td>
                                <div class="form-check form-switch form-check-md mb-0">
                                    <input class="form-check-input" type="checkbox" id="tab3_{{ $item->id }}"
                                        @if ($item->is_verified == 1) @checked(true) @endif
                                        onclick="changeStatus('station_officers','is_verified','{{ $item->id }}')"
                                        data-status="{{ $item->is_verified }}">
                                </div>
                            </td>
                            <td>
                                <div class="form-check form-switch form-check-md mb-0">
                                    <input class="form-check-input" type="checkbox" id="tab_{{ $item->id }}"
                                        @if ($item->status == 1) @checked(true) @endif
                                        onclick="changeStatus('station_officers','status','{{ $item->id }}')"
                                        data-status="{{ $item->status }}">
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('officer.managestaff.edit', ['id' => $item->id]) }}"
                                    class="btn btn-success-soft btn-round me-1 mb-1 mb-md-0" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="" data-bs-original-title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <button onclick="deleteDataDb('{{$item->id}}','station_officers')"
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
