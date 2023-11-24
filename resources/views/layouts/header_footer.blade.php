<!doctype html>

<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>KrashiKala - @yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('assets/assets/img/logofinal.png') }}" type="image/x-icon">

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('assets/css/newcss/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/assets/swiper/swiper-bundle.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/assets/css/stylesa.css') }}"> --}}


    <style>
        @media (min-width: 0px) and (max-width: 990px) {
            .logo1 img {
                width: 60%;
                height: 30%;
            }
        }


        @media (min-width: 990px) and (max-width: 1991px) {
            .logo1 img {
                width: 200%;
                height: 60%;
            }
        }
    </style>

</head>

<body>
    {{-- <header class="header" id="header">
        <nav class="nav container">
            <a href="#" class="nav__logo" style="color:hsl(104, 28%, 35%);">
                <img src="{{ asset('assets/assets/img/logofinal.png') }}" alt="" class="nav__logo-img"
                    style="width: 200px; height: 60px">
            </a>
            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="#home" class="nav__link active-link" style="color:hsl(104, 28%, 35%);">Home</a>
                    </li>
                    <li class="nav__item">
                        <a href="#about" class="nav__link" style="color:hsl(104, 28%, 35%);">About us</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{ route('feedback') }}" class="nav__link"
                            style="color:hsl(104, 28%, 35%);">Feedback</a>
                    </li>
                    <li class="nav__item">
                        <a href="#new" class="nav__link" style="color:hsl(104, 28%, 35%);">Contact Us</a>
                    </li>
                    @if (isset(Auth::user()->id))
                        <a href="{{ route('login') }}" class="button button--ghost"
                            style="color:hsl(104, 28%, 35%);">Hello {{ Auth::user()->name }}</a>
                    @else
                        <a href="{{ route('login') }}" class="button button--ghost"
                            style="color:hsl(104, 28%, 35%);">Login</a>
                    @endif
                    <li class="nav__item" id="google_translate_element">

                    </li>
                </ul>
                <div class="nav__close" id="nav-close">
                    <i class='bx bx-x'></i>
                </div>
                <img src="assets/img/nav-img.png" alt="" class="nav__img">
            </div>
            <div class="nav__toggle" id="nav-toggle">
                <i class='bx bx-grid-alt'></i>
            </div>
        </nav>
    </header> --}}
    <header class="header bg-white" id="header">
        <nav class="nav mx-5">
            <a href="{{route('/')}}" class="nav__logo" style="color:hsl(104, 28%, 35%);">
                <img src="{{ asset('assets/assets/img/logofinal.png') }}" alt="" class="nav__logo-img">
                <!-- KrashiKala -->
            </a>

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="index.html" class="nav__link active-link" style="color:hsl(104, 28%, 35%);">Home</a>
                    </li>

                    <li class="nav__item">
                        <a href="{{route('about')}}" class="nav__link" style="color:hsl(104, 28%, 35%);">About us</a>
                    </li>

                    <li class="nav__item">
                        <a href="{{route('contact')}}" class="nav__link" style="color:hsl(104, 28%, 35%);">Contact</a>
                    </li>

                    <li class="nav__item">
                        @if (isset(Auth::user()->id))
                            <a href="{{ route('dashboard') }}" class="button button--ghost"
                                style="color:hsl(104, 28%, 35%);">Hello {{ Auth::user()->name }}</a>
                        @else
                            <a href="{{ route('login') }}" class="button button--ghost"
                                style="color:hsl(104, 28%, 35%);">Login</a>
                        @endif
                    </li>

                    <li class="nav__item" id="google_translate_element">

                    </li>
                    {{-- <li class="whether_api">
                        @php
                            $curl = curl_init();
                            
                            curl_setopt_array($curl, [
                                CURLOPT_URL => 'https://weather-by-api-ninjas.p.rapidapi.com/v1/weather?city=Bhopal',
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => '',
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 30,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => 'GET',
                                CURLOPT_HTTPHEADER => ['X-RapidAPI-Host: weather-by-api-ninjas.p.rapidapi.com', 'X-RapidAPI-Key: a7fb0d3933mshce6c11a1c4f7b6cp1b45bcjsn745241cdb7ec'],
                            ]);
                            
                            $response = curl_exec($curl);
                            $err = curl_error($curl);
                            
                            curl_close($curl);
                            
                            if ($err) {
                                echo 'cURL Error #:' . $err;
                            } else {
                                $ans = json_decode($response, true);
                            }
                        @endphp
                        <div class="row">
                            <div class="col-6 p-0">
                                <img src="{{ asset('assets/img/wethersun.png') }}" alt=""
                                    style="width: 50px; height: 50px;">
                            </div>
                            <div class="col-6 p-0">
                                <p class="max_temp m-0"
                                    style="color: rgb(255, 72, 0); font-weight:600; font-size:16px;">
                                    {{ $ans['max_temp'] }} °C</p>
                                <p class="min_temp m-0" style="color: rgb(34, 9, 1); font-weight:500; font-size:14px;">
                                    {{ $ans['min_temp'] }} °C</p>
                            </div>
                        </div>
                    </li> --}}

                </ul>

                <div class="nav__close" id="nav-close">
                    <i class='bx bx-x'></i>
                </div>

                <img src="assets/img/nav-img.png" alt="" class="nav__img">
            </div>

            <div class="nav__toggle" id="nav-toggle">
                <i class='bx bx-grid-alt'></i>
            </div>

        </nav>
    </header>


    <section class="my-4">
        @yield('main_content')
    </section>

    <!--FOOTER -->
    <footer class="footer section bg-light">
        <div class="footer__container container grid">
            <div class="footer__content">
                <a href="#" class="footer__logo">
                    <img src="{{ asset('assets/assets/img/finallogo.png') }}" alt="" class="footer__logo-img">
                    KrashiKala
                </a>

                <p class="footer__description">Enjoy your Farming <br> </p>

                <div class="footer__social">
                    <a href="https://www.facebook.com/" target="_blank" class="footer__social-link">
                        <i class='bx bxl-facebook'></i>
                    </a>
                    <a href="https://www.instagram.com/" target="_blank" class="footer__social-link">
                        <i class='bx bxl-instagram-alt'></i>
                    </a>
                    <a href="https://twitter.com/" target="_blank" class="footer__social-link">
                        <i class='bx bxl-twitter'></i>
                    </a>
                </div>
            </div>

            <div class="footer__content">
                <h3 class="footer__title">About</h3>

                <ul class="footer__links">
                    <li>
                        <a href="#" class="footer__link">About Us</a>
                    </li>
                    <li>
                        <a href="#" class="footer__link">Features</a>
                    </li>
                    <li>
                        <a href="#" class="footer__link">News</a>
                    </li>
                </ul>
            </div>

            <div class="footer__content">
                <h3 class="footer__title">Our Services</h3>

                <ul class="footer__links">
                    <li>
                        <a href="#" class="footer__link">Crop Prediction</a>
                    </li>
                    <li>
                        <a href="#" class="footer__link">Fertilizer Prediction</a>
                    </li>
                    <li>
                        <a href="#" class="footer__link">Disease Recommendation</a>
                    </li>
                </ul>
            </div>

            <div class="footer__content">
                <h3 class="footer__title">Our Company</h3>

                <ul class="footer__links">
                    <li>
                        <a href="#" class="footer__link">Blog</a>
                    </li>
                    <li>
                        <a href="#" class="footer__link">About us</a>
                    </li>
                    <li>
                        <a href="#" class="footer__link">Our mision</a>
                    </li>
                </ul>
            </div>
        </div>

        <span class="footer__copy">&#169; All rigths reserved</span>

        <img src="{{ asset('assets/assets/img/tree.png') }}" alt="" class="footer__img-one"
            style="height: 250px; width: 250px;">
        <img src="{{ asset('assets/assets/img/f1.png') }}" alt="" class="footer__img-two"
            style="height: 250px; width: 250px;">
    </footer>

    <!-- SCROLL UP -->
    <a href="#" class="scrollup" id="scroll-up">
        <i class='bx bx-up-arrow-alt scrollup__icon'></i>
    </a>

</body>
<!--contact js-->
<script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>


@yield('javascript')

<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
                pageLanguage: 'en'
            },
            'google_translate_element'
        );
    }
</script>
<script src="{{ asset('assets/assets/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/assets/js/scrollreveal.min.js') }}"></script>

<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
</script>
<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 3,
        spaceBetween: 30,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
</script>
{{-- <script src="js/main.js"></script> --}}

</html>
