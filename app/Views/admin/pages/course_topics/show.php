<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Course-Topic Mapping</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="form-group">
                <label>Course</label>
                <input class="form-control" value="<?= esc($item['course_name'] ?? '') ?>" readonly>
            </div>
            <div class="form-group">
                <label>Topic</label>
                <input class="form-control" value="<?= esc($item['topic_title'] ?? '') ?>" readonly>
            </div>
            <div class="form-group">
                <label>Order No</label>
                <input class="form-control" value="<?= esc($item['order_no'] ?? '') ?>" readonly>
            </div>
            <a class="btn btn-secondary" href="<?= base_url('admin/course-topics') ?>">Back</a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
