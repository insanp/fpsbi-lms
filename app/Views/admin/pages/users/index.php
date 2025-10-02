<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Users</h1>
    </div>
    <p class="mb-4">Anggota <?= WEBSITE_NAME ?></p>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Users</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <a href="<?= base_url('admin/users/create') ?>" class="btn btn-success btn-icon-split">
                        <span class="text">+ Tambah</span>
                    </a>
                    <br /> <br />
                    <form action="<?= base_url('admin/users') ?>" method="get">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_length" id="dataTable_length"><label>Show <select name="perPage" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm">
                                            <option value="10" <?= $perPage == 10 ? 'selected' : '' ?>>10</option>
                                            <option value="25" <?= $perPage == 25 ? 'selected' : '' ?>>25</option>
                                            <option value="50" <?= $perPage == 50 ? 'selected' : '' ?>>50</option>
                                            <option value="100" <?= $perPage == 100 ? 'selected' : '' ?>>100</option>
                                        </select> entries</label></div>
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
                                        <th>ID</th>
                                        <th>Member ID</th>
                                        <th>Email</th>
                                        <th>Name</th>
                                        <th>Aktif</th>
                                        <th width="200px">Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Member ID</th>
                                        <th>Email</th>
                                        <th>Name</th>
                                        <th>Aktif</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php if (!empty($users)) : ?>
                                        <?php foreach ($users as $enroll) : ?>
                                            <tr class="">
                                                <td><?php echo esc($enroll['id']); ?> <?= ($enroll['is_admin']) ? '(admin)' : '' ?></td>
                                                <td><?php echo esc($enroll['member_id']); ?></td>
                                                <td><?php echo esc($enroll['email']); ?></td>
                                                <td><?php echo esc($enroll['name']); ?></td>
                                                <td><?php echo esc($enroll['is_active']); ?></td>
                                                <td><a href="<?= base_url('admin/users/' . $enroll['id']) ?>" class="btn btn-info btn-icon-split">
                                                        <span class="text">Lihat</span>
                                                    </a>
                                                    <a href="<?= base_url('admin/users/' . $enroll['id'] . '/edit') ?>" class="btn btn-warning btn-icon-split">
                                                        <span class="text">Edit</span>
                                                    </a>
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
    <?= $this->endSection() ?>