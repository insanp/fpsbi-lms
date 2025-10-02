<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Alumni</h1>
    </div>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <div class="card shadow mb-4 p-4">
        <form method="post" action="<?= base_url("admin/alumni/update") ?>">
            <?= csrf_field() ?>
            <input type="hidden" name="id" value="<?= $alumni['id'] ?>">
            <div class="form-group">
                <label>Course</label>
                <input type="text" class="form-control" value="<?= $alumni['course_id'] ?>" disabled>
            </div>
            <div class="form-group">
                <label>User</label>
                <input type="text" class="form-control" value="<?= $alumni['user_id'] ?>" disabled>
            </div>
            <div class="form-group">
                <label>Created At (Alumnus Date)</label>
                <input type="datetime-local" class="form-control" name="created_at" value="<?= date('Y-m-d\TH:i', strtotime($alumni['created_at'])) ?>" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
