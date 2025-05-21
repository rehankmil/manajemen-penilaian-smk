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
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-md-6 mb-4">
                            <div class="card">
                                <div class="card-header">Jumlah Perolehan Nilai</div>
                                <div class="card-body">
                                    <canvas id="predikatChart" 
                                    data-predicates="{{ json_encode($predicates) }}"
                                    data-counts="{{ json_encode($counts) }}"
                                    height="300">
                                    </canvas>
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