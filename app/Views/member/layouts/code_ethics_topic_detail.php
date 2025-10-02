<!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->include('member/templates/meta_header'); ?>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/member/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/css/portal.css') ?>" rel="stylesheet">
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

                <div class="container-fluid topic-content-container" style="position: relative;">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">LMS - Code of Ethics and Rules of Conduct</h1>
                    </div>

                    <div class="row text-gray-900">
                        <div class="col-lg-10">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col text-center">
                                            <h2><strong><?= $topic['title'] ?></strong></h2>
                                            <p class=""><?= $topic['resume'] ?></p>
                                        </div>
                                    </div>
                                    <br />
                                    <div class="row" style="max-height:200px; overflow: hidden;">

                                        <div class="col-4 text-left">
                                            <?php if ($previous_topic): $prevLink = $previous_topic['course_topic_id']; ?><a href="<?= base_url('member/code-of-ethics/topic/' . $prevLink) ?>">Mundur<br /><img src="<?= base_url('assets/member/img/') . $previous_topic['cover_img'] ?>" style="width:100%; max-width:150px;" /></a><br /><?= $previous_topic['title'] ?><?php endif; ?>
                                        </div>

                                        <div class="col-4 text-center"><a href="<?= base_url('member/code-of-ethics') ?>">Ke Daftar Topik</a><br /><?= $current_topic_number . ' dari ' . $total_topics ?></div>

                                        <div class="col-4 text-right">
                                            <?php if ($next_topic): $nextLink = $next_topic['course_topic_id']; ?><a id="go-to-next" href="<?= base_url('member/code-of-ethics/topic/' . $nextLink) ?>">Lanjut<br /><img src="<?= base_url('assets/member/img/') . $next_topic['cover_img'] ?>" style="width:100%; max-width:150px;" /><br /></a><?= $next_topic['title'] ?><?php endif; ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?= $this->renderSection('content'); ?>

                    <?= view('member/widgets/notes', ['topic_id' => $topic['id'], 'note' => $note]) ?>

                    <div class="row text-gray-900">
                        <div class="col-lg-10">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <div class="row" style="max-height:200px; overflow: hidden;">
                                        <div class="col-4 text-left">
                                            <?php if ($previous_topic): $prevLink = $previous_topic['course_topic_id']; ?><a href="<?= base_url('member/code-of-ethics/topic/' . $prevLink) ?>">Mundur<br /><img src="<?= base_url('assets/member/img/') . $previous_topic['cover_img'] ?>" style="width:100%; max-width:150px;" /></a><br /><?= $previous_topic['title'] ?><?php endif; ?>
                                        </div>

                                        <div class="col-4 text-center"><a href="<?= base_url('member/code-of-ethics') ?>">Ke Daftar Topik</a><br /><?= $current_topic_number . ' dari ' . $total_topics ?></div>

                                        <div class="col-4 text-right">
                                            <?php if ($next_topic): $nextLink = $next_topic['course_topic_id']; ?><a href="<?= base_url('member/code-of-ethics/topic/' . $nextLink) ?>">Lanjut<br /><img src="<?= base_url('assets/member/img/') . $next_topic['cover_img'] ?>" style="width:100%; max-width:150px;" /><br /></a><?= $next_topic['title'] ?><?php endif; ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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