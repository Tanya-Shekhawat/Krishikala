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
        <div class="col-md-6 col-xxl-6">
            <div class="card card-body bg-purple bg-opacity-15 p-4 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="purecounter mb-0 fw-bold" data-purecounter-start="0" data-purecounter-end="{{count($user)}}"
                            data-purecounter-delay="200">0</h2>
                        <span class="mb-0 h6 fw-light">Total Users</span>
                    </div>
                    <div class="icon-lg rounded-circle bg-purple text-white mb-0"><i class="fas fa-user"></i></div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xxl-6">
            <div class="card card-body bg-warning bg-opacity-10 p-4 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="purecounter mb-0 fw-bold" data-purecounter-start="0" data-purecounter-end="{{count($pending_users)}}"
                            data-purecounter-delay="200">0</h2>
                        <span class="mb-0 h6 fw-light">Pending Users</span>
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
                        <th>Serial No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Area</th>
                        <th>Account Verified</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $index = 0;
                    @endphp
                    @foreach ($user as $item)
                        @php ++$index; @endphp
                        <tr>
                            <td>{{ $index }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->area }}</td>
                            <td>
                                <div class="form-check form-switch form-check-md mb-0">
                                    <input class="form-check-input" type="checkbox" id="tab_{{ $item->id }}"
                                        @if ($item->is_confirmed == 1) @checked(true) @endif
                                        onclick="changeStatus('users','is_confirmed','{{ $item->id }}')"
                                        data-status="{{ $item->is_confirmed }}">
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </section>
@endsection
