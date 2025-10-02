<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Show Topic</h1>
    </div>
    <p class="mb-4">Details of the topic</p>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Topic Details</h6>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" class="form-control" value="<?= $topic['title'] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="resume">Resume</label>
                <textarea id="resume" class="form-control" readonly><?= $topic['resume'] ?></textarea>
            </div>
            <!-- course and order_no are managed in the Course-Topic admin area -->
            <?php if (!empty($topic['cover_img'])): ?>
                <div class="form-group">
                    <label>Cover Image</label><br>
                    <img src="<?= base_url('assets/member/img/' . $topic['cover_img']) ?>" alt="Cover Image" style="max-width:200px;">
                </div>
            <?php endif; ?>
            <?php if (!empty($topic['template'])): ?>
                <div class="form-group">
                    <label>Template</label>
                    <input type="text" class="form-control" value="<?= $topic['template'] ?>" readonly>
                </div>
            <?php endif; ?>
            <a href="<?= base_url('admin/topics') ?>" class="btn btn-secondary">Back</a>
            <a href="<?= base_url('admin/topics/' . $topic['id'] . '/edit') ?>" class="btn btn-warning">Edit</a>
        </div>
    </div>

    <!-- Tasks Section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Tasks</h6>
            <a href="<?= base_url('admin/tasks/create/' . $topic['id']) ?>" class="btn btn-primary btn-sm">Add Task</a>
        </div>
        <div class="card-body">
            <?php if (!empty($tasks)): ?>
                <ul class="list-group">
                    <?php foreach ($tasks as $task): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong><?= $task['name'] ?></strong>
                                <p><?= $task['starting_statement'] ?></p>
                                <p><em>Type: <?= ucfirst(str_replace('_', ' ', $task['type'])) ?></em></p>
                            </div>
                            <div>
                                <a href="<?= base_url('admin/tasks/' . $task['id']) ?>" class="btn btn-info btn-sm">Show</a>
                                <a href="<?= base_url('admin/tasks/' . $task['id'] . '/edit') ?>" class="btn btn-warning btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm" onclick="deleteTask(<?= $task['id'] ?>)">Delete</button>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No tasks found for this topic.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    function deleteTask(taskId) {
        if (confirm('Are you sure you want to delete this task?')) {
            fetch('<?= base_url('admin/tasks/delete') ?>/' + taskId, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    }
</script>
<?= $this->endSection() ?>