<?= $this->extend('templates/layout') ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="<?= base_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') ?>" />

<link rel="stylesheet" href="<?= base_url('assets/vendor/libs/apex-charts/apex-charts.css') ?>" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Selamat Datang <?= session()->get('username') ?></h5>
                            <p class="mb-4">
                               Anda Login Sebagai <strong><?= session()->get('role') ?></strong> di Sistem Informasi P4KM
                            </p>

                            <a href="<?= base_url('laporanpembinaan') ?>" class="btn btn-sm btn-outline-primary">Lihat Laporan</a>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img
                                src="../assets/img/illustrations/man-with-laptop-light.png"
                                height="140"
                                alt="View Badge User"
                                data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
  
</div>

<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
<!-- Vendors JS -->
<script src="<?= base_url('assets/vendor/libs/apex-charts/apexcharts.js') ?>"></script>

<!-- Main JS -->
<script src="<?= base_url('assets/js/main.js') ?>"></script>

<!-- Page JS -->
<script src="<?= base_url('assets/js/dashboards-analytics.js') ?>"></script>
<?= $this->endSection() ?>