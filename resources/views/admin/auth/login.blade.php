<html>

<head>
    <meta http-equiv="Refresh" content=“6; url=https://pawsthedogsplanet.com/“ />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <title>Admin Login</title>
</head>

<body>
    <div class="container">
        <div class="container">
            <div class="card card-container">
                <h5 class="text-center mb-3">Admin Login</h5>
                {{-- <div id="zoom-In" class="image">
                    <img style="margin-bottom: 30px;"; src="{{ asset('assets/images/police/head-png.png') }}"
                        class="rounded mx-auto d-block "alt="...">
                </div> --}}

                <form method="POST" action="{{ route('admin.login') }}">
                    @csrf
                    <fieldset class="clearfix">
                        <p>
                            <span class="fontawesome-user"></span>
                            <input class="form-control" type="email" name="email" placeholder="Enter Email">
                        </p>
                        <p>
                            <span class="fontawesome-lock"></span>
                            <input class="form-control" type="password" name="password" placeholder="Enter Password">
                        </p>
                        <p>
                            <input class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="login"
                                value="LogIn">
                        </p>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <!-- toaster -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>

    {{-- Toaster Meassage --}}
    <script>
        @if (Session::has('message'))
            toastr.success("{{ session('message') }}");
        @endif

        @if (Session::has('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error('<?= $error ?>');
            @endforeach
        @endif
    </script>
</body>

</html>
