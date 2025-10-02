<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Artikel</h1>
    </div>
    <p class="mb-4">Artikel yang tampil sebagai berita.</p>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Artikel</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <a href="<?= base_url('admin/articles/create') ?>" class="btn btn-success btn-icon-split">
                    <span class="text">+ Tambah</span>
                </a>
                <br /> <br />
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Title</th>
                            <th>Resume</th>
                            <th>Status</th>
                            <th width="200px">Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>id</th>
                            <th>Title</th>
                            <th>Resume</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php if (!empty($articles)) : ?>
                            <?php foreach ($articles as $article) : ?>
                                <tr class="">
                                    <td><?php echo esc($article['id']); ?></td>
                                    <td><?php echo esc($article['title']); ?></td>
                                    <td><?php echo esc($article['resume']); ?></td>
                                    <td><?php echo esc($article['status']); ?></td>
                                    <td><a href="<?= base_url('admin/articles/' . $article['id']) ?>" class="btn btn-info btn-icon-split">
                                            <span class="text">Lihat</span>
                                        </a>
                                        <a href="<?= base_url('admin/articles/' . $article['id'] . '/edit') ?>" class="btn btn-warning btn-icon-split">
                                            <span class="text">Edit</span>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <p>No articles found.</p>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>