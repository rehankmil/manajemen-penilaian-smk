<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
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
                    <h1 class="h3 mb-0 text-gray-800">{{ $title }} - {{ $murid->nama }}</h1>
                    <a href="{{ route('guru.penilaian.daftar-nilai', $murid->id) }}" class="btn btn-info btn-sm">Kembali</a>
                </div>
                <div class="card">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form action="{{ route('guru.penilaian.store-nilai') }}" method="POST">
                            @csrf
                            <input type="hidden" name="murid_id" value="{{ $murid->id }}">
                            <div class="form-group row mb-3">
                                <label class="col-md-4 col-form-label">NIS</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{ $murid->nis }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-4 col-form-label text-md-right">Nama Murid</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{ $murid->nama }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-4 col-form-label text-md-right">Mata Pelajaran</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{ $mapel->nama }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="semester" class="col-md-4 col-form-label text-md-right">Semester</label>
                                <div class="col-md-6">
                                    <select name="semester" id="semester" class="form-control @error('semester') is-invalid @enderror" required>
                                        <option value="">-- Pilih Semester --</option>
                                        <option value="1">Ganjil</option>
                                        <option value="2">Genap</option>
                                    </select>
                                    @error('semester')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="nilai" class="col-md-4 col-form-label text-md-right">Nilai</label>
                                <div class="col-md-6">
                                    <input type="number" name="nilai" id="nilai" class="form-control @error('nilai') is-invalid @enderror" 
                                        value="{{ old('nilai') }}" min="0" max="100" required>
                                    @error('nilai')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save"></i> Tambah Nilai
                                    </button>
                                </div>
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
</x-layout>