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
                    <p class="mb-4">Sistem sedang mengevaluasi jawaban Anda. Mohon halaman browser jangan ditutup... Bila sudah lebih dari 30 menit, silakan coba direfresh.</p>
                    <div id="spinner" class="d-none">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    const spinner = document.getElementById("spinner");
    spinner.classList.remove("d-none"); // Show spinner

    document.addEventListener("DOMContentLoaded", function() {
        window.location.href = "<?= base_url('member/code-of-ethics/final-assessment/result') ?>";
    });
</script>
<?= $this->endSection() ?>