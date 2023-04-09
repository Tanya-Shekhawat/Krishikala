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
                url: "/AcademyCourses/change/status",
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
        .asktrick_label { color: red; }
    </style>

</head>

<body>

    <!-- **************** MAIN CONTENT START **************** -->
    <main>

        <!-- Sidebar START -->
        <nav class="navbar sidebar navbar-expand-xl navbar-dark bg-dark">

            @php
                $current_route = request()
                    ->route()
                    ->getName();
            @endphp

            <!-- Navbar brand for xl START -->
            <div class="d-flex align-items-center">
                <a class="navbar-brand" href="/AcademyCourses">
                    <img class="navbar-brand-item" src="{{ asset('assets/images/police/head-png.png') }}"
                        alt="" width="100px" height="60px">
                </a>
            </div>
            <!-- Navbar brand for xl END -->

            <div class="offcanvas offcanvas-start flex-row custom-scrollbar h-100" data-bs-backdrop="true"
                tabindex="-1" id="offcanvasSidebar">
                <div class="offcanvas-body sidebar-content d-flex flex-column bg-dark">

                    <!-- Sidebar menu START -->
                    <ul class="navbar-nav flex-column" id="navbar-sidebar"
                        style="overflow: scroll; height:90vh; box-sizing: content-box; overflow-x: hidden;">
                        <!-- Menu item 1 -->
                        <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link active"><i
                                    class="bi bi-house fa-fw me-2"></i>Dashboard</a></li>

                        <!-- Title -->
                        <li class="nav-item ms-2 my-2">Links</li>

                        <!-- Police Officers and Personnels -->
                        <li class="nav-item">
                            @php
                                if ($current_route == 'admin.officers' || $current_route == 'admin.manageofficers' || $current_route == 'admin.manageofficers.edit') {
                                    $aria_expanded = 'true';
                                    $active = '';
                                } elseif ($current_route == 'admin.policepersonnels' || $current_route == 'admin.managepolicepersonnels') {
                                    $aria_expanded = 'true';
                                    $active = '';
                                } else {
                                    $aria_expanded = 'false';
                                    $active = 'collapsed';
                                }
                            @endphp
                            <a class="nav-link {{ $active }}" data-bs-toggle="collapse" href="#collapsepolice"
                                role="button" aria-expanded="{{ $aria_expanded }}" aria-controls="collapsepolice">
                                <i class="fas fa-user-graduate fa-fw me-2"></i>Police Personnels
                            </a>
                            <!-- Submenu -->
                            <ul class="nav collapse flex-column {{ $active == 'collapsed' ? '' : 'show' }}"
                                id="collapsepolice" data-bs-parent="#navbar-sidebar">
                                <li class="nav-item"> <a
                                        class="nav-link {{ $current_route == 'admin.officers' ? 'active' : '' }}
                                        {{ $current_route == 'admin.manageofficers' ? 'active' : '' }} {{ $current_route == 'admin.manageofficers.edit' ? 'active' : '' }}"
                                        href="{{ route('admin.officers') }}">Station Officers</a>
                                </li>
                                <li class="nav-item"> <a
                                        class="nav-link {{ $current_route == 'admin.policepersonnels' ? 'active' : '' }}"
                                        href="{{ route('admin.policepersonnels') }}">Police Staff</a></li>
                            </ul>
                        </li>

                        <!-- Menu item 5 -->
                        <li class="nav-item"> <a class="nav-link" href="admin-review.html"><i
                                    class="far fa-comment-dots fa-fw me-2"></i>Reviews</a></li>

                        <!-- Menu item 6 -->
                        <li class="nav-item"> <a class="nav-link" href="admin-earning.html"><i
                                    class="far fa-chart-bar fa-fw me-2"></i>Earnings</a></li>

                        <!-- Menu item 7 -->
                        <li class="nav-item"> <a class="nav-link" href="admin-setting.html"><i
                                    class="fas fa-user-cog fa-fw me-2"></i>Admin Settings</a></li>

                        <!-- Menu item 8 -->
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#collapseauthentication"
                                role="button" aria-expanded="false" aria-controls="collapseauthentication">
                                <i class="bi bi-lock fa-fw me-2"></i>Authentication
                            </a>
                            <!-- Submenu -->
                            <ul class="nav collapse flex-column" id="collapseauthentication"
                                data-bs-parent="#navbar-sidebar">
                                <li class="nav-item"> <a class="nav-link" href="sign-up.html">Sign Up</a></li>
                                <li class="nav-item"> <a class="nav-link" href="sign-in.html">Sign In</a></li>
                                <li class="nav-item"> <a class="nav-link" href="forgot-password.html">Forgot
                                        Password</a></li>
                                <li class="nav-item"> <a class="nav-link" href="admin-error-404.html">Error 404</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <!-- Sidebar menu end -->

                    <!-- Sidebar footer START -->
                    <div class="px-3 mt-auto pt-3">
                        <div class="d-flex align-items-center justify-content-between text-primary-hover">
                            <a class="h5 mb-0 text-body" href="admin-setting.html" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Settings">
                                <i class="bi bi-gear-fill"></i>
                            </a>
                            <a class="h5 mb-0 text-body" href="index-2.html" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Home">
                                <i class="bi bi-globe"></i>
                            </a>
                            <a class="h5 mb-0 text-body" href="sign-in.html" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Sign out">
                                <i class="bi bi-power"></i>
                            </a>
                        </div>
                    </div>
                    <!-- Sidebar footer END -->

                </div>
            </div>
        </nav>
        <!-- Sidebar END -->

        <!-- Page content START -->
        <div class="page-content">

            <!-- Top bar START -->
            <nav class="navbar top-bar navbar-light border-bottom py-0 py-xl-3">
                <div class="container-fluid p-0">
                    <div class="d-flex align-items-center w-100">

                        <!-- Logo START -->
                        <div class="d-flex align-items-center d-xl-none">
                            <a class="navbar-brand" href="index-2.html">
                                <img class="light-mode-item navbar-brand-item h-30px"
                                    src="{{ asset('assets/images/police/head-png.png') }}" alt="">
                                <img class="dark-mode-item navbar-brand-item h-30px"
                                    src="{{ asset('assets/images/police/head-png.png') }}" alt="">
                            </a>
                        </div>
                        <!-- Logo END -->

                        <!-- Toggler for sidebar START -->
                        <div class="navbar-expand-xl sidebar-offcanvas-menu">
                            <button class="navbar-toggler me-auto" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar"
                                aria-expanded="false" aria-label="Toggle navigation" data-bs-auto-close="outside">
                                <i class="bi bi-text-right fa-fw h2 lh-0 mb-0 rtl-flip"
                                    data-bs-target="#offcanvasMenu"> </i>
                            </button>
                        </div>
                        <!-- Toggler for sidebar END -->

                        <!-- Top bar left -->
                        <div class="navbar-expand-lg ms-auto ms-xl-0">

                            <!-- Toggler for menubar START -->
                            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarTopContent" aria-controls="navbarTopContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-animation">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </span>
                            </button>
                            <!-- Toggler for menubar END -->

                            <!-- Topbar menu START -->
                            <div class="collapse navbar-collapse w-100" id="navbarTopContent">
                                <!-- Top search START -->
                                <div class="nav my-3 my-xl-0 flex-nowrap align-items-center">
                                    <div class="nav-item w-100">

                                    </div>
                                </div>
                                <!-- Top search END -->
                            </div>
                            <!-- Topbar menu END -->
                        </div>
                        <!-- Top bar left END -->

                        <!-- Top bar right START -->
                        <div class="ms-xl-auto">
                            <ul class="navbar-nav flex-row align-items-center">

                                <!-- Notification dropdown START -->
                                <li class="nav-item ms-2 ms-md-3 dropdown">
                                    <!-- Notification button -->
                                    <a class="btn btn-light btn-round mb-0" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                                        <i class="bi bi-bell fa-fw"></i>
                                    </a>
                                    <!-- Notification dote -->
                                    <span class="notif-badge animation-blink"></span>

                                    <!-- Notification dropdown menu START -->
                                    <div
                                        class="dropdown-menu dropdown-animation dropdown-menu-end dropdown-menu-size-md p-0 shadow-lg border-0">
                                        <div class="card bg-transparent">
                                            <div
                                                class="card-header bg-transparent border-bottom py-4 d-flex justify-content-between align-items-center">
                                                <h6 class="m-0">Notifications <span
                                                        class="badge bg-danger bg-opacity-10 text-danger ms-2">2
                                                        new</span></h6>
                                                <a class="small" href="#">Clear all</a>
                                            </div>
                                            <div class="card-body p-0">
                                                <ul class="list-group list-unstyled list-group-flush">
                                                    <!-- Notif item -->
                                                    <li>
                                                        <a href="#"
                                                            class="list-group-item-action border-0 border-bottom d-flex p-3">
                                                            <div class="me-3">
                                                                <div class="avatar avatar-md">
                                                                    <img class="avatar-img rounded-circle"
                                                                        src="assets/images/avatar/08.jpg"
                                                                        alt="avatar">
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <p class="text-body small m-0">Congratulate <b>Joan
                                                                        Wallace</b> for graduating from <b>Microverse
                                                                        university</b></p>
                                                                <u class="small">Say congrats</u>
                                                            </div>
                                                        </a>
                                                    </li>

                                                    <!-- Notif item -->
                                                    <li>
                                                        <a href="#"
                                                            class="list-group-item-action border-0 border-bottom d-flex p-3">
                                                            <div class="me-3">
                                                                <div class="avatar avatar-md">
                                                                    <img class="avatar-img rounded-circle"
                                                                        src="{{ asset('assets/images/avatar/02.jpg') }}"
                                                                        alt="avatar">
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-1">Larry Lawson Added a new course</h6>
                                                                <p class="small text-body m-0">What's new! Find out
                                                                    about new features</p>
                                                                <u class="small">View detail</u>
                                                            </div>
                                                        </a>
                                                    </li>

                                                    <!-- Notif item -->
                                                    <li>
                                                        <a href="#"
                                                            class="list-group-item-action border-0 border-bottom d-flex p-3">
                                                            <div class="me-3">
                                                                <div class="avatar avatar-md">
                                                                    <img class="avatar-img rounded-circle"
                                                                        src="assets/images/avatar/05.jpg"
                                                                        alt="avatar">
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-1">New request to apply for Instructor
                                                                </h6>
                                                                <u class="small">View detail</u>
                                                            </div>
                                                        </a>
                                                    </li>

                                                    <!-- Notif item -->
                                                    <li>
                                                        <a href="#"
                                                            class="list-group-item-action border-0 border-bottom d-flex p-3">
                                                            <div class="me-3">
                                                                <div class="avatar avatar-md">
                                                                    <img class="avatar-img rounded-circle"
                                                                        src="{{ asset('assets/images/avatar/03.jpg') }}"
                                                                        alt="avatar">
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-1">Update v2.3 completed successfully
                                                                </h6>
                                                                <p class="small text-body m-0">What's new! Find out
                                                                    about new features</p>
                                                                <small class="text-body">5 min ago</small>
                                                            </div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Notification dropdown menu END -->
                                </li>
                                <!-- Notification dropdown END -->

                                <!-- Profile dropdown START -->
                                <li class="nav-item ms-2 ms-md-3 dropdown">
                                    <!-- Avatar -->
                                    <a class="avatar avatar-sm p-0" href="#" id="profileDropdown"
                                        role="button" data-bs-auto-close="outside" data-bs-display="static"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <img class="avatar-img rounded-circle"
                                            src="{{ asset('assets/images/avatar/01.jpg') }}" alt="avatar">
                                    </a>

                                    <!-- Profile dropdown START -->
                                    <ul class="dropdown-menu dropdown-animation dropdown-menu-end shadow pt-3"
                                        aria-labelledby="profileDropdown">
                                        <!-- Profile info -->
                                        <li class="px-3">
                                            <div class="d-flex align-items-center">
                                                <!-- Avatar -->
                                                <div class="avatar me-3 mb-3">
                                                    <img class="avatar-img rounded-circle shadow"
                                                        src="assets/images/avatar/01.jpg" alt="avatar">
                                                </div>
                                                <div>
                                                    <a class="h6 mt-2 mt-sm-0"
                                                        href="#">{{ Auth::guard('admin')->user()->name }}</a>
                                                    <p class="small m-0">{{ Auth::guard('admin')->user()->email }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <!-- Links -->
                                        <li><a class="dropdown-item" href="#"><i
                                                    class="bi bi-person fa-fw me-2"></i>Edit Profile</a></li>
                                        <li><a class="dropdown-item" href="#"><i
                                                    class="bi bi-gear fa-fw me-2"></i>Account Settings</a></li>
                                        <li><a class="dropdown-item" href="#"><i
                                                    class="fas fa-user-graduate fa-fw me-2"></i>Add Officer</a></li>
                                        <li>
                                            <form action="{{ route('admin.logout') }}" method="post">
                                                @csrf
                                                <button type="submit" class="dropdown-item bg-danger-soft-hover">
                                                    <i class="bi bi-power fa-fw me-2"></i>Sign Out</button>
                                            </form>
                                        </li>
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
                                    <!-- Profile dropdown END -->
                                </li>
                                <!-- Profile dropdown END -->
                            </ul>
                        </div>
                        <!-- Top bar right END -->
                    </div>
                </div>
            </nav>
            <!-- Top bar END -->

            <!-- Page main content START -->
            <div class="page-content-wrapper border">

                @yield('content')

            </div>
            <!-- Page main content END -->
        </div>
        <!-- Page content END -->

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
                            url: "{{route('delete')}}",
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
