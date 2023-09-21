@extends('layouts.header_footer')

@section('main_content')
    <main class="main">
        <!-- HOME -->
        <section class="home container" id="home">
            <div class="swiper home-swiper">
                <div class="swiper-wrapper">
                    <section class="swiper-slide">
                        <div class="home__content grid">
                            <div class="home__group">
                                <br><br><br><br>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <img src="http://localhost/CureForSure/public/assets/img/h1.png" alt="" class="home__img">
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="home__data">
                                            <h3 class="home__subtitle">Hello !</h3>
                                            <h1 class="home__title">Uuuuu <br> TRICK OR <br> TREAT!!</h1>
                                            <p class="home__description" style="color: black; font-weight: 600;">Lorem
                                                ipsum, dolor sit amet consectetur adipisicing elit. Quam eum, dicta fuga
                                                possimus optio vitae provident facilis,
                                                tempora, rem temporibus veniam modi corrupti doloremque sint qui velit nobis
                                                ab. Autem.
                                            </p>
                                            <div class="home__buttons">
                                                <button
                                                    style="margin-left: 100px; height: 45px; border-radius: 10px; box-shadow:  0 0 4px px;"
                                                    type="button" class="btn btn-warning">Book Appointment</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </section>
                </div>
            </div>
            <!--Container-->
            <div class="container">
                <div style=" text-align: center;">
                    <h1> Our Goal</h1>
                    <p style="padding-bottom: 20px;">Lorem ipsum dolor sit amet.</p>
                </div>
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-3">
                        <img class="col_img" src="http://localhost/CureForSure/public/assets/img/5.png" alt="">
                        <h6 style="margin-top: 30px; font-size: 1.2rem; font-weight: 700;">Appointment Booking</h6>
                    </div>
                    <div class="col-lg-3">
                        <img class="col_img" style="margin-left: 30px;" src="http://localhost/CureForSure/public/assets/img/3.png" alt="">
                        <h6 style="margin-top: 30px; font-size: 1.2rem; margin-left: 40px;"> Analysis</h3>
                    </div>
                    <div class="col-lg-3">
                        <img style="margin-left: 30px;" class="col_img"src="http://localhost/CureForSure/public/assets/img/4.png" alt="">
                        <h6 style="margin-top: 30px; font-size: 1.2rem; margin-left: 30px;"> Disease Prediction</h3>
                    </div>
                </div>
            </div>
            <section class="section trick" id="trick">
                <h2 class="section__title">Treat</h2>

                <div class="trick__container container grid">
                    <div class="trick__content">
                        <img src="http://localhost/CureForSure/public/assets/img/7.png" alt="" class="trick__img">
                        <h3 class="trick__title">Best Health</h3>
                        <span class="trick__subtitle">Care</span>
                        <span class="trick__price">lorem5</span>
                    </div>

                    <div class="trick__content">
                        <img src="http://localhost/CureForSure/public/assets/img/10.png" alt="" class="trick__img">
                        <h3 class="trick__title">Doctor</h3>
                        <span class="trick__subtitle">Allotment</span>
                        <span class="trick__price">Lorem ipsum dolor sit amet.</span>
                    </div>

                    <div class="trick__content">
                        <img src="http://localhost/CureForSure/public/assets/img/1.1.png" alt="" class="trick__img">
                        <h3 class="trick__title">Accept New </h3>
                        <span class="trick__subtitle">Technology</span>
                        <span class="trick__price">Lorem ipsum dolor sit amet.</span>
                    </div>

                    <div class="trick__content">
                        <img src="http://localhost/CureForSure/public/assets/img/11.png" alt="" class="trick__img">
                        <h3 class="trick__title">Emergency </h3>
                        <span class="trick__subtitle">Ambulance</span>
                        <span class="trick__price">Lorem ipsum dolor sit amet.</span>
                    </div>

                    <div class="trick__content">
                        <img src="http://localhost/CureForSure/public/assets/img/h2.png" alt="" class="trick__img">
                        <h3 class="trick__title">Provide Treatment Based on</h3>
                        <span class="trick__subtitle">Disease Prediction</span>
                        <span class="trick__price">Lorem ipsum dolor sit amet.</span>
                    </div>

                    <div class="trick__content">
                        <img src="http://localhost/CureForSure/public/assets/img/12.png" alt="" class="trick__img">
                        <h3 class="trick__title">Reduce </h3>
                        <span class="trick__subtitle">Time</span>
                        <span class="trick__price">lorem5</span>
                    </div>
                </div>
            </section>
        </section>
    </main>
@endsection
