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
                    <a href="{{ route('nilai.create') }}" class="btn btn-info btn-sm">Tambah Nilai</a>
                </div>
                <div class="card">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <!-- Filter Section -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Filter</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('nilai.index') }}" method="GET">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-3 mr-5 mb-3">
                                            <label for="mapel_id" class="form-label">Mata Pelajaran</label>
                                            <select name="mapel_id" id="mapel_id" class="form-control">
                                                <option value="">-- Pilih Mata Pelajaran --</option>
                                                @foreach($mapelList as $mapel)
                                                <option value="{{ $mapel->id }}" {{ request('mapel_id') == $mapel->id ? 'selected' : '' }}>
                                                    {{ $mapel->nama }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-lg-3 mr-5 mb-3">
                                            <label for="kelas_id" class="form-label">Kelas</label>
                                            <select name="kelas_id" id="kelas_id" class="form-control">
                                                <option value="">-- Pilih Kelas --</option>
                                                @foreach($kelasList as $kelas)
                                                <option value="{{ $kelas->id }}" {{ request('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                                    {{ $kelas->kode }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-lg-3 mr-5 mb-3">
                                            <label for="guru_id" class="form-label">Guru</label>
                                            <select name="guru_id" id="guru_id" class="form-control">
                                                <option value="">-- Pilih Guru --</option>
                                                @foreach($guruList as $guru)
                                                <option value="{{ $guru->id }}" {{ request('guru_id') == $guru->id ? 'selected' : '' }}>
                                                    {{ $guru->nama }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-3 mr-5 mb-3">
                                            <label for="murid_id" class="form-label">Siswa</label>
                                            <select name="murid_id" id="murid_id" class="form-control">
                                                <option value="">-- Pilih Siswa --</option>
                                                @foreach($muridList as $murid)
                                                <option value="{{ $murid->id }}" {{ request('murid_id') == $murid->id ? 'selected' : '' }}>
                                                    {{ $murid->nama }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-lg-3 mr-5 mb-3">
                                            <label for="semester" class="form-label">Semester</label>
                                            <select name="semester" id="semester" class="form-control">
                                                <option value="">-- Pilih Semester --</option>
                                                @foreach($semesterList as $semester)
                                                <option value="{{ $semester }}" {{ request('semester') == $semester ? 'selected' : '' }}>
                                                    {{ $semester }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-lg-3 mr-5 mb-3">
                                            <label for="predikat" class="form-label">Predikat</label>
                                            <select name="predikat" id="predikat" class="form-control">
                                                <option value="">-- Pilih Predikat --</option>
                                                @foreach($predikatList as $predikat)
                                                <option value="{{ $predikat }}" {{ request('predikat') == $predikat ? 'selected' : '' }}>
                                                    {{ $predikat }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-3 mr-5 mb-3">
                                            <label for="nilai_min" class="form-label">Nilai Minimum</label>
                                            <input type="number" name="nilai_min" id="nilai_min" class="form-control" value="{{ request('nilai_min') }}" min="0" max="100">
                                        </div>
                                        <div class="col-md-6 col-lg-3 mr-5 mb-3">
                                            <label for="nilai_max" class="form-label">Nilai Maksimum</label>
                                            <input type="number" name="nilai_max" id="nilai_max" class="form-control" value="{{ request('nilai_max') }}" min="0" max="100">
                                        </div>
                                    </div>
                                    <div class="col-12 text-end">
                                        <div class="d-flex justify-content-end gap-2">
                                            <div class="mr-2">
                                                <button type="submit" class="btn btn-primary">Filter</button>
                                            </div>
                                            <div class="mr-2">
                                                <a href="{{ route('nilai.index') }}" class="btn btn-secondary">Reset</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Nilai Table -->
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Murid</th>
                                        <th>Kelas</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Guru</th>
                                        <th>Nilai</th>
                                        <th>Predikat</th>
                                        <th>Semester</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($nilaiList as $index => $nilai)
                                    <tr>
                                        <td>{{ $index + $nilaiList->firstItem() }}</td>
                                        <td>{{ $nilai->murid->nama }}</td>
                                        <td>{{ $nilai->murid->kelas->kode }}</td>
                                        <td>{{ $nilai->mapel->nama }}</td>
                                        <td>{{ $nilai->guru->nama }}</td>
                                        <td>{{ $nilai->nilai }}</td>
                                        <td>{{ $nilai->predikat }}</td>
                                        <td>{{ $nilai->semester }}</td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <a href="{{ route('nilai.show', $nilai->id) }}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('nilai.edit', $nilai->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('nilai.destroy', $nilai->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Tidak ada data nilai yang tersedia.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $nilaiList->appends(request()->all())->links('pagination::bootstrap-5') }}
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