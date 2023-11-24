@extends('users.layouts.userlayout')

@section('title')
    User Dashboard
@endsection

@section('content')

    <h5>Season currently you are in</h5>
    <div class="row">
        @foreach ($seasons as $item)
            <div class="col-6 col-sm-4 mb-5">
                <a href="{{route('user.getcrops',['season'=>$item->season])}}">
                    <div class="dashboard_box">
                        <i class="bi bi-pencil-square dashboard_icons text-center"></i>
                        <h5>{{$item->season}}</h5>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
    {{-- <div id="activeChartstudent"></div> --}}
    <h5>Your total Expense</h5>
    <div id="ChartTrafficRooms"></div>


    <div class="prices mt-3">
        <h5>Mandi Crop Prices</h5>
        <table class="table table-hover">
            <tr>
                <th>Serial ID</th>
                <th>Crop Name</th>
                <th>Crop Price</th>
                <th>Date</th>
            </tr>
            @php
                $index = 0;
            @endphp
            @foreach ($mandiprice as $item)
                <tr>
                    <td>{{++$index}}</td>
                    <td>{{$item->cropname}}</td>
                    <td>{{$item->cropprice}}</td>
                    <td>{{$item->date}}</td>
                </tr>
            @endforeach
        </table>
        {{$mandiprice->links()}}
    </div>

@endsection
