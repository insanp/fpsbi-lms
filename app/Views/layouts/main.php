<!DOCTYPE html>
<html lang="en">

<head>
  <?= $this->include('templates/meta_header'); ?>
  <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('assets/css/fontawesome.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/fpsbi-lms.css') ?>?20102024">
  <link rel="stylesheet" href="<?= base_url('assets/css/owl.css') ?>">
</head>

<body>
  <div id="preloader">
    <div class="jumper">
      <div></div>
      <div></div>
      <div></div>
    </div>
  </div>

  <!-- Header -->
  <?= $this->include('templates/header'); ?>
  <?= $this->renderSection('content'); ?>
  <?= $this->include('templates/footer') ?>

  <div class="sub-footer">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <p>Copyright &copy; <?= date('Y') . ' ' . WEBSITE_NAME; ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

  <!-- Additional Scripts -->
  <script src="<?= base_url('assets/js/custom.js') ?>"></script>
  <script src="<?= base_url('assets/js/owl.js') ?>"></script>
  <script src="<?= base_url('assets/js/slick.js') ?>"></script>
  <script src="<?= base_url('assets/js/accordions.js') ?>"></script>
</body>

</html>