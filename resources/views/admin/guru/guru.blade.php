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
                    <a href="{{ route('guru.create') }}" class="btn btn-info btn-sm">Tambah Guru</a>
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
                            <!-- Sorting Options -->
                            <div class="mb-3">
                                <form action="{{ route('guru.index') }}" method="GET" class="form-inline">
                                    <div class="form-group mr-2">
                                        <label for="sort" class="mr-2">Urutkan:</label>
                                        <select name="sort" id="sort" class="form-control" onchange="this.form.submit()">
                                            <option value="latest" {{ $sort == 'latest' ? 'selected' : '' }}>Terbaru</option>
                                            <option value="oldest" {{ $sort == 'oldest' ? 'selected' : '' }}>Terlama</option>
                                            <option value="asc" {{ $sort == 'asc' ? 'selected' : '' }}>Nama (A-Z)</option>
                                            <option value="desc" {{ $sort == 'desc' ? 'selected' : '' }}>Nama (Z-A)</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Avatar</th>
                                            <th>NIP</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>No. Telepon</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($gurus as $index => $guru)
                                            <tr>
                                                <td>{{ $index + $gurus->firstItem() }}</td>
                                                <td>
                                                    <img src="{{ asset('../' . $guru->avatar) }}" alt="{{ $guru->nama }}" class="img-thumbnail" width="50">
                                                </td>
                                                <td>{{ $guru->nip }}</td>
                                                <td>{{ $guru->nama }}</td>
                                                <td>{{ $guru->email }}</td>
                                                <td>{{ $guru->no_telp }}</td>
                                                <td>{{ $guru->jenis_kelamin }}</td>
                                                <td>{{ $guru->mapel->nama ?? '-' }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('guru.show', $guru->id) }}" class="btn btn-info btn-sm">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('guru.edit', $guru->id) }}" class="btn btn-warning btn-sm">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $guru->id }}">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                    <!-- Delete Modal -->
                                                    <div class="modal fade" id="deleteModal{{ $guru->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Apakah Anda yakin ingin menghapus data guru <strong>{{ $guru->nama }}</strong>?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                    <form action="{{ route('guru.destroy', $guru->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                        <tr>
                                            <td colspan="9" class="text-center">Tidak ada data guru</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                {{ $gurus->links('pagination::bootstrap-5') }}
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