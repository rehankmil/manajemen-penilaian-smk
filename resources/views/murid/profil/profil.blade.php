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
                    <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6">
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
                        <div class="card shadow mb-4">
                            <div class="card-body text-center">
                                <img src="{{ $murid ['avatar'] }}" alt="Avatar Murid" class="rounded-circle mb-3" width="120" height="120">
                                <h4 class="card-title mb-0">{{ $murid ['nama'] }}</h4>
                                <div class="text-muted mb-3">NIS: {{ $murid ['nis'] }}</div>
                                <ul class="list-group list-group-flush text-left">
                                    <li class="list-group-item"><strong>Nomor Telepon:</strong> {{ $murid ['no_telp'] }}</li>
                                    <li class="list-group-item"><strong>Tanggal Lahir:</strong> {{ $murid ['tgl_lahir'] }}</li>
                                    <li class="list-group-item"><strong>Jenis Kelamin:</strong> {{ $murid ['jenis_kelamin'] }}</li>
                                    <li class="list-group-item"><strong>Kelas:</strong> {{ $murid->kelas->kode }} </li>
                                </ul>
                                <div class="text-muted mb-2">
                                    <a href="{{ route('murid.profil.ubah') }}">Ubah Profil</a>
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