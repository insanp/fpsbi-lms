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
                <button type="button" class="btn btn-success btn-icon-split" id="send-account-creation-btn">
                    <span class="text">Kirim Email Pembuatan Akun</span>
                </button>
                <div id="account-creation-info" class="mt-3"></div>
                <script>
                document.getElementById('send-account-creation-btn').addEventListener('click', function() {
                    if (!confirm('Yakin ingin mengirim email pembuatan akun? Ini akan mengaktifkan akun dan mengirim email ke user.')) return;
                    var btn = this;
                    btn.disabled = true;
                    btn.innerHTML = '<span class="text">Mengirim...</span>';
                    fetch('<?= base_url('admin/users/send-account-creation-ajax/' . $user['id']) ?>', {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
                        },
                        body: JSON.stringify({})
                    })
                    .then(response => response.json())
                    .then(data => {
                        var infoDiv = document.getElementById('account-creation-info');
                        if (data.success) {
                            infoDiv.innerHTML = '<div class="alert alert-success">' + data.message + '<br>Email: ' + data.email + '<br>Waktu: ' + data.sent_at + '</div>';
                        } else {
                            infoDiv.innerHTML = '<div class="alert alert-danger">' + data.message + '</div>';
                        }
                        btn.disabled = false;
                        btn.innerHTML = '<span class="text">Kirim Email Pembuatan Akun</span>';
                    })
                    .catch(err => {
                        document.getElementById('account-creation-info').innerHTML = '<div class="alert alert-danger">Terjadi kesalahan saat mengirim permintaan.</div>';
                        btn.disabled = false;
                        btn.innerHTML = '<span class="text">Kirim Email Pembuatan Akun</span>';
                    });
                });
                </script>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>