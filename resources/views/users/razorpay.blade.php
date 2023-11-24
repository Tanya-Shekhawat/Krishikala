@extends('layouts.header_footer')

@section('title')
    Razorpay Payment
@endsection

@section('main_content')
    @php
        $userinfo = \App\Models\Appointment::where(['id' => session()->get('appoint_id')])->get();
    @endphp

    {{-- {{dd($userinfo[0]->fname)}} --}}

    <style>
        .razorpay-payment-button {
            display: none;
        }
    </style>
    <!-- Breacrumb Area -->
    <div class="breadcrumb-area" data-black-overlay="7">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1">
                    <div class="cr-breadcrumb text-center">
                        <h1>Order Payment</h1>
                        <button class="btn btn-success btn-lg text-center" onclick="refreshpage()">
                            Pay {{ session()->get('total_amount') }}
                        </button>
                    </div>
                </div>
                <div class="panel-body text-center">
                    <form action="{{ route('saverazorpay') }}" id="payment_form" method="POST" name="f1">
                        @csrf

                        <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ env('RAZORPAY_KEY') }}"
                            data-amount=<?= session()->get('total_amount') * 100 ?> data-name="Cure For Sure"
                            data-description="Appointment Booking Payment" data-image="{{ url('storage/app/') }}"
                            data-prefill.name="{{ $userinfo[0]->fname }}" data-prefill.email="{{ $userinfo[0]->gmail }}"
                            data-theme.color="#5143d9">
                        </script>
                        <input type="hidden" name="amount" value="{{ session()->get('total_amount') }}">
                        <input type="hidden" name="booking_id" value="{{ session()->get('appoint_id') }}">

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--// Breacrumb Area -->
@endsection


@section('javascript')
    <script>
        $('#payment_form').submit();
    </script>
    <script>
        function refreshpage() {
            location.reload();
        }
    </script>
@endsection
