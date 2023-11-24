@extends('users.layouts.userlayout')

@section('title')
    User Crop Details
@endsection

@section('content')
    <style>
        #example1 thead th {
            font-weight: 500
        }

        #example1 thead th span {
            font-weight: 400;
            font-size: 12px;
            color: rgb(104, 104, 104);
        }
    </style>
    <div class="container-fluid mt-3">
        <table id="example1" class="border text-dark">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Season Name</th>
                    <th>Crop Name</th>
                    <th>Area sown <span>(In acres)</span></th>
                    <th>Expected Crop Produced <span>(In quintals)</span></th>
                    <th>Expenses</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $index = 0;
                @endphp
                @foreach ($seasoncropdetails as $item)
                    @php ++$index; @endphp
                    <tr>
                        <td>{{ $index }}</td>
                        <td>{{ $item->season }}</td>
                        <td>{{ $item->crops }}</td>
                        <td>{{ $item->area }}</td>
                        <td>{{ $item->cropamount }}</td>
                        <td>
                            <a href="{{ route('user.cropexpenses', ['id' => $item->id]) }}"
                                class="btn btn-info-soft btn-round me-1 mb-1 mb-md-0" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="" data-bs-original-title="Add Expenses">
                                <i class="bi bi-currency-rupee"></i>
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('user.cropdetails', ['id' => $item->id]) }}"
                                class="btn btn-success-soft btn-round me-1 mb-1 mb-md-0" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="" data-bs-original-title="View Details">
                                <i class="bi bi-ticket-detailed"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
