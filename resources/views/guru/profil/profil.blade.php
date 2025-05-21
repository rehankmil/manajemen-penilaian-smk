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
                    <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
                    <a href="{{ route('guru.dashboard') }}" class="btn btn-info btn-sm">Kembali</a>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card shadow mb-4">
                            <div class="card-body text-center">
                                <img src="{{ $guru ['avatar'] }}" alt="Foto Guru" class="rounded-circle mb-3" width="120" height="120">
                                <h4 class="card-title mb-0">{{ $guru ['nama'] }}</h4>
                                <div class="text-muted mb-3">NIP: {{ $guru ['nip'] }}</div>
                                <ul class="list-group list-group-flush text-left">
                                    <li class="list-group-item"><strong>Email:</strong> {{ $guru ['email'] }}</li>
                                    <li class="list-group-item"><strong>Nomor Telepon:</strong> {{ $guru ['no_telp'] }}</li>
                                    <li class="list-group-item"><strong>Tanggal Lahir:</strong> {{ $guru ['tgl_lahir'] }}</li>
                                    <li class="list-group-item"><strong>Jenis Kelamin:</strong> {{ $guru ['jenis_kelamin'] }}</li>
                                    <li class="list-group-item"><strong>Mata Pelajaran:</strong> {{ $guru->mapel->nama }} </li>
                                </ul>
                                <div class="text-muted mb-2">
                                    <a href="{{ route('guru.profil.ubah') }}">Ubah Profil</a>
                                </div>
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