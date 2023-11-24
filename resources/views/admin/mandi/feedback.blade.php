@extends('admin.layouts.adminlayout')

@section('title')
    Feedback
@endsection

@section('content')
    <div class="card shadow">
        <div class="card-header border-bottom d-sm-flex justify-content-between align-items-center">
            <h5 class="card-header-title mb-0">Feedback</h5>
            <a href="{{ route('admin.managefeedback') }}" class="btn btn-sm btn-primary mb-0">Add new User Feedback</a>
        </div>
        <div class="card-body">
            <table id="example1" class="border">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User Name</th>
                        <th>Feedback</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $index = 0;
                    @endphp
                    @foreach ($feedback as $item)
                        @php ++$index; @endphp
                        <tr>
                            <td>{{ $index }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->feedback }}</td>
                            <td>{{ $item->date }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
