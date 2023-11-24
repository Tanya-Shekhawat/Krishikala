@extends('admin.layouts.adminlayout')

@section('title')
    Appointments
@endsection

@section('content')
    <div class="card shadow">
        <div class="card-header border-bottom d-sm-flex justify-content-between align-items-center">
            <h5 class="card-header-title mb-0">Appointments</h5>
            <a href="{{ route('admin.manageappointment') }}" class="btn btn-sm btn-primary mb-0">Add new Appointments</a>
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
                        <th>Timeslot</th>
                        <th>Cofirmed</th>
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
                            <td>{{ $item->timeslot }}</td>
                            <td>
                                @if ($item->stat == 0)
                                    <a href="{{ route('admin.confirmappointment', ['id' => $item->id]) }}"
                                        class="btn btn-success btn-sm">
                                        Confirm
                                    </a>
                                @else
                                    <a href="{{route('admin.recipt', ['id' => $item->id]) }}" class="btn btn-info btn-sm" @disabled(true)>
                                        View Recipt
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
