<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>
<div class="container-fluid">

    <?php
    // Check for enrollment results from flashdata and display them
    $enrollmentResults = session()->getFlashdata('enrollment_results');
    if (!empty($enrollmentResults)) :
    ?>
        <div class="card mb-4">
            <div class="card-body">
                <h5>Enrollment Results</h5>
                <?php if (!empty($enrollmentResults['enrolled'])) : ?>
                    <div class="alert alert-success">
                        <strong>Enrolled:</strong>
                        <ul>
                            <?php foreach ($enrollmentResults['enrolled'] as $u) : ?>
                                <li><?= esc($u['member_id']) ?> - <?= esc($u['name']) ?> (<?= esc($u['email']) ?>)</li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if (!empty($enrollmentResults['skipped'])) : ?>
                    <div class="alert alert-warning">
                        <strong>Skipped:</strong>
                        <ul>
                            <?php foreach ($enrollmentResults['skipped'] as $u) : ?>
                                <li>
                                    <?= esc($u['member_id']) ?> - <?= esc($u['name']) ?> (<?= esc($u['email']) ?>)
                                    <?php if (!empty($u['reason'])) : ?>
                                        - <em><?= esc($u['reason']) ?></em>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Course Enrollments</h1>
    </div>
    <p class="mb-4">Course Enrollments anggota dari IFPI</p>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Enrollments</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <a href="<?= base_url('admin/course-enrollments/create') ?>" class="btn btn-success btn-icon-split">
                        <span class="text">+ Tambah User Enroll</span>
                    </a>
                    <br /> <br />
                    <form id="filterForm" action="<?= base_url('admin/course-enrollments') ?>" method="get">
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
                                        <th>Enrollment</th>
                                        <th>Member ID</th>
                                        <th>Email</th>
                                        <th>Name</th>
                                        <th>Enrolled At</th>
                                        <th>Access Until</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Enrollment</th>
                                        <th>Member ID</th>
                                        <th>Email</th>
                                        <th>Name</th>
                                        <th>Enrolled At</th>
                                        <th>Access Until</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php if (!empty($enrollments)) : ?>
                                        <?php foreach ($enrollments as $enroll) : ?>
                                            <tr class="">
                                                <td><?php echo $enroll['course_name']; ?></td>
                                                <td><?php echo esc($enroll['member_id']); ?></td>
                                                <td><?php echo esc($enroll['email']); ?></td>
                                                <td><?php echo esc($enroll['name']); ?></td>
                                                <td><?= date('d M Y H:i', strtotime($enroll['enrolled_at'])) ?></td>
                                                <td><?= date('d M Y H:i', strtotime($enroll['access_until'])) ?></td>
                                                <td>
                                                    <a href="<?= base_url('admin/course-enrollments/user-progress/' . $enroll['user_id'] . '/' . $enroll['course_id']) ?>" class="btn btn-info btn-icon-split">
                                                        <span class="text">Lihat Progress</span>
                                                    </a>
                                                    <a href="<?= base_url('admin/course-enrollments/' . $enroll['enroll_id'] . '/edit') ?>" class="btn btn-warning btn-icon-split">
                                                        <span class="text">Edit</span>
                                                    </a>
                                                    <button class="btn btn-danger btn-icon-split delete-enrollment" data-id="<?= $enroll['enroll_id']; ?>">
                                                        <span class="text">Hapus</span>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <p>No users found.</p>
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
            document.querySelectorAll('.delete-enrollment').forEach(button => {
                button.addEventListener('click', function() {
                    const enrollmentId = this.getAttribute('data-id');

                    if (confirm('Are you sure you want to delete this enrollment?')) {
                        fetch(`<?= base_url('/admin/course-enrollments/delete/') ?>${enrollmentId}`, {
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
                                alert('An error occurred while deleting the enrollment.');
                            });
                    }
                });
            });
        });
    </script>
</div>
<?= $this->endSection() ?>