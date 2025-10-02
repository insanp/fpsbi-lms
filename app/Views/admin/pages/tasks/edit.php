<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Task</h1>
    </div>
    <p class="mb-4">Edit the task details</p>
    <div class="card shadow mb-4">
        <div class="card-body">
            <?php if (session()->getFlashdata('validation_errors')): ?>
                <div class="alert alert-danger" role="alert">
                    <?= implode('<br>', session()->getFlashdata('validation_errors')) ?>
                </div>
            <?php endif; ?>
            <form action="<?= base_url('admin/tasks/update') ?>" method="post">
                <input type="hidden" name="id" value="<?= $task['id'] ?>">
                <input type="hidden" name="topic_id" value="<?= $task['topic_id'] ?>">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="<?= old('name', $task['name']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="starting_statement">Starting Statement</label>
                    <textarea id="starting_statement" name="starting_statement" class="form-control" required><?= old('starting_statement', $task['starting_statement']) ?></textarea>
                </div>
                <div class="form-group">
                    <label for="finishing_statement">Finishing Statement</label>
                    <textarea id="finishing_statement" name="finishing_statement" class="form-control" required><?= old('finishing_statement', $task['finishing_statement']) ?></textarea>
                </div>
                <div class="form-group">
                    <label for="type">Type</label>
                    <select id="type" name="type" class="form-control" required>
                        <option value="quiz" <?= old('type', $task['type']) == 'quiz' ? 'selected' : '' ?>>Quiz</option>
                        <option value="assignment" <?= old('type', $task['type']) == 'assignment' ? 'selected' : '' ?>>Assignment</option>
                        <option value="exam" <?= old('type', $task['type']) == 'exam' ? 'selected' : '' ?>>Exam</option>
                        <option value="exam_mc" <?= old('type', $task['type']) == 'exam_mc' ? 'selected' : '' ?>>Exam (Multiple Choice)</option>
                        <option value="exam_short_answers" <?= old('type', $task['type']) == 'exam_short_answers' ? 'selected' : '' ?>>Exam (Short Answers)</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?= base_url('admin/topics/' . $task['topic_id']) ?>" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
