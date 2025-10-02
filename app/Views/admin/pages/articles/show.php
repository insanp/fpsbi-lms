<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Artikel</h1>
    </div>
    <p class="mb-4">Detail Artikel</p>
    <div class="card shadow mb-4 p-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <tbody>
                        <tr>
                            <td>ID:</td>
                            <td><?= $article['id'] ?></td>
                        </tr>
                        <tr>
                            <td>Judul:</td>
                            <td><?= $article['title'] ?></td>
                        </tr>
                        <tr>
                            <td>ID Penulis:</td>
                            <td><?= $article['author_id'] ?></td>
                        </tr>
                        <tr>
                            <td>Slug:</td>
                            <td><?= $article['slug'] ?></td>
                        </tr>
                        <tr>
                            <td>Resume:</td>
                            <td><?= $article['resume'] ?></td>
                        </tr>
                        <tr>
                            <td>Konten:</td>
                            <td><?= $article['content'] ?></td>
                        </tr>
                        <tr>
                            <td>Status:</td>
                            <td><?= $article['status'] ?></td>
                        </tr>
                        <tr>
                            <td>Dibuat:</td>
                            <td><?= $article['created_at'] ?></td>
                        </tr>
                        <tr>
                            <td>Diperbaharui:</td>
                            <td><?= $article['updated_at'] ?></td>
                        </tr>
                    </tbody>
                </table>
                <a href="<?= base_url('admin/articles/' . $article['id'] . '/edit') ?>" class="btn btn-warning btn-icon-split">
                    <span class="text">Edit</span>
                </a>
                <a href="<?= base_url('admin/articles') ?>" class="btn btn-secondary btn-icon-split">
                    <span class="text">Kembali ke list</span>
                </a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>