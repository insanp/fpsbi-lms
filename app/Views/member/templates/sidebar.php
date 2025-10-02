<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled d-print-none" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('member/dashboard') ?>">
        <div class="sidebar-brand-icon">
            <img src="<?= base_url('assets/images/logo_fpsb_indonesia_white.webp') ?>" height="30px">
        </div>
        <div class="sidebar-brand-text mx-3"><?= WEBSITE_NAME_SHORT ?></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?= base_url('member/dashboard') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- LMS Zone -->
    <?php if (!empty($sessionData['active_enrollments'])) : ?>
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        LMS
    </div>

    <!-- IFP Zone -->
    <?php if (array_key_exists(COURSE_CODE_OF_ETHICS, $sessionData['active_enrollments'])): ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('member/code-of-ethics') ?>">
                <i class="fas fa-fw fa-shield-alt"></i>
                <span>Code of Ethics</span></a>
        </li>
    <?php endif; ?>

    <?php endif; ?>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Tools
    </div>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('member/notes/list') ?>">
            <i class="fas fa-fw fa-sticky-note"></i>
            <span>Notes</span></a>
    </li>

    <hr class="sidebar-divider">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->