<?= $this->extend('member/layouts/main') ?>
<?= $this->section('content') ?>
<div class="container-fluid topic-content-container">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">LMS - Code of Ethics and Rules of Conduct</h1>
    </div>

    <p class="mb-4 text-justify">Selamat datang, <strong><?= $sessionData['name'] ?></strong>, di platform LMS untuk program Kode Etik dan Aturan Perilaku. Di bawah ini, Anda akan menemukan daftar topik/modul dalam program ini. Silakan akses dan selesaikan setiap modul secara berurutan dari awal hingga akhir. Harap diperhatikan bahwa akses Anda ke program ini berlaku hingga <strong class="text-danger"><?= date('l, d M Y H:i', strtotime($accessUntil)) ?></strong>.</p>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger" role="alert">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <div class="row mb-3">
        <div class="col-lg-10">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Progres Anda
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $progressPercentage ?>%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: <?= $progressPercentage ?>%" aria-valuenow="<?= $progressPercentage ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php foreach ($topics as $topic): ?>
        <?php $borderClass = ($topic['access'] === 'completed') ? 'border-left-success' : '';
        if ($topic['access'] !== 'locked'):
        ?>
            <?php $linkId = $topic['course_topic_id']; ?>
            <a href="<?= base_url('member/code-of-ethics/topic/' . $linkId) ?>" class="program-module-container" style="text-decoration: none;">
        <?php endif; ?>
            <div class="row">
                <div class="col-lg-10">
                    <div class="card <?= $borderClass ?> shadow mb-4 program-module">
                        <?php if ($topic['access'] === 'locked'): ?>
                            <div class="overlay text-center">
                                <div class="overlay-content">
                                    <img src="<?= base_url('assets/member/img/padlock.webp') ?>" /><br/>
                                    <span>Selesaikan topik-topik sebelumnya.</span>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <div class="row">
                                <!-- Changed column classes for responsive layout -->
                                <div class="col-12 col-md-4 text-center">
                                    <img src="<?= base_url('assets/member/img/') . $topic['cover_img'] ?>" class="img-fluid" />
                                </div>
                                <div class="col-12 col-md d-flex flex-column">
                                    <p class="text-justify"><strong><?= $topic['title'] ?></strong><br /><span class="text-dark"><?= $topic['resume'] ?></span>
                                    </p>
                                    <br />

                                    <!-- Quiz -->
                                    <?php if (isset($topic['quiz']) && $topic['quiz'] !== null): ?>
                                        <div class="mt-auto">
                                            <em>Latihan Quiz:</em>
                                            <?php if ($topic['quiz']['quiz_stars'] !== null): ?>
                                                <?php for ($i = 0; $i < $topic['quiz']['quiz_stars']; $i++): ?>
                                                    <i class="fas fa-star" style="color:gold;"></i>
                                                <?php endfor; ?>
                                                <?php for ($i = 0; $i < (3 - $topic['quiz']['quiz_stars']); $i++): ?>
                                                    <i class="far fa-star" style="color:gray;"></i>
                                                <?php endfor; ?>
                                            <?php else: ?>
                                                <i class="far fa-star" style="color:gray;"></i>
                                                <i class="far fa-star" style="color:gray;"></i>
                                                <i class="far fa-star" style="color:gray;"></i>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Status -->
                                    <?php if ($topic['completed_at']): ?>
                                        <div class="mt-auto text-right" style="color: green;">
                                            Selesai
                                            <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?= $topic['completed_at'] ?>"></i>
                                        </div>
                                    <?php else: ?>
                                        <div class="mt-auto text-right" style="color: red;">Belum selesai</div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($topic['access'] !== 'locked'): ?>
            </a>
    <?php endif;
        endforeach; ?>
</div>
<?= $this->endSection() ?>