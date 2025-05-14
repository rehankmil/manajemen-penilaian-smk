<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ $title }}</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <x-sidebar-g></x-sidebar-g>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <x-topbar-g :email="$guru['email']" :avatar="$guru['avatar']" />

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card shadow mb-4">
                                <div class="card-body text-center">
                                    <img src="{{ $guru ['avatar'] }}" alt="Foto Guru" class="rounded-circle mb-3" width="120" height="120">
                                    <h4 class="card-title mb-0">{{ $guru ['nama'] }}</h4>
                                    <div class="text-muted mb-3">NIP: {{ $guru ['nip'] }}</div>
                                    <ul class="list-group list-group-flush text-left">
                                        <li class="list-group-item"><strong>Email:</strong> {{ $guru ['email'] }}</li>
                                        <li class="list-group-item"><strong>Nomor Telepon:</strong> {{ $guru ['no_telp'] }}</li>
                                        <li class="list-group-item"><strong>Tanggal Lahir:</strong> {{ $guru ['tgl_lahir'] }}</li>
                                        <li class="list-group-item"><strong>Jenis Kelamin:</strong> {{ $guru ['jenis_kelamin'] }}</li>
                                        <li class="list-group-item"><strong>Mata Pelajaran:</strong> {{ $guru->mapel->nama }} </li>
                                    </ul>
                                    <div class="text-muted mb-2">
                                        <a href="#">Ubah Profil</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                </div>
                <!-- /.container-fluid -->
                
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; rehankmil 2025</span>
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
    
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>

</body>

</html>