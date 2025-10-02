<?= $this->extend('member/layouts/main') ?>
<?= $this->section('content') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Panduan</h1>
    </div>

    <div class="card shadow mb-4 col-lg-9 text-justify" style="padding:0px;">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tutorial Penggunaan Tools</h6>
        </div>
        <div class="card-body tutorial">
            <ol>
                <li>Pilih Tools dari sidebar kiri atau dashboard. AFCI menyediakan tiga Tools saat ini yaitu: Financial Health Scale, Klontz Money Behavior Inventory (KMBI), dan The Klontz Money Script Inventory-Revised (KMSI-R).</li>
                <li>Ikuti instruksi form dengan mengisi nama dan memilih jawaban yang tersedia untuk masing-masing pernyataan. Berikut ini contoh tampilan untuk Tools Financial Health Scale:<br /><img src="<?= base_url('assets/member/img/tutorial_01.jpg') ?>" /></li>
                <li>Klik submit setelah selesai mengisi formulir. Pastikan semua sudah terjawab.</li>
                <li>Halaman laporan akan dihasilkan. Scroll ke bawah untuk menemukan tiga tombol tambahan:<br /><img src="<?= base_url('assets/member/img/tutorial_02.jpg') ?>" /><br />
                    <strong>Tes Ulang</strong>: Kembali melakukan pengisian formulir yang masih kosong.<br />
                    <strong>Unduh Data</strong>: Menyimpan data formulir dalam format afci.<br />
                    <strong>Print Laporan</strong>: Menyimpan hasil analisis dalam bentuk pdf. Ilustrasi laporan KMBI:<br /><img src="<?= base_url('assets/member/img/tutorial_03.jpg') ?>" />
                </li>
                <li>File yang telah diunduh dalam format afci dapat di-import ke dalam formulir kembali untuk analisis ulang pada masing-masing form. Bila peruntukan formulir tidak sesuai, akan muncul pesan error seperti berikut:<br /> <img src="<?= base_url('assets/member/img/tutorial_04.jpg') ?>" /></li>
                <li>File yang berhasil di-import akan mengisi formulir kembali bersama dengan informasi bahwa file berhasil diunggah seperti berikut:<br /><img src="<?= base_url('assets/member/img/tutorial_05.jpg') ?>" /></li>
                <li>Pastikan logout setelah selesai menggunakan Tools.</li>
            </ol>
        </div>
    </div>

    <div class="card shadow mb-4 col-lg-9 text-justify" style="padding:0px;">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Panduan Penggunaan Software</h6>
        </div>
        <div class="card-body">

            <p class="mb-4">Untuk memastikan pengalaman pengguna yang aman dan transparan, harap ikuti panduan penggunaan berikut:</p>

            <h6 class="m-0 font-weight-bold text-primary">Isian Formulir</h6>

            <p class="mb-4">Isilah formulir dengan informasi Anda atau klien sesuai dengan instruksi yang diberikan. Pastikan memberikan data yang akurat untuk hasil yang lebih relevan.</p>

            <h6 class="m-0 font-weight-bold text-primary">Disclaimer</h6>

            <p class="mb-4">Harap diperhatikan bahwa kami sebagai penyedia layanan tidak menyimpan data analisis yang dimasukkan oleh pengguna.
                Data yang dimasukkan sepenuhnya menjadi tanggung jawab pribadi pengguna.
                Kami tidak memiliki akses atau kendali atas informasi yang dimasukkan, dan tidak akan menggunakan atau mengakses data pribadi Anda.</p>

            <h6 class="m-0 font-weight-bold text-primary">Privasi dan Keamanan</h6>

            <p class="mb-4">Kami mengambil langkah-langkah keamanan untuk melindungi privasi pengguna.
                Informasi yang dimasukkan akan dienkripsi untuk melindungi dari akses yang tidak sah. Sebagai langkah untuk privasi, pengguna dapat mengunduh atau mengekspor hasil input pengguna dan terenkripsi untuk referensi pribadi. File tersebut (.afci) dapat diunggah dan dianalisis ulang menggunakan tools yang tersedia.</p>

            <h6 class="m-0 font-weight-bold text-primary">Tanggung Jawab Pribadi</h6>

            <p>Setiap keputusan atau tindakan yang diambil berdasarkan hasil formulir sepenuhnya menjadi tanggung jawab pribadi pengguna.
                Kami tidak memberikan saran atau jaminan terkait keputusan keuangan yang diambil.
                Dengan menggunakan formulir ini, pengguna dianggap telah membaca, memahami, dan menyetujui ketentuan privasi dan tanggung jawab yang disebutkan di atas. Jika Anda memiliki pertanyaan atau kekhawatiran lebih lanjut, silakan hubungi tim dukungan kami. Terima kasih atas partisipasi Anda.</p>
        </div>
    </div>


</div>
<?= $this->endSection() ?>