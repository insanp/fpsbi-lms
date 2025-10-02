<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Task</h1>
    </div>
    <p class="mb-4">Create a new task for the topic</p>
    <div class="card shadow mb-4">
        <div class="card-body">
            <?php if (session()->getFlashdata('validation_errors')): ?>
                <div class="alert alert-danger" role="alert">
                    <?= implode('<br>', session()->getFlashdata('validation_errors')) ?>
                </div>
            <?php endif; ?>
            <form action="<?= base_url('admin/tasks/store') ?>" method="post">
                <input type="hidden" name="topic_id" value="<?= $topic['id'] ?>">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="<?= old('name') ?>" required>
                </div>
                <div class="form-group">
                    <label for="starting_statement">Starting Statement</label>
                    <textarea id="starting_statement" name="starting_statement" class="form-control" required><?= old('starting_statement') ?></textarea>
                </div>
                <div class="form-group">
                    <label for="finishing_statement">Finishing Statement</label>
                    <textarea id="finishing_statement" name="finishing_statement" class="form-control" required><?= old('finishing_statement') ?></textarea>
                </div>
                <div class="form-group">
                    <label for="type">Type</label>
                    <select id="type" name="type" class="form-control" required>
                        <option value="quiz" <?= old('type') == 'quiz' ? 'selected' : '' ?>>Quiz</option>
                        <option value="assignment" <?= old('type') == 'assignment' ? 'selected' : '' ?>>Assignment</option>
                        <option value="exam" <?= old('type') == 'exam' ? 'selected' : '' ?>>Exam</option>
                        <option value="exam_mc" <?= old('type') == 'exam_mc' ? 'selected' : '' ?>>Exam (Multiple Choice)</option>
                        <option value="exam_short_answers" <?= old('type') == 'exam_short_answers' ? 'selected' : '' ?>>Exam (Short Answers)</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="<?= base_url('admin/topics/' . $topic['id']) ?>" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
