<!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->include('member/templates/meta_header'); ?>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/member/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/css/portal.css') ?>" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="<?= base_url('favicon.ico') ?>">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <?= $this->include('member/templates/sidebar') ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column" style="background: url('<?= base_url('assets/member/img/bg.webp') ?>')">

            <!-- Main Content -->
            <div id="content">
                <?= $this->include('member/templates/topbar') ?>
                <?= $this->renderSection('content'); ?>

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; <?= WEBSITE_NAME . ' ' .  date('Y') ?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded d-print-none" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <?= $this->include('member/templates/footer'); ?>
</body>

</html>