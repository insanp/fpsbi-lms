<?= $this->extend('member/layouts/main') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Profile</h1>
    </div>
    <p class="mb-4">Data profil saya</p>
    <div class="card shadow mb-4 p-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <tbody>
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
                            <td>Join pada:</td>
                            <td><?= date('l, d M Y', strtotime($user['created_at'])) ?></td>
                        </tr>
                        <tr>
                            <td>Terakhir update:</td>
                            <td><?= date('l, d M Y H:i:s', strtotime($user['updated_at'])) ?></td>
                        </tr>
                    </tbody>
                </table>
                <a href="<?= base_url('member/profile/edit') ?>" class="btn btn-warning btn-icon-split">
                    <span class="text">Edit</span>
                </a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>