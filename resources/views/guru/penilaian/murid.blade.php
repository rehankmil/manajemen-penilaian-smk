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
                    <h1 class="h3 mb-0 text-gray-800">{{ $title }} Kelas {{ $kelas->kode }}</h1>
                    <a href="{{ route('guru.penilaian') }}" class="btn btn-info btn-sm">Kembali</a>
                </div>
                <div class="card">
                    <div class="card-header">
                    </div>
                    
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
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>NIS</th>
                                        <th>Nama</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($muridList as $index => $murid)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $murid->nis }}</td>
                                        <td>{{ $murid->nama }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('guru.penilaian.daftar-nilai', $murid->id) }}" class="btn btn-info btn-sm mr-1">
                                                    <i class="fa fa-list"></i> Daftar Nilai
                                                </a>
                                                <a href="{{ route('guru.penilaian.form-nilai', $murid->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-plus"></i> Tambah Nilai
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data murid</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
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
</x-layout>