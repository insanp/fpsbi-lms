<?= $this->extend('member/layouts/code_ethics_topic_detail') ?>
<?= $this->section('content') ?>

<div class="row topic-content text-justify text-gray-900">
    <div class="col-lg-10">
        <h3 class="text-center"><strong>Kode Etik dan Rules of Conduct Perencana Keuangan</strong></h3>
        <p>Kode Etik dan Rules of Conduct merupakan fondasi moral dan profesional bagi setiap perencana keuangan bersertifikat CFP. FPSB Indonesia menetapkan 8 prinsip kode etik—seperti mengutamakan kepentingan klien, integritas, objektivitas, keadilan, profesionalisme, kompetensi, kerahasiaan, dan kehati-hatian—sebagai pedoman utama yang wajib dipatuhi. Prinsip-prinsip ini menuntut setiap perencana untuk menempatkan klien sebagai prioritas utama, menjaga standar kejujuran, serta memberikan layanan dengan kualitas terbaik.</p>
        <p>Selain itu, terdapat 37 Rules of Conduct yang menjabarkan aturan praktis dalam menjalankan profesi, mulai dari larangan memberikan informasi menyesatkan, kewajiban menjaga kerahasiaan data, hingga ketentuan keterbukaan atas konflik kepentingan. Aturan ini bukan sekadar formalitas, tetapi bertujuan memastikan agar profesi perencana keuangan dijalankan secara adil, transparan, dan akuntabel. Melalui pemahaman kode etik dan rules of conduct, peserta akan menyadari pentingnya membangun kepercayaan klien sekaligus menjaga reputasi profesi di mata publik.</p>
        <p><strong>Materi Slide</strong><br />
            <i class="fas fa-file-pdf"></i> <a href="<?= base_url('member/download/Kode Etik dan Rules of Conduct.pdf') ?>">Kode Etik dan Rules of Conduct.pdf</a>
        </p>
        <br />
        <h4 class="text-center">Video Code of Ethics and Rules of Conduct<br /> <span class="text-xs">Duration: 37m 44s</span></h4>
        <?= view('member/widgets/gumlet_video', [
            'player_id' => 'video1',
            'playbackUrl' => 'https://video.gumlet.io/684017330f8d7a05183098ad/68a822a20a8c57042d5d877e/main.m3u8',
            'thumbnail' => 'https://video.gumlet.io/684017330f8d7a05183098ad/68a822a20a8c57042d5d877e/thumbnail-1-0.png?v=1758167618271',
            'resolutions' => [
                '360' => '68a822a20a8c57042d5d877e_0_360p.m3u8',
                '480' => '68a822a20a8c57042d5d877e_0_480p.m3u8',
                '540' => '68a822a20a8c57042d5d877e_0_540p.m3u8'
            ]
        ]) ?>
        <br />
        <hr />
        <br />
    </div>
</div>
<?= $task_widget_quiz ?>
<?= $this->endSection() ?>