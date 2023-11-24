<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from eduport.webestica.com/admin-dashboard.html by testing/3.x [XR&CO'2014], Sat, 17 Dec 2022 17:15:47 GMT -->

<head>
    <title>@yield('title')</title>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Webestica.com">
    <meta name="description" content="@yield('title')">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/police/head-png.png') }}">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;700&amp;family=Roboto:wght@400;500;700&amp;display=swap">

    <!-- Plugins CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    {{-- Navbar CSS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/assets/css/styles.css') }}">
    {{-- jQuery CDN --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.css">

    {{-- Sweet Alert --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>


    {{-- Change Status --}}
    <script>
        function changeStatus(table, column, row_id) {
            if (column == 'on_homepage') {
                id = "#tab2_" + row_id;
            } else if (column == 'is_verified') {
                id = "#tab3_" + row_id;
            } else if (column == 'featured') {
                id = "#tab4_" + row_id;
            } else {
                id = "#tab_" + row_id;
            }
            status = $(id).data('status');
            console.log(id, status)
            if (status == 1) {
                status = 0;
            } else {
                status = 1;
            }
            $.ajax({
                url: "{{ route('status') }}",
                type: "POST",
                data: {
                    table: table,
                    column: column,
                    row_id: row_id,
                    status: status,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    if (data) {
                        $(id).data('status', status)
                        toastr.success("Status Changed Successfully")
                    } else {
                        toastr.warning("Something went wrong")
                    }
                }
            });
        }
    </script>

    <style>
        .asktrick_label {
            color: red;
        }

        .dashboard_menu {
            margin: 0px 150px;
        }

        @media(max-width: 769px) {
            .dashboard_menu {
                margin: 0px 100px;
            }
        }

        @media(max-width: 576px) {
            .dashboard_menu {
                margin: 0px;
            }
        }

        /* @media (min-width:) */
    </style>

</head>

<body>

    <header class="header" id="header">
        <nav class="nav mx-5">
            <a href="{{ route('/') }}" class="nav__logo" style="color:hsl(104, 28%, 35%);">
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
                        <a href="{{ route('dashboard') }}" class="button button--ghost"
                            style="color:hsl(104, 28%, 35%);">Hello {{ Auth::user()->name }}</a>
                    @else
                        <a href="{{ route('login') }}" class="button button--ghost"
                            style="color:hsl(104, 28%, 35%);">Login</a>
                    @endif
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
                                'cURL Error #:' . $err;
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

    <main>
        <section class="pt-0">
            <div class="container-fluid px-0">
                <div class="bg-blue h-100px h-md-400px rounded-0"
                    style="background:url({{ asset('assets/img/newimg/bg-img/ds.png') }}) no-repeat center center; background-size:cover;">
                </div>
            </div>
            <div class="container mt-n4">
                <div class="row">
                    <div class="col-12">
                        <div class="card bg-transparent card-body p-0">
                            <div class="row d-flex justify-content-between">
                                <div class="col-auto mt-4 mt-md-0">
                                    <div class="avatar avatar-xxl mt-n3">
                                        <img class="avatar-img rounded-circle border border-white border-3 shadow"
                                            src="@if (isset(Auth::user()->id)) {{ Auth::user()->profile_image }} @endif"
                                            alt="">
                                    </div>
                                </div>
                                <div class="col d-md-flex justify-content-between align-items-center mt-4">
                                    <div>
                                        <h1 class="my-1 fs-4">
                                            @if (isset(Auth::user()->id))
                                                {{ Auth::user()->name }}
                                            @endif
                                        </h1>
                                    </div>
                                </div>
                            </div>

                            <hr class="d-xl-none">
                            <div class="col-12 col-xl-3 d-flex justify-content-between align-items-center">
                                <a class="h6 mb-0 fw-bold d-xl-none" href="#">Menu</a>
                                <button class="btn btn-primary d-xl-none" type="button" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
                                    <i class="fas fa-sliders-h"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="pt-0">
            <div class="dashboard_menu">
                <div class="row">
                    <!-- Left sidebar START -->
                    <div class="col-xl-3">
                        @php
                            $current_route = request()
                                ->route()
                                ->getName();
                        @endphp
                        <div class="offcanvas-xl offcanvas-end" tabindex="-1" id="offcanvasSidebar"
                            aria-labelledby="offcanvasSidebarLabel">
                            <div class="offcanvas-header bg-light">
                                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">My profile</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                    data-bs-target="#offcanvasSidebar" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body p-3 p-xl-0">
                                <div class="bg-dark border rounded-3 pb-0 p-3 w-100">
                                    <div class="list-group list-group-dark list-group-borderless">
                                        @php
                                            if ($current_route == 'dashboard') {
                                                $active = '';
                                            } elseif ($current_route == 'user.mytasks') {
                                                $active = '';
                                            } elseif ($current_route == 'user.mycrops') {
                                                $active = '';
                                            } else {
                                                $active = 'collapsed';
                                            }
                                        @endphp
                                        <a class="list-group-item {{ $current_route == 'dashboard' ? 'active' : '' }}"
                                            href="{{ route('dashboard') }}"><i
                                                class="bi bi-ui-checks-grid fa-fw me-2"></i>Dashboard</a>

                                        <a class="list-group-item {{ $current_route == 'user.profile' ? 'active' : '' }}"
                                            href="{{ route('user.profile') }}"><i
                                                class="bi bi-pencil-square fa-fw me-2"></i>Edit Profile</a>

                                        <a class="list-group-item {{ $current_route == 'user.mycrops' ? 'active' : '' }}"
                                            href="{{ route('user.mycrops') }}">
                                            <i class="bi bi-tree-fill"></i>My Crops</a>

                                        <form action="{{ route('logout') }}" method="post">
                                            @csrf
                                            <button type="submit" class="list-group-item btn bg-danger-soft-hover">
                                                <i class="bi bi-power fa-fw me-2"></i>Sign Out</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Main content START -->
                    <div class="col-xl-9 shadow rounded">
                        @yield('content')
                    </div>
                </div>
            </div>
        </section>

    </main>

    <div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i>
    </div>

    <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('vendor/purecounterjs/dist/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('vendor/apexcharts/js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('vendor/choices/js/choices.min.js') }}"></script>
    <script src="{{ asset('vendor/overlay-scrollbar/js/overlayscrollbars.min.html') }}"></script>
    <script src="{{ asset('vendor/glightbox/js/glightbox.js') }}"></script>

    <script src="{{ asset('assets/js/functions.js') }}"></script>

    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "paging": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $("#example3").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "paging": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
        });
    </script>

    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>

    <script>
        CKEDITOR.replace('staff_message');
        CKEDITOR.replace('case_description');
        CKEDITOR.replace('message');
    </script>

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


    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])

    @yield('javascript')

    {{-- Delete the Data from DB --}}
    <script>
        function deleteDataDb(id, table_name) {
            swal({
                    title: "Are you sure you want to delete this record?",
                    text: "If you delete this, it will be gone forever.",
                    id,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "get",
                            url: "{{ route('delete') }}",
                            data: {
                                id: id,
                                table: table_name,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                window.location.reload();
                                swal({
                                    title: "Data Deleted",
                                    text: "Data deleted permanentaly",
                                    icon: "success",
                                })
                            }
                        });
                    } else {
                        swal("Your imaginary file is safe!");
                    }
                });
        };
    </script>

    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                    pageLanguage: 'en'
                },
                'google_translate_element'
            );
        }
    </script>

    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>

</body>

<!-- Mirrored from eduport.webestica.com/admin-dashboard.html by testing/3.x [XR&CO'2014], Sat, 17 Dec 2022 17:15:51 GMT -->

</html
