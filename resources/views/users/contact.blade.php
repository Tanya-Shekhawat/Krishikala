@extends('layouts.header_footer')

@section('title')
    Contact
@endsection

@section('main_content')
    <div style="" class="bradcam_area breadcam_bg-green">
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
    <div class="row">
        <div class="col-lg-1"></div>

        <div class="col-lg-5">
            <img style="margin-left: 100px; align-items: center; margin-top: 90px;"
                src="{{ asset('assets/assets/img/contact1.png') }}" alt="">
        </div>
        <div class="col-lg-1"></div>

        <div style="margin-top: 50px;" class="col-lg-5">
            <div class="container-box-shadow text-dark">
                <form action="{{route('contact')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label style=" font-weight: 500;" for="formGroupExampleInput" class="form-label">Your Name</label>
                        <input style="width: 350px;  border: 2px solid #888484;  border-radius: 10px;" type="text" name="name"
                            class="form-control" id="formGroupExampleInput" placeholder="Enter your Name" @required(true)>
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput2" style=" font-weight: 500;" class="form-label">Phone No</label>
                        <input style="width: 350px;  border: 2px solid #888484;  border-radius: 10px;" type="text" name="phone"
                            class="form-control" id="formGroupExampleInput2" placeholder="Enter your Phone Number"
                            @required(true)>
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput2" style=" font-weight: 500;" class="form-label">Your
                            Enquiry</label>
                        <textarea style="width: 350px;  border: 2px solid #888484;  border-radius: 10px;" rows="5" name="message"
                            class="form-control" id="formGroupExampleInput2" placeholder="Type your Query" @required(true)></textarea>
                    </div>

                    <button
                        style=" margin-top: 4px; height: 40px; border-radius: 10px; border: solid 2px rgb(149, 144, 144);"
                        type="submit" name="button" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
