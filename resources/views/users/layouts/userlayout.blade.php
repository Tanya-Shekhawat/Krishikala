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
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/apexcharts/css/apexcharts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/overlay-scrollbar/css/OverlayScrollbars.min.css') }}">

    <!-- Theme CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
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
    </style>

</head>

<body>

    <!-- Header START -->
    <header class="navbar-light navbar-sticky">
        <!-- Logo Nav START -->
        <nav class="navbar navbar-expand-xl">
            <div class="container">
                <!-- Logo START -->
                <div class="d-flex align-items-center">
                    <a class="navbar-brand" href="/AcademyCourses">
                        <img class="navbar-brand-item" src="{{ asset('assets/images/police/head-png.png') }}"
                            alt="" width="100px" height="60px">
                    </a>
                </div>
                <!-- Logo END -->

                <!-- Responsive navbar toggler -->
                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-animation">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

                <!-- Main navbar START -->
                <div class="navbar-collapse w-100 collapse" id="navbarCollapse">

                </div>
                <!-- Main navbar END -->

                <!-- Profile START -->
                <div class="dropdown ms-1 ms-lg-0">
                    <a class="avatar avatar-sm p-0" href="#" id="profileDropdown" role="button"
                        data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img class="avatar-img rounded-circle" src="{{ Auth::guard('officer')->user()->image }}"
                            alt="avatar">
                    </a>
                    <ul class="dropdown-menu dropdown-animation dropdown-menu-end shadow pt-3"
                        aria-labelledby="profileDropdown">
                        <!-- Profile info -->
                        <li class="px-3 mb-3">
                            <div class="d-flex align-items-center">
                                <!-- Avatar -->
                                <div class="avatar me-3">
                                    <img class="avatar-img rounded-circle shadow"
                                        src="{{ Auth::guard('officer')->user()->image }}" alt="avatar">
                                </div>
                                <div>
                                    <a class="h6" href="#">{{ Auth::guard('officer')->user()->name }}</a>
                                    <p class="small m-0">{{ Auth::guard('officer')->user()->email }}</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <!-- Links -->
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person fa-fw me-2"></i>Edit
                                Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear fa-fw me-2"></i>Account
                                Settings</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-info-circle fa-fw me-2"></i>Help</a>
                        </li>
                        <form action="{{ route('logout') }}" method="post" class="dropdown-item">
                            <li>
                                @csrf
                                <button type="submit" class="list-group-item btn btn-lg bg-danger-soft-hover">
                                    <i class="bi bi-power fa-fw me-2"></i>Sign Out</button>
                            </li>
                        </form>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <!-- Dark mode switch START -->
                        <li>
                            <div class="modeswitch-wrap" id="darkModeSwitch">
                                <div class="modeswitch-item">
                                    <div class="modeswitch-icon"></div>
                                </div>
                                <span>Dark mode</span>
                            </div>
                        </li>
                        <!-- Dark mode switch END -->
                    </ul>
                </div>
                <!-- Profile START -->
            </div>
        </nav>
        <!-- Logo Nav END -->
    </header>
    <!-- Header END -->

    <!-- **************** MAIN CONTENT START **************** -->
    <main>
        <!-- Page Banner START -->
        <section class="pt-0">
            <!-- Main banner background image -->
            <div class="container-fluid px-0">
                <div class="bg-blue h-100px h-md-200px rounded-0"
                    style="background:url(https://newsroom24x7.files.wordpress.com/2017/02/20170210_071153.png) no-repeat center center; background-size:cover;">
                </div>
            </div>
            <div class="container mt-n4">
                <div class="row">
                    <!-- Profile banner START -->
                    <div class="col-12">
                        <div class="card bg-transparent card-body p-0">
                            <div class="row d-flex justify-content-between">
                                <!-- Avatar -->
                                <div class="col-auto mt-4 mt-md-0">
                                    <div class="avatar avatar-xxl mt-n3">
                                        <img class="avatar-img rounded-circle border border-white border-3 shadow"
                                            src="{{ Auth::user()->image }}" alt="">
                                    </div>
                                </div>
                                <!-- Profile info -->
                                <div class="col d-md-flex justify-content-between align-items-center mt-4">
                                    <div>
                                        <h1 class="my-1 fs-4">{{ Auth::user()->name }}</h1>
                                    </div>
                                </div>
                            </div>
                            <!-- Profile banner END -->

                            <!-- Advanced filter responsive toggler START -->
                            <!-- Divider -->
                            <hr class="d-xl-none">
                            <div class="col-12 col-xl-3 d-flex justify-content-between align-items-center">
                                <a class="h6 mb-0 fw-bold d-xl-none" href="#">Menu</a>
                                <button class="btn btn-primary d-xl-none" type="button" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
                                    <i class="fas fa-sliders-h"></i>
                                </button>
                            </div>
                            <!-- Advanced filter responsive toggler END -->
                        </div>
                    </div>
                </div>
        </section>
        <!-- Page Banner END -->

        <section class="pt-0">
            <div class="container">
                <div class="row">
                    <!-- Left sidebar START -->
                    <div class="col-xl-3">
                        @php
                            $current_route = request()
                                ->route()
                                ->getName();
                        @endphp
                        <!-- Responsive offcanvas body START -->
                        <div class="offcanvas-xl offcanvas-end" tabindex="-1" id="offcanvasSidebar"
                            aria-labelledby="offcanvasSidebarLabel">
                            <!-- Offcanvas header -->
                            <div class="offcanvas-header bg-light">
                                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">My profile</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                    data-bs-target="#offcanvasSidebar" aria-label="Close"></button>
                            </div>
                            <!-- Offcanvas body -->
                            <div class="offcanvas-body p-3 p-xl-0">
                                <div class="bg-dark border rounded-3 pb-0 p-3 w-100">
                                    <!-- Dashboard menu -->
                                    <div class="list-group list-group-dark list-group-borderless">
                                        @php
                                            if ($current_route == 'dashboard') {
                                                $active = '';
                                            } elseif ($current_route == 'mytasks') {
                                                $active = '';
                                            } else {
                                                $active = 'collapsed';
                                            }
                                        @endphp
                                        <a class="list-group-item {{ $current_route == 'dashboard' ? 'active' : '' }}"
                                            href="{{ route('dashboard') }}"><i
                                                class="bi bi-ui-checks-grid fa-fw me-2"></i>Dashboard</a>

                                        <a class="list-group-item {{ $current_route == 'mytasks' ? 'active' : '' }}
                                                {{ $current_route == 'addstaffmember' ? 'active' : '' }}"
                                            href="{{ route('mytasks') }}"><i
                                                class="bi bi-people fa-fw me-2"></i>My Tasks</a>

                                        <a class="list-group-item" href="instructor-review.html"><i
                                                class="bi bi-star fa-fw me-2"></i>Reviews</a>
                                        <a class="list-group-item" href="instructor-edit-profile.html"><i
                                                class="bi bi-pencil-square fa-fw me-2"></i>Edit Profile</a>
                                        <a class="list-group-item" href="instructor-setting.html"><i
                                                class="bi bi-gear fa-fw me-2"></i>Settings</a>
                                        <a class="list-group-item" href="instructor-delete-account.html"><i
                                                class="bi bi-trash fa-fw me-2"></i>Delete Profile</a>

                                        <form action="{{ route('logout') }}" method="post">
                                            @csrf
                                            <button type="submit" class="list-group-item btn bg-danger-soft-hover">
                                                <i class="bi bi-power fa-fw me-2"></i>Sign Out</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Responsive offcanvas body END -->
                    </div>
                    <!-- Left sidebar END -->

                    <!-- Main content START -->
                    <div class="col-xl-9">
                        @yield('content')
                    </div>
                </div>
            </div>
        </section>

    </main>
    <!-- **************** MAIN CONTENT END **************** -->

    <!-- Back to top -->
    <div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i>
    </div>

    <!-- Bootstrap JS -->
    <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Vendors -->
    <script src="{{ asset('vendor/purecounterjs/dist/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('vendor/apexcharts/js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('vendor/choices/js/choices.min.js') }}"></script>
    <script src="{{ asset('vendor/overlay-scrollbar/js/overlayscrollbars.min.html') }}"></script>

    <!-- Template Functions -->
    <script src="{{ asset('assets/js/functions.js') }}"></script>

    <!-- DataTables  & Plugins -->
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

    <!-- DataTables  & Plugins -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "paging": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>

    {{-- CK Editor --}}
    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>

    <script>
        CKEDITOR.replace('review_text');
        CKEDITOR.replace('about_us');
        CKEDITOR.replace('terms_and_conditions');
        CKEDITOR.replace('privacy_policy');
        CKEDITOR.replace('copyright');
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

</body>

<!-- Mirrored from eduport.webestica.com/admin-dashboard.html by testing/3.x [XR&CO'2014], Sat, 17 Dec 2022 17:15:51 GMT -->

</html
