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

        <x-sidebar-a></x-sidebar>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <x-topbar-a></x-topbar-a>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
                        <a href="{{ route('murid.index') }}" class="btn btn-info btn-sm">Kembali</a>
                    </div>

                    <div class="card">

                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="{{ asset('../' . $murid->avatar) }}" alt="{{ $murid->nama }}" class="img-thumbnail rounded-circle" width="150">
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th width="200">NIS</th>
                                            <td>{{ $murid->nis }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama</th>
                                            <td>{{ $murid->nama }}</td>
                                        </tr>
                                        <tr>
                                            <th>No. Telepon</th>
                                            <td>{{ $murid->no_telp }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Kelamin</th>
                                            <td>{{ $murid->jenis_kelamin }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Lahir</th>
                                            <td>{{ \Carbon\Carbon::parse($murid->tgl_lahir)->format('d F Y') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Kelas</th>
                                            <td>{{ $murid->kelas->kode ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Username Login</th>
                                            <td>{{ $murid->user->username }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-center mt-3">
                                <a href="{{ route('murid.edit', $murid->id) }}" class="btn btn-warning mr-2">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus data murid <strong>{{ $murid->nama }}</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <form action="{{ route('murid.destroy', $murid->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
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