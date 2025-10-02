<?= $this->extend('admin/layouts/login') ?>
<?= $this->section('content') ?>
<div class="bg-image"></div>
<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block login-logo">
                            <img src="<?= base_url('assets/images/logo_fpsb_indonesia.webp') ?>" width="50%" />
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">FPSB Indonesia LMS</h1>
                                </div>
                                <?php if (!empty($message)): ?>
                                    <div class="alert alert-info" role="alert">
                                        <?= esc($message) ?>
                                    </div>
                                <?php endif; ?>
                                <?php
                                if (!empty($validation_errors)) {
                                    foreach ($validation_errors as $field => $error) {
                                        echo "<p style='color:red'>{$error}</p>";
                                    }
                                }
                                ?>
                                <form class="user" action="<?= base_url('auth/login') ?>" method="post">
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" name="email" placeholder="Enter Email Address..." value="<?= old('email') ?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="password" placeholder="Password">
                                    </div>
                                    <button type="submit" id="form-submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                </form>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
<?= $this->endSection() ?>