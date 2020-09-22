<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>KANTIN TB | @yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.bootstrap4.min.css">

    <!-- select2 -->
	<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.css" rel="stylesheet"/> -->
	<link href="{{ asset('select2/dist/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('select2-bootstrap4/dist/select2-bootstrap4.min.css') }}" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <style>
        /* :root {
            filter: invert(100%);
        }
        img, picture, video {
            filter: invert(1) hue-rotate(180deg)
        } */
        /* .sidebar{
            filter: invert(1) hue-rotate(180deg)
        } */
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/dashboard') }}">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-fw fa-utensils"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Kantin <sup>TB</sup></div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/adashboard') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                {{-- <div class="sidebar-heading">
                CRUD User
                </div> --}}

                <!-- Nav Item - Utilities Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/kdashboard/transactions') }}">
                        <i class="fas fa-fw fa-cash-register"></i>
                        <span>Transactions</span>
                    </a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

            </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                    @yield('topbar')
                    <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->nama_user ?? '' }}</span>
                                    <img class="img-profile rounded-circle" src="{{ URL::asset('storage/'.Auth::user()->avatar) }}">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                    <a class="dropdown-item text-center" href="#">
                                        <button type="button" class="btn btn-outline-primary">Cashier</button>
                                    </a>
                                    <a class="dropdown-item" href="{{ url('/kdashboard/profil') }}">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Change Profile
                                    </a>
                                    <a class="dropdown-item" href="{{ url('/kdashboard/password') }}">
                                        <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Change Password
                                    </a>

                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>

                        </ul>

                    </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    @yield('konten')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Uji Level Laravel 2020</span>
                    </div>
                </div>
            </footer>
        <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="{{ url('/logout') }}">Logout</a>
            </div>
        </div>
    </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>


    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

    <!-- Datatables -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>

    <!-- select2 -->
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.js"></script> -->
    <script src="{{ asset('select2/dist/js/select2.min.js') }}"></script>

    <script>
        $(document).ready( function () {
            $('.alert').alert();

            $('.custom-file-input').on('change', function(){
				let filename = $(this).val().split('\\').pop();
				$(this).next('.custom-file-label').addClass("selected").html(filename);
			});

            $('#table').DataTable({
                rowReorder: true
            });

            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if($('#show_hide_password input').attr("type") == "text"){
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass( "fa-eye-slash" );
                    $('#show_hide_password i').removeClass( "fa-eye" );
                }else if($('#show_hide_password input').attr("type") == "password"){
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass( "fa-eye-slash" );
                    $('#show_hide_password i').addClass( "fa-eye" );
                }
            });
            $("#show_hide_cur_pass a").on('click', function(event) {
                event.preventDefault();
                if($('#show_hide_cur_pass input').attr("type") == "text"){
                    $('#show_hide_cur_pass input').attr('type', 'password');
                    $('#show_hide_cur_pass i').addClass( "fa-eye-slash" );
                    $('#show_hide_cur_pass i').removeClass( "fa-eye" );
                }else if($('#show_hide_cur_pass input').attr("type") == "password"){
                    $('#show_hide_cur_pass input').attr('type', 'text');
                    $('#show_hide_cur_pass i').removeClass( "fa-eye-slash" );
                    $('#show_hide_cur_pass i').addClass( "fa-eye" );
                }
            });
            $("#show_hide_new_pass a").on('click', function(event) {
                event.preventDefault();
                if($('#show_hide_new_pass input').attr("type") == "text"){
                    $('#show_hide_new_pass input').attr('type', 'password');
                    $('#show_hide_new_pass i').addClass( "fa-eye-slash" );
                    $('#show_hide_new_pass i').removeClass( "fa-eye" );
                }else if($('#show_hide_new_pass input').attr("type") == "password"){
                    $('#show_hide_new_pass input').attr('type', 'text');
                    $('#show_hide_new_pass i').removeClass( "fa-eye-slash" );
                    $('#show_hide_new_pass i').addClass( "fa-eye" );
                }
            });
            $("#show_hide_confirm_new_pass a").on('click', function(event) {
                event.preventDefault();
                if($('#show_hide_confirm_new_pass input').attr("type") == "text"){
                    $('#show_hide_confirm_new_pass input').attr('type', 'password');
                    $('#show_hide_confirm_new_pass i').addClass( "fa-eye-slash" );
                    $('#show_hide_confirm_new_pass i').removeClass( "fa-eye" );
                }else if($('#show_hide_confirm_new_pass input').attr("type") == "password"){
                    $('#show_hide_confirm_new_pass input').attr('type', 'text');
                    $('#show_hide_confirm_new_pass i').removeClass( "fa-eye-slash" );
                    $('#show_hide_confirm_new_pass i').addClass( "fa-eye" );
                }
            });

            $('#tunai').on('keyup', function(){
                var totalhrg = $('#totalharga').val();
                var tunai = $(this).val();

                var hitung = tunai-totalhrg;

                $('#kembali').val(hitung);
            });

            // select2
                $('#nomeja').select2({
                    width: '100%',
                    // allowClear: true,
                    closeOnSelect: true,
                    theme: 'bootstrap4'
                });
                $('#namamasakan').select2({
                    width: '100%',
                    // allowClear: true,
                    closeOnSelect: true,
                    theme: 'bootstrap4'
                });

        });
    </script>

    </body>

</html>
