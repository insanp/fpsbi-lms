<?= $this->extend('member/layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid topic-content-container">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">LMS - Kode Etik dan Rules of Conduct</h1>
    </div>

    <div class="row text-gray-900">
        <div class="col-lg-10">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col text-center">
                            <h2><strong>Assessment</strong></h2>
                        </div>
                    </div>
                    <br />
                    <table>
                        <tr>
                            <td>Member ID</td>
                            <td>: <?= $sessionData['member_id'] ?></td>
                        </tr>
                        <tr>
                            <td>Nama peserta</td>
                            <td>: <?= $sessionData['name'] ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row text-gray-900">
        <div class="col-lg-10 text-center">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <p>Selamat telah menyelesaikan Assessment.</p>
                    <div class="alert alert-danger" role="alert">
                        Ada masalah dalam penilaian jawaban otomatis oleh sistem.<br />Mohon informasikan admin terkait masalah ini. Terima kasih.<br />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>