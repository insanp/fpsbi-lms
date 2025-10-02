<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Topics</h1>
    </div>
    <p class="mb-4">List of topics with relevant filters</p>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Topics</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <a href="<?= base_url('admin/topics/create') ?>" class="btn btn-success btn-icon-split">
                        <span class="text">+ Create Topic</span>
                    </a>
                    <br /> <br />
                    <form id="filterForm" action="<?= base_url('admin/topics') ?>" method="get">
                        <div class="row">
                            <div class="col-sm-12 col-md-3">
                                <div class="dataTables_length" id="dataTable_length"><label>Show <select name="perPage" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm" onchange="document.getElementById('filterForm').submit();">
                                            <option value="10" <?= $perPage == 10 ? 'selected' : '' ?>>10</option>
                                            <option value="25" <?= $perPage == 25 ? 'selected' : '' ?>>25</option>
                                            <option value="50" <?= $perPage == 50 ? 'selected' : '' ?>>50</option>
                                            <option value="100" <?= $perPage == 100 ? 'selected' : '' ?>>100</option>
                                        </select> entries</label></div>
                            </div>
                            <div class="col-sm-12 col-md-3"></div>
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
                                        <th>Title</th>
                                        <th>Cover</th>
                                        <th>Template</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Title</th>
                                        <th>Cover</th>
                                        <th>Template</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php if (!empty($topics)) : ?>
                                        <?php foreach ($topics as $topic) : ?>
                                            <tr class="">
                                                <td><?php echo esc($topic['title']); ?></td>
                                                <td class="text-center">
                                                    <?php if (!empty($topic['cover_img'])): ?>
                                                        <img src="<?= base_url('assets/member/img/' . $topic['cover_img']) ?>" style="max-width:80px;">
                                                    <?php else: ?>
                                                        N/A
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo esc($topic['template']); ?></td>
                                                <td><?= date('d M Y H:i', strtotime($topic['created_at'])) ?></td>
                                                <td><?= date('d M Y H:i', strtotime($topic['updated_at'])) ?></td>
                                                <td>
                                                    <a href="<?= base_url('admin/topics/' . $topic['id']) ?>" class="btn btn-info btn-icon-split">
                                                        <span class="text">Show</span>
                                                    </a>
                                                    <a href="<?= base_url('admin/topics/' . $topic['id'] . '/edit') ?>" class="btn btn-warning btn-icon-split">
                                                        <span class="text">Edit</span>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <p>No topics found.</p>
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
</div>
<?= $this->endSection() ?>