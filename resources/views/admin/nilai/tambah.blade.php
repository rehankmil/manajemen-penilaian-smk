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
                            <form action="{{ route('nilai.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mapel_id">Mata Pelajaran</label>
                                            <select name="mapel_id" id="mapel_id" class="form-control @error('mapel_id') is-invalid @enderror" required>
                                                <option value="">-- Pilih Mata Pelajaran --</option>
                                                @foreach($mapelList as $mapel)
                                                <option value="{{ $mapel->id }}" {{ old('mapel_id') == $mapel->id ? 'selected' : '' }}>
                                                    {{ $mapel->nama }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('mapel_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kelas_id">Kelas</label>
                                            <select name="kelas_id" id="kelas_id" class="form-control @error('kelas_id') is-invalid @enderror" required>
                                                <option value="">-- Pilih Kelas --</option>
                                                @foreach($kelasList as $kelas)
                                                    <option value="{{ $kelas->id }}" {{ old('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                                        {{ $kelas->kode }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('kelas_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="guru_id">Guru</label>
                                            <select name="guru_id" id="guru_id" class="form-control @error('guru_id') is-invalid @enderror" required>
                                                <option value="">-- Pilih Mata Pelajaran Terlebih Dahulu --</option>
                                                @if(old('mapel_id') && old('guru_id'))
                                                    @foreach($guruList->where('mapel_id', old('mapel_id')) as $guru)
                                                        <option value="{{ $guru->id }}" {{ old('guru_id') == $guru->id ? 'selected' : '' }}>
                                                            {{ $guru->nama }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('guru_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="murid_id">Murid</label>
                                            <select name="murid_id" id="murid_id" class="form-control @error('murid_id') is-invalid @enderror" required>
                                                <option value="">-- Pilih Kelas Terlebih Dahulu --</option>
                                                @if(old('kelas_id') && old('murid_id'))
                                                    @foreach($muridList->where('kelas_id', old('kelas_id')) as $murid)
                                                        <option value="{{ $murid->id }}" {{ old('murid_id') == $murid->id ? 'selected' : '' }}>
                                                            {{ $murid->nama }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('murid_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="semester">Semester</label>
                                            <select name="semester" id="semester" class="form-control @error('semester') is-invalid @enderror" required>
                                                <option value="">-- Pilih Semester --</option>
                                                @foreach($semesterList as $semester)
                                                    <option value="{{ $semester }}" {{ old('semester') == $semester ? 'selected' : '' }}>
                                                        Semester {{ $semester }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('semester')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nilai">Nilai</label>
                                            <input type="number" name="nilai" id="nilai" class="form-control @error('nilai') is-invalid @enderror" 
                                                value="{{ old('nilai') }}" min="0" max="100" required>
                                            <small class="form-text text-muted">Nilai antara 0-100</small>
                                            @error('nilai')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save"></i> Simpan
                                    </button>
                                    <a href="{{ route('nilai.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Batal
                                    </a>
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

    <script src="{{ asset('https://code.jquery.com/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/get-guru.js') }}"></script>
    <script src="{{ asset('js/get-murid.js') }}"></script>
    
</body>
</html>