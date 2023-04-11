@extends('admin.layouts.adminlayout')

@section('title')
    Admin Officer View Page
@endsection

@section('content')
    <div class="card shadow">
        <div class="card-header border-bottom d-sm-flex justify-content-between align-items-center">
            <h5 class="card-header-title mb-0">Station Officer Page</h5>
            <a href="{{ route('admin.manageallstations') }}" class="btn btn-sm btn-primary mb-0">Add a new Police Station</a>
        </div>
        <div class="card-body">
            <table id="example1" class="border">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Station Name</th>
                        <th>Station Address</th>
                        <th>Station Pincode</th>
                        <th>Station Number</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $index = 0;
                    @endphp
                    @foreach ($police_station as $item)
                        @php ++$index; @endphp
                        <tr>
                            <td>{{ $index }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->address }}</td>
                            <td>{{ $item->pincode }}</td>
                            <td>{{ $item->number }}</td>
                            <td>
                                <a href="{{ route('admin.manageallstations.edit', ['id' => $item->id]) }}"
                                    class="btn btn-success-soft btn-round me-1 mb-1 mb-md-0" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="" data-bs-original-title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <button onclick="deleteDataDb('{{$item->id}}','police_stations')"
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
