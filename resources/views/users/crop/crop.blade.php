@extends('layouts.header_footer')

@section('title')
    User Crop Details
@endsection

@section('main_content')
    <style>
        .breadcam_bg-green {
            background-image: url({{asset('assets/assets/img/crop.png')}});
        }

        .bradcam_area {
            text-align: center;
            background-size: cover;
            background-position: center center;
            padding: 230px 0;
            background-position: bottom;
            background-repeat: no-repeat;
        }

        @media (min-width: 400px) and (max-width: 991px) {

            /* line 10, ../../Arafath/CL/january 2020/240. Animal/HTML/scss/_bradcam.scss */
            .bradcam_area {
                padding: 140px 0;
            }
        }

        @media (max-width: 400px) {

            /* line 10, ../../Arafath/CL/january 2020/240. Animal/HTML/scss/_bradcam.scss */
            .bradcam_area {
                padding: 70px 0;
            }
        }

        /* line 22, ../../Arafath/CL/january 2020/240. Animal/HTML/scss/_bradcam.scss */
        .bradcam_area h3 {
            font-size: 50px;
            color: rgb(142, 139, 139);
            font-weight: 900;
            margin-bottom: 0;
            font-family: "Poppins", sans-serif;
            text-transform: capitalize;
        }
    </style>
    <style>
        .breadcam_bg-green {
            background-image: url({{ asset('assets/assets/img/crop.png') }});
        }
    </style>
    <div style="margin-top: 100px" class="bradcam_area breadcam_bg-green">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bradcam_text text-center">
                        <!-- <h3 style="color: rgb(248, 244, 244);">Disease Prediction</h3> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br /><br />
    <h6
        style="
        font-family: Arial, sans-serif;
        font-size: 1.7rem;
        color: black;
        text-align: center;
    ">
        <b>Identify Your Suitable Crop Accoring NPK And Wheather value </b>
    </h6>
    <center>
        <img style="margin-top: 30px; width: 400px" src="{{ asset('assets/assets/img/finalogo.png') }}" alt="" />
        <br />
        <h3 style="color: black">Try it</h3>
        <br />
        <a href="https://crop-predictor-koin.onrender.com/">
            <button type="button" class="btn btn-success">
                click of Check
            </button>
        </a>
    </center>
    <br /><br /><br />
    <br />
    <div class="footer">
        <p style="color: white">&copy; Crop Recommendation</p>
    </div>
@endsection
