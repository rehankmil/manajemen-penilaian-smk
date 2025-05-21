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
                    <a href="{{ route('murid.create') }}" class="btn btn-info btn-sm">Tambah Murid</a>
                </div>
                    <div class="card">
                        <div class="card-body">
                             @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            <!-- Form Pencarian -->
                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-6">
                                    <form action="{{ route('murid.index') }}" method="GET" id="searchForm">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" 
                                                placeholder="Cari berdasarkan NIS, nama, telepon, atau kelas..." 
                                                value="{{ $search ?? '' }}"
                                                id="searchInput">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit">
                                                    <i class="fas fa-search"></i> Cari
                                                </button>
                                                @if(isset($search) && $search)
                                                <a href="{{ route('murid.index') }}" class="btn btn-secondary">
                                                    <i class="fas fa-times"></i> Reset
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @if(isset($search) && $search)
                            <div class="alert alert-info mb-3">
                                <i class="fas fa-info-circle"></i> Hasil pencarian untuk: <strong>{{ $search }}</strong>
                                <span class="float-right">Ditemukan: <strong>{{ $murid->total() }}</strong> data</span>
                            </div>
                            @endif
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
                                            <th>Avatar</th>
                                            <th>NIP</th>
                                            <th>Nama</th>
                                            <th>No. Telepon</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Kelas</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($murid as $index => $item)
                                            <tr>
                                                <td>{{ $index + $murid->firstItem() }}</td>
                                                <td>
                                                    <img src="{{ asset('../' . $item->avatar) }}" alt="{{ $item->nama }}" class="img-thumbnail" width="50">
                                                </td>
                                                <td>{{ $item->nis }}</td>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->no_telp }}</td>
                                                <td>{{ $item->jenis_kelamin }}</td>
                                                <td>{{ $item->kelas->kode ?? '-' }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('murid.show', $item->id) }}" class="btn btn-info btn-sm">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('murid.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $item->id }}">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                    <!-- Delete Modal -->
                                                    <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Apakah Anda yakin ingin menghapus data murid <strong>{{ $item->nama }}</strong>?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                    <form action="{{ route('murid.destroy', $item->id) }}" method="POST">
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
                                            <td colspan="8" class="text-center">Tidak ada data murid</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        <div class="d-flex justify-content-center mt-3">
                            {{ $murid->links('pagination::bootstrap-5') }}
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