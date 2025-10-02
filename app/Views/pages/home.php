<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="main-banner header-text" id="home">
    <div class="bg-image"></div>
    <div class="container pt-4">
        <div class="row">
            <div class="col-md-7 align-self-center">
                <div class="main-banner-text container">
                    <h1>Code of Ethics eLearning</h1>
                    <br />
                    <div class="text-justify">
                        <p>Kode Etik adalah fondasi utama profesi perencana keuangan. Melalui prinsip integritas, objektivitas, dan profesionalisme, FPSB Indonesia memastikan setiap profesional selalu mengutamakan kepentingan klien dan menjaga kepercayaan masyarakat.
                        </p>
                        <br />
                        <a href="<?= base_url('member') ?>" class="filled-button" style="margin-bottom:15px;">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="more-info hubungi-kami" id="hubungi_kami">
    <div class="container pt-4 pb-4">
        <div class="row">
            <div class="col-xl-12">
                <div class="belt-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 align-self-center text-justify">
                                <h3>Hubungi Kami</h3>
                            </div>
                            <div class="col-md-6 align-self-center pt-3">
                                <div class="contact-row">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <span>
                                        <a target="_blank" href="https://goo.gl/maps/u7PigjCukTpe7XVR8">
                                            Gedung Citilofts Sudirman Lt.7 Suite 08<br />
                                            Jalan KH Mas Mas Mansyur No. 121,<br />
                                            Jakarta Pusat 10220</a>
                                    </span>
                                </div>
                                <div class="contact-row">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    <span>Email 1: info@fpsbindonesia.net</span>
                                </div>
                                <div class="contact-row">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    <span>Email 2: fpsbindonesia@gmail.com</span>
                                </div>
                                <div class="contact-row">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                    <span>+62 21 25556623 / +62 21 25556624 (fax)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>