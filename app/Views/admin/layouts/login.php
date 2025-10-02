<!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->include('admin/templates/meta_header'); ?>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/admin/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/css/portal.css') ?>" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="<?=base_url('favicon.ico')?>">
</head>

<body class="bg-gradient-primary">
    <?= $this->renderSection('content'); ?>
    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/admin/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/admin/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/admin/js/sb-admin-2.min.js') ?>"></script>

</body>

</html>