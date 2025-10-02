<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Course-Topic Mapping</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <?php if (session()->getFlashdata('validation_errors')): ?>
                <div class="alert alert-danger"><?= implode('<br>', session()->getFlashdata('validation_errors')) ?></div>
            <?php endif; ?>

            <form action="<?= base_url('admin/course-topics/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="course_id">Course</label>
                    <select name="course_id" id="course_id" class="form-control">
                        <?php foreach ($courses as $c): ?>
                            <option value="<?= $c['id'] ?>"><?= esc($c['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="topic_id">Topic</label>
                    <select name="topic_id" id="topic_id" class="form-control">
                        <?php foreach ($topics as $t): ?>
                            <option value="<?= $t['id'] ?>"><?= esc($t['title']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="order_no">Order No</label>
                    <input type="number" name="order_no" id="order_no" class="form-control" value="<?= old('order_no') ?>">
                </div>
                <button class="btn btn-primary">Create</button>
                <a class="btn btn-secondary" href="<?= base_url('admin/course-topics') ?>">Back</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
