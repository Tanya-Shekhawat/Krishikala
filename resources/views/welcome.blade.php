@extends('layouts.header_footer')

@section('main_content')
    <style>
        .container-box-shadow {
            box-shadow: 0 0 5px rgb(68, 67, 67);
            width: 18rem;
            border-radius: 10px;
        }
    </style>
    <main class="main">
        <!-- HOME -->
        <section class="home container" id="home">
            <div class="swiper home-swiper">
                <div class="swiper-wrapper">
                    <section class="swiper-slide">
                        <div class="home__content grid">
                            <div class="home__group">
                                <img src="{{ asset('assets/assets/img/h1.png') }}" alt="" class="home__img">
                                <div class="home__indicator"></div>

                                <div class="home__details-img">
                                    <h4 class="home__details-title">The custodians of the land!</h4>
                                    <span class="home__details-subtitle" style="color: rgb(33, 54, 33);">sowing the seeds of
                                        our future.</span>
                                </div>
                            </div>

                            <div class="home__data">
                                <h3 class="home__subtitle">KrashiKala</h3>
                                <h1 class="home__title">The<br> Art of <br> Farming!!</h1>
                                <p class="home__description">"Welcome to Our KrashiKala! Discover the latest farming
                                    techniques, expert insights,
                                    and sustainable solutions to cultivate your success in the world of agriculture."
                                </p>

                                <div class="home__buttons">
                                    <a href="{{route('login')}}" class="button">Login/Register</a>

                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </section>

        <!-- Goals-->
        <section class="section category">
            <h2 class="section__title">Our Features</h2>
            <div class="category__container container grid">
                <div class="container-box-shadow">
                    <a href="{{route('recommendcrop')}}">
                        <div class="category__data">
                            <img src="{{ asset('assets/assets/img/g1.png') }}" alt="" class="category__img">
                            <h3 class="category__title">Crop Recommendation</h3>
                            <p class="category__description">Unlock the potential of your fields with our cutting-edge Crop
                                Recommendation tool.</p>
                        </div>
                    </a>
                </div>
                <div class="container-box-shadow">
                    <a href="{{route('recommendfertilizer')}}">
                        <div class="category__data">
                            <img src="{{ asset('assets/assets/img/g2.png') }}" alt="" class="category__img">
                            <h3 class="category__title">Fertilizer Recommendation</h3>
                            <p class="category__description">Optimize your crop yields and reduce waste with our Fertilizer
                                Recommendation feature.</p>
                        </div>
                    </a>
                </div>
                <div class="container-box-shadow">
                    <a href="http://127.0.0.1:5000/">
                        <div class="category__data">
                            <img src="{{ asset('assets/assets/img/g3.png') }}" alt="" class="category__img">
                            <h3 class="category__title">Disease Prediction</h3>
                            <p class="category__description">Stay one step ahead of crop diseases with our Plant Disease
                                Prediction system</p>
                        </div>
                    </a>
                </div>
            </div>
            <br><br>

            <div class="category__container container grid">
                <div class="container-box-shadow">
                    <a href="{{ route('dashboard') }}">
                        <div class="category__data">
                            <img src="{{ asset('assets/assets/img/mr.png') }}" alt="" class="category__img">
                            <h3 class="category__title">Manage Record</h3>
                            <p class="category__description">Introducing a vital feature for farmers: record-keeping from
                                planting to harvest, along with daily crop prices and weather updates.</p>
                        </div>
                    </a>
                </div>

                <div class="container-box-shadow">
                    <a href="{{ route('dashboard') }}">
                        <div class="category__data">
                            <img src="{{ asset('assets/assets/img/profit.png') }}" style="width: 200%; height: 45%;"
                                alt="" class="category__img">
                            <br><br>
                            <h3 class="category__title">Check Crop Profit</h3>
                            <p class="category__description">After record management, compute farmer's profit from crop
                                data,
                                neglecting expenses, with mandi rate.</p>
                        </div>
                    </a>
                </div>
                <div class="container-box-shadow">
                    <a href="{{route('usermanual')}}">
                        <div class="category__data">
                            <img style="height: 100px; margin-top: 50px;"
                                src="{{ asset('assets/assets/img/usermanualfinal.png') }}" alt=""
                                class="category__img" style="height: 170px;"><br><br>
                            <h3 class="category__title">User Manual</h3><br>
                            <p class="category__description">User manual guides farmers with step-by-step instructions for
                                optimal use of our agriculture website.</p>
                        </div>
                    </a>

                </div>
            </div>
        </section>


        <!--ABOUT -->
        <section class="section about" id="about">
            <div class="about__container container grid">
                <div class="about__data">
                    <h2 class="section__title about__title">About <br> Us......</h2>
                    <p class="about__description">At KrashiKala, we are dedicated to revolutionizing agriculture through
                        technology-driven solutions. Our platform offers cutting-edge features such as Crop Recommendation,
                        Fertilizer Recommendation, and Plant Disease Prediction, all backed by advanced algorithms and
                        real-time data. With the added capability to efficiently Manage Records, we empower farmers with the
                        tools they need to thrive in today's dynamic farming landscape."
                    </p>
                    <a href="{{route('about')}}" class="button">Know more</a>
                </div>

                <img src="{{asset('assets/assets/img/ab.jpeg')}}" alt="" class="about__img">
            </div>
        </section>

        <br><br>
        <div class="row mx-0">
            <div class="container col-lg-12 mx-auto">
                <div class="feedback-container swiper mySwiper">
                    <h3>Our Testimonials</h3>
                    <div class="swiper-wrapper">
                        @foreach ($feedback as $item)
                            <div class="container-box-shadow2 swiper-slide rounded">
                                <div class="feedback">
                                    <img src="{{ $item->profile_image }}" alt="User2" style="height: 300px;">
                                    <b>
                                        <h5 style="color: black;">{{ $item->name }}</h5>
                                    </b>
                                    <p>{{ $item->feedback }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>

                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('javascript')
    {{-- <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 3,
            spaceBetween: 30,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    </script> --}}
@endsection
