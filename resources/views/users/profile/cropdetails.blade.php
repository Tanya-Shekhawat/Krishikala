@extends('users.layouts.userlayout')

@section('title')
    User Crop Details
@endsection

@section('content')
    <style>
        .crop_details {
            color: black;
        }

        .crop_details h5 {
            display: inline-block;
        }

        .crop_details span {
            /* color: greenyellow; */
        }

        .profit_amount {
            color: green;
        }

        .loss_amount {
            color: red;
        }

        .expense_table th {
            font-weight: 500;
        }

        .box-shadow {
            box-shadow: 0 0 5px black;
        }
    </style>

    <div class="row crop_details mt-3">
        <div class="mx-3 card-header border-bottom d-sm-flex justify-content-between align-items-center">
            <h5 class="card-header-title mb-0" style="color: hsl(104, 28%, 35%);">Crop Details</h5>
            <a href="{{ route('user.mycrops') }}" class="btn btn-danger mb-0 me-5">Back</a>
        </div>
        {{-- @for ($i = 0; $i < count($expenses); $i++) --}}
        <div class="row box-shadow rounded ms-3 me-5 p-4 px-2 my-3">
            <div class="col-6">
                <h5>Crop Name: </h5>
                <span>{{ $seasoncrop->crops }}</span>
            </div>
            <div class="col-6">
                <h5>Crop Season: </h5>
                <span>{{ $seasoncrop->season }}</span>
            </div>
            <div class="col-12">
                <h5>Expense: </h5>
                <table class="table table-hover expense_table">
                    <tr>
                        <th>Serial ID</th>
                        <th>Date</th>
                        <th>Fertilizers</th>
                        <th>Seeds</th>
                        <th>Labour</th>
                        <th>Harvesting</th>
                        <th>Total Expense</th>
                        <th>Expected Profit</th>
                    </tr>
                    @php
                        $index = 0;
                    @endphp
                    @foreach ($expenses as $item)
                        <tr>
                            @php
                                $total = $item->fertilizer_price + $item->seed_price + $item->labour_price + $item->harvesting_price;
                                $profit = $revenue - $total;
                            @endphp
                            <td>{{ ++$index }}</td>
                            <td class="fw-bold">{{ $item->date }}</td>
                            <td>{{ indianCurrency($item->fertilizer_price) }}</td>
                            <td>{{ indianCurrency($item->seed_price) }}</td>
                            <td>{{ indianCurrency($item->labour_price) }}</td>
                            <td>{{ indianCurrency($item->harvesting_price) }}</td>
                            <td>{{ indianCurrency($total) }}</td>
                            <td>{{ indianCurrency($profit) }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="col-6">
                <h5>Revenue: </h5>
                <span>{{ indianCurrency($revenue) }}</span>
            </div>
            <div class="col-6">
                @if ($profit_status == 1)
                    <h5>Current Profit: </h5>
                    <span class="profit_amount">{{ indianCurrency($con_profit) }}</span>
                @else
                    <h5>Current Loss: </h5>
                    <span class="loss_amount">{{ indianCurrency($profit) }}</span>
                @endif
            </div>
        </div>
        {{-- @endfor --}}
    </div>
@endsection

@section('javascript')
    <script>
        // let user_id = $("#user_id");
        // $(document).ready(function() {
        //     window.addEventListner("load", getUserDashboardChart())
        //     function getUserDashboardChart () {
        //         alert("called")
        //       $.ajax({
        //         type: "get",
        //         url: "dashboard_charts",
        //         data: { 'user_id': user_id },
        //         success: function (response) {
        //           var cpv = e.select('#ChartTrafficRooms');
        //           if (e.isVariableDefined(cpv)) {
        //             // CHART: Page Views
        //             var options = {
        //               // series: [response[0], response[1]],
        //               series: [{
        //                 data: [{
        //                   x: 'Fertilizers',
        //                   y: 10
        //                 }, {
        //                   x: 'Seeds',
        //                   y: 18
        //                 }, {
        //                   x: 'Labour',
        //                   y: 13
        //                 }, {
        //                   x: 'Harvesting',
        //                   y: 1
        //                 }]
        //               }],
        //               // labels: ['Sold Out', 'Available'],
        //               chart: {
        //                 // height: 300,
        //                 // width: 300,
        //                 type: 'bar',
        //                 // sparkline: {
        //                 //   enabled: !0
        //                 // }
        //               },
        //               plotOptions: {
        //                 bar: {
        //                   horizontal: true
        //                 }
        //               },
        //               colors: [
        //                 ThemeColor.getCssVariableValue('--bs-danger'),
        //                 ThemeColor.getCssVariableValue('--bs-success')
        //               ],
        //               tooltip: {
        //                 theme: "dark"
        //               },
        //               responsive: [{
        //                 breakpoint: 480,
        //                 options: {
        //                   chart: {
        //                     width: 200,
        //                     height: 200,
        //                   },
        //                   legend: {
        //                     position: 'bottom'
        //                   }
        //                 }
        //               }]
        //             };
        //             var chart = new ApexCharts(document.querySelector("#ChartTrafficRooms"), options);
        //             chart.render();
        //           }
        //         }
        //       });
        //     }
        // });
    </script>
@endsection
