<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Course Topics</h1>
    </div>

    <a href="<?= base_url('admin/course-topics/create') ?>" class="btn btn-success mb-3">+ Create Mapping</a>

    <div class="card shadow mb-4">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Course</th>
                        <th>Topic</th>
                        <th>Order No</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($items)): ?>
                        <?php foreach ($items as $item): ?>
                            <tr>
                                <td><?= esc($item['course_name']) ?></td>
                                <td><?= esc($item['topic_title']) ?></td>
                                <td><?= esc($item['order_no']) ?></td>
                                <td>
                                    <a href="<?= base_url('admin/course-topics/' . $item['id'] . '/edit') ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="<?= base_url('admin/topics/' . $item['topic_id'] ) ?>" class="btn btn-success btn-sm">Show Topic</a>
                                    <button class="btn btn-danger btn-sm" onclick="deleteItem(<?= $item['id'] ?>)">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="4">No mappings found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <?= $pager->links('default', 'admin_paging') ?>
        </div>
    </div>
</div>

<script>
function deleteItem(id) {
    if (!confirm('Delete this mapping?')) return;
    fetch('<?= base_url('admin/course-topics/delete') ?>/' + id, { method: 'DELETE' })
        .then(r => r.json()).then(j => { if (j.status === 'success') location.reload(); else alert('Delete failed'); });
}
</script>

<?= $this->endSection() ?>
