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
                    <div>
                        <a href="{{ route('guru.penilaian.form-nilai', $murid->id) }}" class="btn btn-info btn-sm">Tambah</a>
                        <a href="{{ route('guru.penilaian.daftar-murid', $murid->kelas->id) }}" class="btn btn-secondary btn-sm">Kembali</a>
                    </div>
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
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <table class="table table-sm">
                                    <tr>
                                        <th width="30%">NIS</th>
                                        <td>: {{ $murid->nis }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama</th>
                                        <td>: {{ $murid->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kelas</th>
                                        <td>: {{ $murid->kelas->kode }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-sm">
                                    <tr>
                                        <th width="40%">Mata Pelajaran</th>
                                        <td>: {{ $mapel->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kode Mapel</th>
                                        <td>: {{ $mapel->kode }}</td>
                                    </tr>
                                    <tr>
                                        <th>Guru Pengajar</th>
                                        <td>: {{ $guru->nama }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="text-center">
                                    <tr>
                                        {{-- <th>No</th> --}}
                                        <th>Semester</th>
                                        <th>Nilai</th>
                                        <th>Predikat</th>
                                        <th>Tanggal Input</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($nilaiList as $index => $nilai)
                                    <tr>
                                        {{-- <td>{{ $index + 1 }}</td> --}}
                                        <td>{{ $nilai->semester }}</td>
                                        <td>{{ $nilai->nilai }}</td>
                                        <td>{{ $nilai->predikat }}</td>
                                        <td>{{ $nilai->created_at }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('guru.penilaian.edit-nilai', $nilai->id) }}" class="btn btn-warning btn-sm mr-1">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <form action="{{ route('guru.penilaian.destroy-nilai', $nilai->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus nilai ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada data nilai</td>
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