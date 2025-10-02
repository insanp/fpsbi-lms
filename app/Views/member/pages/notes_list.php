<?= $this->extend('member/layouts/main') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Notes</h1>

    <div class="row mb-3">
        <div class="col-lg-10">
            <!-- Course Filter Dropdown -->
            <form method="get" action="<?= base_url('member/notes/list') ?>">
                <div class="form-group">
                    <label for="course_id">Kursus LMS</label>
                    <select name="course_id" id="course_id" class="form-control" onchange="this.form.submit()">
                        <option value="">-- Pilih Program --</option>
                        <?php foreach ($courses as $course): ?>
                            <option value="<?= $course['id'] ?>" <?= $selectedCourseId == $course['id'] ? 'selected' : '' ?>>
                                <?= $course['name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </form>

            <!-- Notes List -->
            <?php if (!empty($topics)): ?>
                <?php foreach ($topics as $topic): ?>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title"><?= $topic['title'] ?></h5>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($topic['notes'])): ?>
                                <?php foreach ($topic['notes'] as $note): ?>
                                    <p><?= $note['note'] ?></p>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>-</p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Tidak ada topik untuk program kursus ini.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>