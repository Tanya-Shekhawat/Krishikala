@extends('admin.layouts.adminlayout')

@section('title')
    Mandi Price
@endsection

@section('content')
    <div class="card shadow">
        <div class="card-header border-bottom d-sm-flex justify-content-between align-items-center">
            <h5 class="card-header-title mb-0">Mandi Price</h5>
            <a href="{{ route('admin.managemandiprice') }}" class="btn btn-sm btn-primary mb-0">Add new Mandi Price</a>
        </div>
        <div class="card-body">
            <table id="example1" class="border">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Crop name</th>
                        <th>Crop Price</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $index = 0;
                    @endphp
                    @foreach ($mandiprice as $item)
                        @php ++$index; @endphp
                        <tr>
                            <td>{{ $index }}</td>
                            <td>{{ $item->cropname }}</td>
                            <td>{{ indianCurrency($item->cropprice) }}</td>
                            <td>{{ $item->date }}</td>
                            <td>
                                <a href="{{ route('admin.managemandiprice.edit', ['id' => $item->id]) }}"
                                    class="btn btn-success-soft btn-round me-1 mb-1 mb-md-0" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="" data-bs-original-title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <button class="btn btn-danger-soft btn-round me-1 mb-1 mb-md-0" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Delete"
                                    onclick="deleteDataDb('{{$item->id}}','mandiprices')">
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
