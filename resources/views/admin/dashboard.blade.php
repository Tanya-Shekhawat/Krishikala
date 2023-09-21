@extends('admin.layouts.adminlayout')

@section('title')
    Admin Dashboard
@endsection

@section('content')
    <div class="row">
        <div class="col-12 mb-3">
            <h1 class="h3 mb-2 mb-sm-0">Admin Dashboard</h1>
        </div>
    </div>
    <div class="row g-4 mb-4">
        <div class="col-md-6 col-xxl-3">
            <div class="card card-body bg-purple bg-opacity-15 p-4 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="purecounter mb-0 fw-bold" data-purecounter-start="0"
                            data-purecounter-end="{{ count($appointments) }}" data-purecounter-delay="200">0</h2>
                        <span class="mb-0 h6 fw-light">Total Appointments</span>
                    </div>
                    <div class="icon-lg rounded-circle bg-purple text-white mb-0"><i class="fas fa-user"></i></div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xxl-3">
            <div class="card card-body bg-warning bg-opacity-10 p-4 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="purecounter mb-0 fw-bold" data-purecounter-start="0"
                            data-purecounter-end="{{ count($pending_appoin) }}" data-purecounter-delay="200">0</h2>
                        <span class="mb-0 h6 fw-light">Pending Appointments</span>
                    </div>
                    <div class="icon-lg rounded-circle bg-warning text-white mb-0"><i class="fas fa-calendar-check"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="appointments">
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
    </section>
@endsection
