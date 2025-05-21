<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
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
                    <a href="{{ route('nilai.index') }}" class="btn btn-info btn-sm">Kembali</a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header bg-primary">
                                        <h5 class="card-title mb-0 text-white">Informasi Murid</h5>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th width="30%">Nama Murid</th>
                                                <td>: {{ $nilai->murid->nama }}</td>
                                            </tr>
                                            <tr>
                                                <th>NIS</th>
                                                <td>: {{ $nilai->murid->nis ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Kelas</th>
                                                <td>: {{ $nilai->murid->kelas->kode ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Semester</th>
                                                <td>: Semester {{ $nilai->semester }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header bg-info">
                                        <h5 class="card-title mb-0 text-white">Informasi Penilaian</h5>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th width="30%">Mata Pelajaran</th>
                                                <td>: {{ $nilai->mapel->nama }}</td>
                                            </tr>
                                            <tr>
                                                <th>Guru</th>
                                                <td>: {{ $nilai->guru->nama }}</td>
                                            </tr>
                                            <tr>
                                                <th>Nilai</th>
                                                <td>: {{ $nilai->nilai }}</td>
                                            </tr>
                                            <tr>
                                                <th>Predikat</th>
                                                <td>: 
                                                    <span class="badge {{ 
                                                        $nilai->predikat == 'A' ? 'badge-success' : 
                                                        ($nilai->predikat == 'B' ? 'badge-primary' : 
                                                        ($nilai->predikat == 'C' ? 'badge-warning' : 
                                                        ($nilai->predikat == 'D' ? 'badge-danger' : 'badge-secondary'))) 
                                                    }}">
                                                        {{ $nilai->predikat }}
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="card bg-light">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Keterangan Predikat</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3 mb-2">
                                                <span class="badge badge-success">A</span> : Sangat Baik (Nilai 90-100)
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <span class="badge badge-primary">B</span> : Baik (Nilai 80-89)
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <span class="badge badge-warning">C</span> : Cukup (Nilai 70-79)
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <span class="badge badge-danger">D</span> : Kurang (Nilai 60-69)
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <span class="badge badge-secondary">E</span> : Sangat Kurang (Nilai < 60)
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <a href="{{ route('nilai.edit', $nilai->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit Data
                                </a>
                                <form action="{{ route('nilai.destroy', $nilai->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <i class="fas fa-trash"></i> Hapus Data
                                    </button>
                                </form>
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
</x-layout>