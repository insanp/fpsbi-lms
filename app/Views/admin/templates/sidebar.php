<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled d-print-none" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin/dashboard') ?>">
        <div class="sidebar-brand-icon">
            <img src="<?= base_url('assets/images/logo_fpsb_indonesia_white.webp') ?>" height="30px">
        </div>
        <div class="sidebar-brand-text mx-3">IFP</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?= base_url('admin/dashboard') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/users') ?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Users</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/course-enrollments') ?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Course Enrollments</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/alumni') ?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Alumni</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/topics') ?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Topics</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/course-topics') ?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Course Topics</span></a>
    </li>

    <hr class="sidebar-divider">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->