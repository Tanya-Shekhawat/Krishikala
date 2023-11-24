@extends('layouts.header_footer')

@section('main_content')
    <style>
        .container-box-shadow {
            width: 270px;
            border: 2px solid #888484;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
    <div style="margin-top: 150px;" class="category__container container grid">

        <div class="container-box-shadow">
            <a href="{{route('cropmanual')}}">
                <div class="category__data">
                    <img src="{{ asset('assets/assets/img/g1.png') }}" alt="" class="category__img">
                    <h3 class="category__title">Crop User Manual</h3>
                </div>
            </a>
        </div>

        <div class="container-box-shadow">
            <a href="{{route('fertilizermanual')}}">
                <div class="category__data">
                    <img src="{{ asset('assets/assets/img/g2.png') }}" alt="" class="category__img">
                    <h3 class="category__title">Fertilizer User Manual </h3>
                </div>
            </a>
        </div>

        <div class="container-box-shadow">
            <a href="{{route('diseasemanual')}}">
                <div class="category__data">
                    <img src="{{ asset('assets/assets/img/g3.png') }}" style="height: 30%;" alt=""
                        class="category__img" style="height: 170px;">
                    <h3 class="category__title">Disease User Manual </h3>
                </div>
            </a>
        </div>
    </div>

    <br><br>

    <div style="margin-bottom: 40px;" class="category__container container grid">
        <div class="container-box-shadow">
            <a href="{{route('loginregistermanual')}}">
                <div class="category__data">
                    <img src="{{ asset('assets/assets/img/loginregister.png') }}" alt="" class="category__img">
                    <h3 class="category__title">Login/Register User Manual</h3>
                </div>
            </a>
        </div>

        <div class="container-box-shadow">
            <a href="{{route('fertilizermanual')}}">
                <div class="category__data">
                    <img src="{{ asset('assets/assets/img/mr.png') }}" alt="" class="category__img">
                    <h3 class="category__title">Manage Record</h3>
                </div>
            </a>
        </div>

        <div class="c{{route('diseasemanual')}}">
                <div class="category__data">
                    <img src="{{ asset('assets/assets/img/profit.png') }}" style="height: 30%;" alt=""
                        class="category__img" style="height: 170px;">
                    <h3 class="category__title">Analyse Profit Day to Day</h3>
                </div>
            </a>
        </div>
    </div>
@endsection
