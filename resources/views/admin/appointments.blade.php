@extends('admin.layouts.adminlayout')

@section('title')
    Appointments
@endsection

@section('content')
    <div class="card shadow">
        <div class="card-header border-bottom d-sm-flex justify-content-between align-items-center">
            <h5 class="card-header-title mb-0">Coupon Page</h5>
            <a href="{{ route('admin/manageappointment') }}" class="btn btn-sm btn-primary mb-0">Add new Appointments</a>
        </div>
        <div class="card-body">
            <table id="example1" class="border">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pateint Name</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>Date</th>
                        <th>Cofirmed</th>
                        <th>Timeslot</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $index = 0;
                    @endphp
                    @foreach ($appointments as $item)
                        @php ++$index; @endphp
                        <tr>
                            <td>{{ $index }}</td>
                            <td>{{ $item->fname }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->gender }}</td>
                            <td>{{ $item->date }}</td>
                            <td>
                                <div class="form-check form-switch form-check-md mb-0">
                                    <input class="form-check-input" type="checkbox" id="tab_{{ $item->id }}"
                                        @if ($item->stat == 1) @checked(true) @endif
                                        onclick="changeStatus('appointments','stat','{{ $item->id }}')"
                                        data-status="{{ $item->stat }}",>
                                </div>
                            </td>
                            <td>{{ $item->timeslot }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
