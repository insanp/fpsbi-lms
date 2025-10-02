<?= $this->extend('member/layouts/code_ethics_topic_detail') ?>
<?= $this->section('content') ?>

<div class="row topic-content text-justify text-gray-900">
    <div class="col-lg-10">
        <p>Assessment merupakan bagian terakhir yang merangkum keseluruhan pengetahuan Anda terhadap topik Kode Etik dan Rules of Conduct. Assessment dapat dilakukan kapan saja dan tidak memiliki batas waktu, namun harus diselesaikan sebelum tanggal akhir akses program pembelajaran Anda.</p>
        <p>Assessment terdiri atas 20 soal pilihan ganda. Ketika Anda memulai Assessment, waktu akan mulai dihitung sejak pertama kali dikerjakan dan tercatat untuk keperluan pribadi Anda. Meski tidak ada batasan waktu, estimasi waktu pengerjaan keseluruhan adalah sekitar 60 menit atau lebih cepat.</p>
        <p>Berbeda dengan latihan kuis pada topik sebelumnya, Anda hanya memiliki <strong>maksimal tiga kali kesempatan untuk mengerjakan Assessment (dua kali pengulangan)</strong>. Setelah menyelesaikan seluruh soal, sistem akan memberikan umpan balik sebagai hasil dari pembelajaran. <strong>Anda lulus program ini ketika mendapat nilai minimal 80%.</strong></p>
        <p>Bila Anda siap untuk memulai Assessment, silakan gunakan tautan di bawah ini. Semoga berhasil!</p>

        <br />
        <form id="fa-start-form" action="<?= site_url('member/code-of-ethics/final-assessment/start') ?>" method="POST">
            <?php $secretKey = bin2hex(random_bytes(32)); // Generates a 64-character unique key
            session()->set('fa_secret_key', $secretKey); ?>
            <input type="hidden" name="fa_secret_key" value="<?= $secretKey ?>" />
            <input type="hidden" name="topic_id" value="<?= $topic_id ?>" />
            <div class="text-center"><button class="btn btn-success" type="submit">Mulai Assessment</button></div>
        </form>

    </div>
</div>
<br />
<?= $task_widget_quiz ?>
<?= $this->endSection() ?>