<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Topic</h1>
    </div>
    <p class="mb-4">Create a new topic</p>
    <div class="card shadow mb-4">
        <div class="card-body">
            <?php if (session()->getFlashdata('validation_errors')): ?>
                <div class="alert alert-danger" role="alert">
                    <?= implode('<br>', session()->getFlashdata('validation_errors')) ?>
                </div>
            <?php endif; ?>
            <form action="<?= base_url('admin/topics/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="<?= old('title') ?>" required>
                </div>
                <div class="form-group">
                    <label for="resume">Resume</label>
                    <textarea name="resume" id="resume" class="form-control" required><?= old('resume') ?></textarea>
                </div>
                <!-- course and order_no are managed in the Course-Topic admin area -->
                <div class="form-group">
                    <label for="cover_img">Cover Image (filename)</label>
                    <input type="text" name="cover_img" id="cover_img" class="form-control" value="<?= old('cover_img') ?>">
                </div>
                <div class="form-group">
                    <label for="template">Template</label>
                    <input type="text" name="template" id="template" class="form-control" value="<?= old('template') ?>">
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="<?= base_url('admin/topics') ?>" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>