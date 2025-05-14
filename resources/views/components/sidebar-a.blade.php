<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-laptop-code"></i>
        </div>
        <div class="sidebar-brand-text mx-3"> SIP SMK </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <x-sidebar-link href="{{ route('dashboard') }}" routeName="dashboard" icon="fa-tachometer-alt" label="Dashboard" />

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Daftar
    </div>

    <x-sidebar-link href="{{ route('mapel.index') }}" routeName="mapel.index" icon="fa-book-open" label="Mata Pelajaran" />
    <x-sidebar-link href="{{ route('kelas.index') }}" routeName="kelas.index" icon="fa-school" label="Kelas" />
    <x-sidebar-link href="{{ route('guru.index') }}" routeName="guru.index" icon="fa-chalkboard-teacher" label="Guru" />
    <x-sidebar-link href="{{ route('murid.index') }}" routeName="murid.index" icon="fa-user-friends" label="Murid" />
    <x-sidebar-link href="{{ route('nilai.index') }}" routeName="nilai.index" icon="fa-chart-line" label="Nilai" />

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->