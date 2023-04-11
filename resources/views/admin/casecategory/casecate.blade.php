@extends('admin.layouts.adminlayout')

@section('title')
    Admin Case Category View Page
@endsection

@section('content')
    <div class="card shadow">
        <div class="card-header border-bottom d-sm-flex justify-content-between align-items-center">
            <h5 class="card-header-title mb-0">Station Officer Page</h5>
            <a href="{{ route('admin.managecasecate') }}" class="btn btn-sm btn-primary mb-0">Add new Case Category</a>
        </div>
        <div class="card-body">
            <table id="example1" class="border">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $index = 0;
                    @endphp
                    @foreach ($case_category as $item)
                        @php ++$index; @endphp
                        <tr>
                            <td>{{ $index }}</td>
                            <td>{{ $item->cate_name }}</td>
                            <td>
                                <div class="form-check form-switch form-check-md mb-0">
                                    <input class="form-check-input" type="checkbox" id="tab_{{ $item->id }}"
                                        @if ($item->status == 1) @checked(true) @endif
                                        onclick="changeStatus('case_categories','status','{{ $item->id }}')"
                                        data-status="{{ $item->status }}">
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('admin.managecasecate.edit', ['id' => $item->id]) }}"
                                    class="btn btn-success-soft btn-round me-1 mb-1 mb-md-0" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="" data-bs-original-title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <button onclick="deleteDataDb('{{$item->id}}','case_categories')"
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
