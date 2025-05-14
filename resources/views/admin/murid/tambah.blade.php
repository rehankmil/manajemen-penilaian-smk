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

        <x-sidebar-a></x-sidebar-a>

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
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('murid.store')}}">
                                @csrf
                                <div class="mb-3">
                                    <label for="nis" class="form-label">NIS <span class="text-danger">*</span></label>
                                    <input id="nis" type="text" class="form-control @error('nis') is-invalid @enderror" name="nis" value="{{ old('nis') }}" required autofocus>
                                    @error('nis')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    <small class="text-muted">NIP akan digunakan sebagai username untuk login</small>
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
                                    <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required>
                                    @error('nama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="no_telp" class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                                    <input id="no_telp" type="text" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" value="{{ old('no_telp') }}" required>
                                    @error('no_telp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tgl_lahir" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input id="tgl_lahir" type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir" value="{{ old('tgl_lahir') }}" required>
                                    @error('tgl_lahir')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin<span class="text-danger">*</span></label>
                                    <select id="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" required>
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>L</option>
                                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>P</option>
                                    </select>
                                    @error('jenis_kelamin')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="kelas_id" class="form-label">Kelas <span class="text-danger">*</span></label>
                                    <select id="kelas_id" class="form-control @error('kelas_id') is-invalid @enderror" name="kelas_id" required>
                                        <option value="">-- Pilih Mata Pelajaran --</option>
                                        @foreach($kelas as $kela)
                                            <option value="{{ $kela->id }}" {{ old('kelas_id') == $kela->id ? 'selected' : '' }}>
                                                {{ $kela->kode }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kelas_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Avatar <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <div class="row">
                                            @foreach($avatars as $avatar)
                                                <div class="col-md-4 mb-3">
                                                    <img src="{{ asset('../' . $avatar) }}" class="card-img-top img-fluid w-50" alt="Avatar {{ $loop->iteration }}">
                                                    <div class="card-body p-2 text-left">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="avatar" id="avatar{{ $loop->iteration }}" value="{{ $avatar }}" {{ old('avatar') == $avatar ? 'checked' : ($loop->first ? 'checked' : '') }}>
                                                            <label class="form-check-label" for="avatar{{ $loop->iteration }}">
                                                                Pilih
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('avatar')
                                            <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                                </div>
                            </form>
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