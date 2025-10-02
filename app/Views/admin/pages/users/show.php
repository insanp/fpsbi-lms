<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Users</h1>
    </div>
    <p class="mb-4">Detail User / Member</p>
    <div class="card shadow mb-4 p-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <tbody>
                        <tr>
                            <td>ID:</td>
                            <td><?= $user['id'] ?></td>
                        </tr>
                        <tr>
                            <td>Member ID:</td>
                            <td><?= $user['member_id'] ?></td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td><?= $user['email'] ?></td>
                        </tr>
                        <tr>
                            <td>Nama:</td>
                            <td><?= $user['name'] ?></td>
                        </tr>
                        <tr>
                            <td>Aktif:</td>
                            <td><?= $user['is_active'] ?></td>
                        </tr>
                        <tr>
                            <td>Seorang admin:</td>
                            <td><?= $user['is_admin'] ?></td>
                        </tr>
                        <tr>
                            <td>Join pada:</td>
                            <td><?= date('l, d M Y', strtotime($user['created_at'])) ?></td>
                        </tr>
                        <tr>
                            <td>Terakhir update:</td>
                            <td><?= date('l, d M Y H:i:s', strtotime($user['updated_at'])) ?></td>
                        </tr>
                        <tr>
                            <td>Terakhir login:</td>
                            <td><?= date('l, d M Y H:i:s', strtotime($user['last_login'])) ?></td>
                        </tr>
                    </tbody>
                </table>
                <a href="<?= base_url('admin/users/' . $user['id'] . '/edit') ?>" class="btn btn-warning btn-icon-split">
                    <span class="text">Edit</span>
                </a>
                <a href="<?= base_url('admin/users') ?>" class="btn btn-secondary btn-icon-split">
                    <span class="text">Kembali ke list</span>
                </a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>