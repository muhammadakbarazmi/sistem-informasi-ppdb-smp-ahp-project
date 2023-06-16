<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Halaman Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data Master
    </div>

        <!-- Nav Item - Charts -->
        <li class="nav-item">
        <a class="nav-link" href="/admin/kriteria">
            <i class="fas fa-fw fa-folder"></i>
            <span>Data Kriteria</span></a>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="/admin/alternatif">
            <i class="fas fa-fw fa-folder"></i>
            <span>Data Alternatif</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/admin/user">
            <i class="fas fa-fw fa-cog"></i>
            <span>Data User</span></a>
    </li>

    <!-- Heading -->
    <div class="sidebar-heading">
        Perhitungan AHP
    </div>

    <li class="nav-item">
        <a class="nav-link" href="/admin/criteriaData">
            <i class="fas fa-database nav-icon"></i>
            <span>Alternatif Siswa</span></a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-clipboard-list"></i>
            <span>Kriteria</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="/admin/perbandingan/criteria">Perbandingan Kriteria</a>
                <a class="collapse-item" href="/admin/ratioCriteria">Hasil Hitung Kriteria</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="far fa-address-book"></i>
            <span>Alternatif</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="/admin/ratioAlternative">Perbandingan Alternatif</a>
                <a class="collapse-item" href="/admin/resultAlternative">Hasil Hitung Alternatif</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/admin/rangking">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Hasil Perhitungan</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
