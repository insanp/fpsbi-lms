<?= $this->extend('member/layouts/main') ?>
<?= $this->section('content') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <p class="mb-4">Selamat datang <strong><?= $sessionData['name'] ?></strong> di dashboard member <?= WEBSITE_NAME ?>.</p>

    <?php if ($sessionData['is_fresh_acc']) : ?>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Profil</h6>
            </div>
            <div class="card-body">
                <p>
                    <a href="<?= base_url('member/profile') ?>" class="btn btn-warning btn-icon-split d-print-none">
                        <span class="text"><i class="fas fa-exclamation fa-sm text-white-50"></i> Perbaharui Password</span>
                    </a> Pastikan Anda mengganti password pertama kali Anda masuk.
                </p>
            </div>
        </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Enrollment</h6>
        </div>
        <div class="card-body">
            <?php if (!isset($sessionData['active_enrollments']) || empty($sessionData['active_enrollments'])) : ?>
                <p>Anda belum terdaftar dalam program apapun.</p>
            <?php elseif (array_key_exists(COURSE_CODE_OF_ETHICS, $sessionData['active_enrollments'])): ?>
                <p class="mb-4">
                    <a href="<?= base_url('member/code-of-ethics') ?>" class="btn btn-primary btn-icon-split d-print-none">
                        <span class="text"><i class="fas fa-shield-alt fa-sm text-white-50"></i> Go to Code of Ethics Zone</span>
                    </a>
                    Anda terdaftar dalam program Code of Ethics.
                </p>
            <?php endif; ?>
        </div>
    </div>

</div>
<?= $this->endSection() ?>