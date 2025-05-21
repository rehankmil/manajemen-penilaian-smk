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
                    <a href="{{ route('murid.profil') }}" class="btn btn-info btn-sm">Kembali</a>
                </div>
                <div class="card">
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('murid.profil.update') }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="nis" class="form-label">NIS</label>
                                <h4 class="form-control">{{ $murid->nis }}</p>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <h4 class="form-control">{{ $murid->nama }}</p>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Kelas</label>
                                <h4 class="form-control">{{ $murid->kelas->kode }}</p>
                            </div>
                            <div class="mb-3">
                                <label for="no_telp" class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                                <input id="no_telp" type="text" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" value="{{ old('no_telp', $murid->no_telp) }}" required>
                                @error('no_telp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tgl_lahir" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                <input id="tgl_lahir" type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir" value="{{ old('tgl_lahir', $murid->tgl_lahir) }}" required>
                                @error('tgl_lahir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin<span class="text-danger">*</span></label>
                                <select id="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" required>
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="L" {{ old('jenis_kelamin', $murid->jenis_kelamin) == 'L' ? 'selected' : '' }}>L</option>
                                    <option value="P" {{ old('jenis_kelamin', $murid->jenis_kelamin) == 'P' ? 'selected' : '' }}>P</option>
                                </select>
                                @error('jenis_kelamin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Avatar <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <div class="row">
                                        @foreach($avatars as $avatar)
                                            <div class="col-md-4 mb-3">
                                                <img src="{{ asset('../' . $avatar) }}" class="card-img-top img-fluid w-50" alt="Avatar {{ $loop->iteration }}">
                                                <div class="card-body p-2 text-left">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="avatar" id="avatar{{ $loop->iteration }}" value="{{ $avatar }}" {{ old('avatar', $murid->avatar) == $avatar ? 'checked' : ($loop->first ? 'checked' : '') }}>
                                                        <label class="form-check-label" for="avatar{{ $loop->iteration }}">
                                                            Pilih
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('avatar')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Ubah Data</button>
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