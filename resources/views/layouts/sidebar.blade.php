<!-- resources/views/partials/sidebar.blade.php -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon">
            <img style="width: 40px" src="{{ asset('img/SM.png') }}" alt="">
        </div>
        <div class="sidebar-brand-text mx-3">SMP IT CENDIKIA</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-house"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        MENU
    </div>

    <li class="nav-item {{ request()->is('admin/siswa') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('siswa.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Siswa</span>
        </a>
    </li>

    <li class="nav-item {{ request()->is('admin/kelas') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kelas.index') }}">
            <i class="fas fa-fw fa-bank"></i>
            <span>Kelas</span>
        </a>
    </li>

    <li class="nav-item {{ request()->is('matpel') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('matpel.index') }}">
            <i class="fas fa-fw fa-book"></i>
            <span>Surah</span>
        </a>
    </li>

    <li class="nav-item {{ request()->is('tahsin') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('tahsin.index') }}">
            <i class="fas fa-fw fa-book"></i>
            <span>Tahsin</span>
        </a>
    </li>

    <li class="nav-item {{ request()->is('admin/rapor') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('rapor.index') }}">
            <i class="fas fa-fw fa-user-graduate"></i>
            <span>Rapor</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
