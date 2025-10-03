<!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->include('admin/templates/meta_header'); ?>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/admin/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/css/portal.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/admin/vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="<?= base_url('favicon.ico') ?>">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <?= $this->include('admin/templates/sidebar') ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column" style="background: url('<?= base_url('assets/member/img/bg.webp') ?>')">

            <!-- Main Content -->
            <div id="content">
                <?= $this->include('admin/templates/topbar') ?>
                <?= $this->renderSection('content'); ?>

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; <?= WEBSITE_NAME . ' ' . date('Y') ?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Anda yakin untuk logout?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih logout untuk mengakhiri sesi Anda.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primary" href="<?= base_url('auth/logout') ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/admin/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/admin/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/admin/js/sb-admin-2.min.js') ?>"></script>

    <!-- Page level plugins -->
    <script src="<?= base_url('assets/admin/vendor/chart.js/Chart.min.js') ?>"></script>

    <?= $this->renderSection('scripts'); ?>
</body>

</html>