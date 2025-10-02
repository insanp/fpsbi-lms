<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Alumni</h1>
    </div>
    <p class="mb-4">Alumni anggota AFCI</p>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Alumni</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <a href="<?= base_url('admin/alumni/create') ?>" class="btn btn-success btn-icon-split">
                        <span class="text">+ Tambah Alumni</span>
                    </a>
                    <br /> <br />
                    <form id="filterForm" action="<?= base_url('admin/alumni') ?>" method="get">
                        <div class="row">
                            <div class="col-sm-12 col-md-3">
                                <div class="dataTables_length" id="dataTable_length"><label>Show <select name="perPage" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm">
                                            <option value="10" <?= $perPage == 10 ? 'selected' : '' ?>>10</option>
                                            <option value="25" <?= $perPage == 25 ? 'selected' : '' ?>>25</option>
                                            <option value="50" <?= $perPage == 50 ? 'selected' : '' ?>>50</option>
                                            <option value="100" <?= $perPage == 100 ? 'selected' : '' ?>>100</option>
                                        </select> entries</label></div>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <div class="dataTables_length" id="dataTable_length"><label>Course <select name="course_id" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm" onchange="document.getElementById('filterForm').submit();">
                                            <option value="">All</option>
                                            <?php foreach ($courses as $course): ?>
                                                <option value="<?= $course['id'] ?>" <?= $courseId == $course['id'] ? 'selected' : '' ?>><?= $course['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select></label></div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div id="dataTable_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable" name="search" value="<?= esc($searchTerm) ?>"></label></div>
                            </div>

                        </div>
                    </form>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Course</th>
                                        <th>Member ID</th>
                                        <th>Email</th>
                                        <th>Name</th>
                                        <th>Created At (Alumnus Date)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Course</th>
                                        <th>Member ID</th>
                                        <th>Email</th>
                                        <th>Name</th>
                                        <th>Created At (Alumnus Date)</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php if (!empty($alumni)) : ?>
                                        <?php foreach ($alumni as $alum) : ?>
                                            <tr class="odd">
                                                <td><?php echo $alum['course_name']; ?></td>
                                                <td><?php echo esc($alum['member_id']); ?></td>
                                                <td><?php echo esc($alum['email']); ?></td>
                                                <td><?php echo esc($alum['name']); ?></td>
                                                <td><?= date('d M Y H:i', strtotime($alum['alumnus_date'])) ?></td>
                                                <td>
                                                    <a href="<?= base_url('admin/alumni/' . $alum['alumni_id'] . '/edit') ?>" class="btn btn-warning btn-icon-split">
                                                        <span class="text">Edit</span>
                                                    </a>
                                                    <button class="btn btn-danger btn-icon-split delete-alumni" data-id="<?= $alum['alumni_id']; ?>">
                                                        <span class="text">Hapus</span>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <p>No alumni found.</p>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <?php
                            $tmp = $pager->getDetails();
                            $rowNumStart = max(($tmp['currentPage'] - 1) * $tmp['perPage'] + 1, 0);
                            $rowNumEnd = min($tmp['currentPage'] * $tmp['perPage'], $tmp['total']);
                            ?>
                            <div class="row">
                                <div class="col-sm-12 col-md-5 text-left">
                                    <div>Showing <?= $rowNumStart ?> to <?= $rowNumEnd ?> of <?= $tmp['total'] ?> entries</div>
                                </div>
                                <?= $pager->links('default', 'admin_paging') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-alumni').forEach(button => {
                button.addEventListener('click', function() {
                    const alumniId = this.getAttribute('data-id');

                    if (confirm('Are you sure you want to delete this alumni?')) {
                        fetch(`<?= base_url('/admin/alumni/delete/') ?>${alumniId}`, {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                },
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 'success') {
                                    alert(data.message);
                                    // Optionally, reload the page or remove the deleted row from the table
                                    location.reload();
                                } else {
                                    alert(data.message);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('An error occurred while deleting the alumni.');
                            });
                    }
                });
            });
        });
    </script>
</div>
<?= $this->endSection() ?>
