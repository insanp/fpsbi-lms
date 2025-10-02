<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid topic-content-container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Admin Dashboard - User Progress</h1>
    </div>

    <p class="mb-4">
        Viewing progress for: <strong><?= $user['name'] ?></strong> in Course ID: <strong><?= $courseId ?></strong>.
    </p>

    <!-- Progress Bar -->
    <div class="row mb-3">
        <div class="col-lg-10">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Progress</div>
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $progressPercentage ?>%</div>
                        </div>
                        <div class="col">
                            <div class="progress progress-sm mr-2">
                                <div class="progress-bar bg-info" role="progressbar"
                                    style="width: <?= $progressPercentage ?>%"
                                    aria-valuenow="<?= $progressPercentage ?>"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <!-- Refresh Progress Button -->
                        <a href="<?= base_url('/admin/course-enrollments/refresh-user-progress/' . $user['id'] . '/' . $courseId) ?> " class="btn btn-primary">Refresh Progress</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Topics List -->
    <ul>
        <?php foreach ($topics as $topic): ?>
            <li>
                <strong class="text-success">Topic <?= $topic['order_no'] ?></strong> -
                <strong><?= $topic['title'] ?></strong>
                <?php if ($topic['completed_at']): ?>
                    <span class="mt-auto text-right text-success">(Completed at <?= $topic['completed_at'] ?>)</span>
                <?php else: ?>
                    <span class="mt-auto text-right text-danger">(Not Completed)</span>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<?= $this->endSection() ?>