<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>
<div class="container-fluid">

    <?php if (session()->getFlashdata('import_success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('import_success') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('import_error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('import_error') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

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
            <!-- Batch Import (AJAX) UI -->
            <div class="mb-4">
                <form id="batchImportForm" enctype="multipart/form-data" onsubmit="return false;">
                    <div class="form-group">
                        <label for="batchExcelFile">Batch Import Users (.csv atau .xlsx. Disarankan .csv dengan delimiter ';'):</label>
                        <input type="file" name="excelFile" id="batchExcelFile" class="form-control-file" accept=".xlsx,.csv" required>
                    </div>
                    <button type="button" id="startBatchImport" class="btn btn-info">Upload & Batch Import</button>
                </form>
                <div class="progress mt-2" style="height: 25px; display:none;" id="batchProgressBarContainer">
                    <div id="batchProgressBar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%">0%</div>
                </div>
                                <div id="batchImportStatus" class="mt-2"></div>
                                <ul class="nav nav-tabs" id="logTabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="all-log-tab" data-toggle="tab" href="#all-log" role="tab" aria-controls="all-log" aria-selected="true">All Logs</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="failed-log-tab" data-toggle="tab" href="#failed-log" role="tab" aria-controls="failed-log" aria-selected="false">Failed Only</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="logTabsContent">
                                    <div class="tab-pane fade show active" id="all-log" role="tabpanel" aria-labelledby="all-log-tab">
                                        <div id="batchImportLog" class="mt-2" style="max-height:200px;overflow:auto;"></div>
                                    </div>
                                    <div class="tab-pane fade" id="failed-log" role="tabpanel" aria-labelledby="failed-log-tab">
                                        <div id="batchImportFailedLog" class="mt-2" style="max-height:200px;overflow:auto;"></div>
                                    </div>
                                </div>
                                <style>
                                #batchImportLog.terminal-log, #batchImportFailedLog.terminal-log {
                                        background: #181818;
                                        color: #e0e0e0;
                                        font-family: "Fira Mono", "Consolas", "Menlo", monospace;
                                        font-size: 14px;
                                        border-radius: 6px;
                                        padding: 10px;
                                        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
                                }
                                #batchImportLog .log-insert, #batchImportFailedLog .log-insert { color: #7fff7f; }
                                #batchImportLog .log-update, #batchImportFailedLog .log-update { color: #7fdfff; }
                                #batchImportLog .log-fail, #batchImportFailedLog .log-fail { color: #ff7f7f; }
                                </style>
                                <button type="button" id="refreshAfterImport" class="btn btn-success mt-2" style="display:none;">Refresh</button>
            </div>
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <a href="<?= base_url('admin/users/create') ?>" class="btn btn-success btn-icon-split">
                        <span class="text">+ Tambah Manual</span>
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

</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(function() {
        var batchToken = null;
        var batchSize = 200;
        var totalRows = 0;
        var processed = 0;
        var imported = 0;
        var updated = 0;

        $('#startBatchImport').on('click', function() {
            var fileInput = $('#batchExcelFile')[0];
            if (!fileInput.files.length) {
                alert('Please select a file.');
                return;
            }
            var formData = new FormData();
            formData.append('excelFile', fileInput.files[0]);
            $('#startBatchImport').prop('disabled', true);
            $('#batchImportStatus').html('Uploading file...');
            $.ajax({
                url: '<?= base_url('admin/users/uploadImportFile') ?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(resp) {
                    if (resp.success) {
                        batchToken = resp.token;
                        $('#batchImportStatus').html('File uploaded. Starting batch import...');
                        $('#batchProgressBarContainer').show();
                        imported = 0;
                        updated = 0;
                        processed = 0;
                        runBatch(0);
                    } else {
                        $('#batchImportStatus').html('<span class="text-danger">' + resp.error + '</span>');
                        $('#startBatchImport').prop('disabled', false);
                    }
                },
                error: function() {
                    $('#batchImportStatus').html('<span class="text-danger">Upload failed.</span>');
                    $('#startBatchImport').prop('disabled', false);
                }
            });
        });

        function runBatch(batch) {
            $.ajax({
                url: '<?= base_url('admin/users/processImportBatch') ?>',
                type: 'POST',
                data: {
                    token: batchToken,
                    batch: batch,
                    batchSize: batchSize
                },
                success: function(resp) {
                    if (resp.success) {
                        imported += resp.imported;
                        updated += resp.updated;
                        processed = resp.processed;
                        totalRows = resp.total;
                        var percent = totalRows > 0 ? Math.round(processed / totalRows * 100) : 0;
                        $('#batchProgressBar').css('width', percent + '%').text(percent + '%');


                        // Show incremental log like a terminal
                        var $log = $('#batchImportLog');
                        var $failedLog = $('#batchImportFailedLog');
                        $log.addClass('terminal-log');
                        $failedLog.addClass('terminal-log');
                        if (resp.importedUsers && resp.importedUsers.length) {
                            resp.importedUsers.forEach(function(u) {
                                $log.append('<div class="log-insert">$ Inserted: [' + (u.member_id || '-') + '] ' + u.name + ' (' + u.email + ') </div>');
                            });
                        }
                        if (resp.updatedUsers && resp.updatedUsers.length) {
                            resp.updatedUsers.forEach(function(u) {
                                $log.append('<div class="log-update">$ Updated&nbsp;: [' + (u.member_id || '-') + '] ' + u.name + ' (' + u.email + ') </div>');
                            });
                        }
                        if (resp.failedUsers && resp.failedUsers.length) {
                            resp.failedUsers.forEach(function(u) {
                                var failMsg = '<div class="log-fail">$ Failed&nbsp;&nbsp;: [' + (u.member_id || '-') + '] ' + u.name + ' (' + u.email + ')  - ' + u.error + '</div>';
                                $log.append(failMsg);
                                $failedLog.append(failMsg);
                            });
                        }
                        // Auto-scroll to bottom
                        $log.scrollTop($log[0].scrollHeight);
                        $failedLog.scrollTop($failedLog[0].scrollHeight);

                        // Count failed imports incrementally
                        if (typeof window.failedCount === 'undefined') window.failedCount = 0;
                        if (resp.failedUsers && resp.failedUsers.length) {
                            window.failedCount += resp.failedUsers.length;
                        }

                        if (resp.done) {
                            $('#batchImportStatus').html('<span class="text-success">Batch import complete. Imported: ' + imported + ', Updated: ' + updated + ', <span class="text-danger">Failed: ' + (window.failedCount || 0) + '</span>.</span>');
                            $('#startBatchImport').prop('disabled', false);
                            $('#refreshAfterImport').show();
                        } else {
                            $('#batchImportStatus').html('Processing batch ' + (batch + 1) + '... Imported: ' + imported + ', Updated: ' + updated + ', <span class="text-danger">Failed: ' + (window.failedCount || 0) + '</span>.');
                            runBatch(batch + 1);
                        }
                        // Manual refresh button handler
                        $('#refreshAfterImport').on('click', function() {
                            location.reload();
                        });
                    } else {
                        $('#batchImportStatus').html('<span class="text-danger">' + resp.error + '</span>');
                        $('#startBatchImport').prop('disabled', false);
                    }
                },
                error: function() {
                    $('#batchImportStatus').html('<span class="text-danger">Batch import failed.</span>');
                    $('#startBatchImport').prop('disabled', false);
                }
            });
        }
    });
</script>
<?= $this->endSection() ?>