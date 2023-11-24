@extends('layouts.header_footer')

@section('title')
    Razorpay Payment
@endsection

@section('main_content')
    <main class="mt-5">
        <!--Start: Thanks Section -->
        <section style="color: black" class="mt-3">
            <div class="container d-flex justify-content-center align-item-center">
                <div class="block d-md-none">
                    <img src="http://localhost/CureForSure/public/assets/img/thanks-icon.png" alt="" class="thanks-img" />
                    <h5>Your Order has been placed Successfully.</h5>
                </div>
                <div class="wrap box-shadow text-center mt-5">
                    <div class="block d-none d-md-block">
                        <img src="http://localhost/CureForSure/public/assets/img/thanks-icon.png" alt=""
                            class="thanks-img text-center" />
                        <h5>Your Appointment is being booked successfully.</h5>
                    </div>
                    <h6>Thank you for Purchasing.</h6>
                    <h6>Your Order is waiting for Doctors confirmation.</h6>
                    <h4 class="text-dark">YOUR Trasaction ID IS {{ session()->get('transaction_id') }}</h4>
                    <p>You will get update about your appointment, on your registered email and phone number.</p>
                    <a href="http://127.0.0.1:5000/" target="_blank" class="btn btn-primary">Check your Disease</a>
                </div>
            </div>
        </section>
    </main>
@endsection
