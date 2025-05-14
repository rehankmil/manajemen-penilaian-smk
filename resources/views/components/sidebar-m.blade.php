<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('murid.dashboard') }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-laptop-code"></i>
        </div>
        <div class="sidebar-brand-text mx-3"> SIP SMK </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <x-sidebar-link href="{{ route('murid.dashboard') }}" routeName="murid.dashboard" icon="fa-tachometer-alt" label="Dashboard" />

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Daftar
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <x-sidebar-link href="{{ route('nilaimurid') }}" routeName="nilaimurid" icon="fas fa-award" label="Nilai" />

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->