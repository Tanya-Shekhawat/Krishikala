@extends('layouts.header_footer')

@section('main_content')
    <div style="-10px" class="bradcam_area breadcam_bg-green">
        <div class="container">
            <div class="row">
                <br><br><br>
                <div class="col-lg-12">
                    <div class="bradcam_text text-center">
                        <!-- <h3 style="color: rgb(248, 244, 244);">Disease Prediction</h3> -->
                    </div>
                </div>
            </div>
        </div>
    </div>


    <br>
    <section class="section about" id="about">
        <div class="about__container container grid">
            <div class="about__data">
                <h2 class="section__title about__title">About <br> Us......</h2>
                <p class="about__description">At KrashiKala, we are dedicated to revolutionizing agriculture through
                    technology-driven solutions. Our platform offers cutting-edge features such as Crop Recommendation,
                    Fertilizer Recommendation, and Plant Disease Prediction, all backed by advanced algorithms and real-time
                    data. With the added capability to efficiently Manage Records, we empower farmers with the tools they
                    need to thrive in today's dynamic farming landscape."
                </p>
                <!-- <a href="#" class="button">Know more</a> -->
            </div>

            <img src="{{asset('assets/assets/img/ab.jpeg')}}" alt="" class="about__img">
        </div>
    </section>
@endsection
