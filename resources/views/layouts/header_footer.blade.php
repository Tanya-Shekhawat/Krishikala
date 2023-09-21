<!doctype html>

<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Cure For Sure</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS here -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/css/style1.css') }}"> --}}
    <link rel="stylesheet" href="http://localhost/CureForSure/public/assets/css/css/style1.css">
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/css/style.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/css/owl.carousel.min.css') }}">


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

    <header class="header" id="header">
        <nav class="navbar navbar-expand-lg navbar-light "
            style="background-color: linear-gradient(90deg, hsl(170, 81%, 94%)0%, hsl(172, 87%, 32%)100%);;">
            <div class="container-fluid" style="margin-left: 120px">
                <a class="navbar-brand" href="#"
                    style="font-weight: 700; padding: 30px; margin-left: 70px">Home</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#"
                                style="font-weight: bolder; margin-left: 70px; color: black;">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('bookappointment')}}"
                                style=" font-weight: bolder; color: black; margin-left: 70px;">Appointment Booking</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"
                                style="font-weight: bolder; margin-left: 70px; color: black;">Login Page</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#" tabindex="-1"
                                style="font-weight: bolder; margin-left: 70px; color: black;">Contact Us </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <section class="my-4">
        @yield('main_content')
    </section>

</body>
<!--contact js-->
<script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

{{-- <script src="js/owl.carousel.min.js"></script> --}}
<script src="{{ asset('assets/js/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/js/scrollIt.js') }}"></script>
<script src="{{ asset('assets/js/js/main.js') }}"></script>
<script src="{{ asset('assets/js/js/vendor/jquery-1.12.4.min.js') }}"></script>

<script src="{{ asset('assets/js/js/jquery.slicknav.min.js') }}"></script>


{{-- <script src="js/main.js"></script> --}}

</html>
