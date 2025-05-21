<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-sidebar-m></x-sidebar-m>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <x-topbar-m :nama="$murid['nama']" :avatar="$murid['avatar']" />
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">{{ $title }} - Semester {{ $selectedSemester }}</h1>
                    <a href="{{ route('murid.nilai.pdf', [$murid->id, 'semester' => $selectedSemester]) }}" class="btn btn-danger btn-sm">
                            <i class="fas fa-file-pdf mr-1"></i> Unduh PDF Semester {{ $selectedSemester }}
                    </a>
                </div>
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <form action="{{ route('murid.nilai') }}" method="GET">
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
                            <button type="submit" class="btn btn-primary mb-3 ">Filter</button>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead class="text-center">
                                    <tr>
                                        <th>Mata Pelajaran</th>
                                        {{-- <th>Semester</th> --}}
                                        {{-- <th>Guru</th> --}}
                                        <th>Nilai</th>
                                        <th>Predikat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($nilaiList as $index => $nilai)
                                    <tr>
                                        <td>{{ $nilai->mapel->nama }}</td>
                                        {{-- <td>{{ $nilai->semester }}</td> --}}
                                        {{-- <td>{{ $nilai->guru->nama }}</td> --}}
                                        <td class="text-center">{{ $nilai->nilai }}</td>
                                        <td class="text-center">{{ $nilai->predikat }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Tidak ada data nilai yang tersedia.</td>
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