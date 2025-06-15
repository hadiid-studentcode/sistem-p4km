<?= $this->extend("templates/layout") ?>

<?= $this->section("styles") ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<?= $this->endSection() ?>

<?= $this->section("content") ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span>Jadwal Kunjungan</h4>


    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Data Jadwal Kunjungan</h5>
            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambahDataKunjungan">
                Tambah Data
            </button>
        </div>

        <div class="card-body">
            <?php if (session()
                ->getFlashdata("success")
            ): ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <?= session()
                        ->getFlashdata("success") ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            endif; ?>


            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr class="text-nowrap">
                            <th>No</th>
                            <th>Lokasi Kunjungan</th>
                            <th>Tanggal</th>
                            <th>Petugas Ditugaskan</th>
                            <th>Status</th>
                            <th>Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($jadwalKunjungan as $jadwal): ?>
                            <tr>
                                <th scope="row"><?= $no++
                                                ?>
                                <td><?= $jadwal["lokasi_kunjungan"] ?></td>
                                <td><?= $jadwal["tanggal_kunjungan"] ?></td>
                                <td><?= $jadwal["nama_p4km"] ?></td>
                                <td>
                                    <?php if ($jadwal["status"] == "Terjadwal"): ?>
                                        <span class="badge bg-info">Terjadwal</span>
                                    <?php
                                    elseif ($jadwal["status"] == "Selesai"): ?>
                                        <span class="badge bg-success">Selesai</span>
                                    <?php
                                    endif; ?>
                                </td>
                                <td>

                                    <!-- button detail -->
                                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#detailJadwalKunjungan_<?= $jadwal["id"] ?>"><i class="bx bx-detail"></i></button>
                                    <!-- button edit -->
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editJadwalKunjungan_<?= $jadwal["id"] ?>"><i class="bx bx-edit"></i></button>
                                    <!-- button hapus -->
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusJadwalKunjungan_<?= $jadwal["id"] ?>"><i class="bx bx-trash"></i></button>

                                </td>

                            </tr>

                        <?php
                        endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- modal tambah data jadwal kunjungan -->
    <div class="modal fade" id="tambahDataKunjungan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?= base_url("/jadwalkunjungan") ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Buat Jadwal Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col">
                                <label for="tanggalKunjungan" class="form-label">Tanggal Kunjungan</label>
                                <input type="date" id="tanggalKunjungan" name="tanggalKunjungan" class="form-control" />
                            </div>
                            <div class="col">
                                <label for="lokasiKunjungan" class="form-label">Lokasi Kunjungan</label>
                                <input type="text" id="lokasiKunjungan" name="lokasiKunjungan" class="form-control" placeholder="Contoh: SMP Harapan Bangsa" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="p4km" class="form-label">Staf P4km Ditugaskan</label>
                            <select name="p4km_id" class="form-select" id="p4km">
                                <option value="">Pilih Staf P4km</option>
                                <?php foreach ($user_p4km as $p4km): ?>
                                    <option value="<?= $p4km["id"] ?>"><?= $p4km["nama_lengkap"] ?></option>
                                <?php
                                endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="agenda" class="form-label">Agenda Kunjungan</label>
                            <textarea name="agenda" class="form-control" rows="3" id="agenda"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Save Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- modal detail data jadwal kunjungan -->
    <?php foreach ($jadwalKunjungan as $jadwal): ?>
        <div class="modal fade" id="detailJadwalKunjungan_<?= $jadwal["id"] ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel3">Detail Jadwal Kunjungan</h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="list-group">

                            <a href="javascript:void(0);" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex justify-content-between w-100">
                                    <h6>Lokasi Kunjungan</h6>

                                </div>
                                <p class="mb-1">
                                    <?= $jadwal["lokasi_kunjungan"] ?>
                                </p>

                            </a>
                            <a href="javascript:void(0);" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex justify-content-between w-100">
                                    <h6>Tanggal:</h6>

                                </div>
                                <p class="mb-1">
                                    <?= $jadwal["tanggal_kunjungan"] ?>
                                </p>
                            </a>
                            <a href="javascript:void(0);" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex justify-content-between w-100">
                                    <h6>Petugas:</h6>

                                </div>
                                <p class="mb-1">
                                    <?= $jadwal["nama_p4km"] ?>
                                </p>
                            </a>
                            <a href="javascript:void(0);" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex justify-content-between w-100">
                                    <h6>Status:</h6>

                                </div>
                                <p class="mb-1">
                                    <?php if ($jadwal["status"] == "Terjadwal"): ?>
                                        <span class="badge bg-info">Terjadwal</span>
                                    <?php
                                    elseif ($jadwal["status"] == "Selesai"): ?>
                                        <span class="badge bg-success">Selesai</span>
                                    <?php
                                    endif; ?>
                                </p>
                            </a>
                            <a href="javascript:void(0);" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex justify-content-between w-100">
                                    <h6>Agenda:</h6>

                                </div>
                                <p class="mb-1">
                                    <?= $jadwal["agenda"] ?>
                                </p>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    <?php
    endforeach; ?>

    <!-- modal edit data jadwal kunjungan -->
    <?php foreach ($jadwalKunjungan as $jadwal): ?>

        <div class="modal fade" id="editJadwalKunjungan_<?= $jadwal["id"] ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="<?= base_url("/jadwalkunjungan/" . $jadwal["id"]) ?>" method="post">
                    <?= csrf_field() ?>
                    <!-- method PUT -->
                    <input type="hidden" name="_method" value="PUT">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Edit Jadwal Kunjungan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="tanggalKunjungan" class="form-label">Tanggal Kunjungan</label>
                                    <input type="date" id="tanggalKunjungan" name="tanggalKunjungan" class="form-control"
                                        value="<?= $jadwal["tanggal_kunjungan"] ?>" />
                                </div>
                                <div class="col">
                                    <label for="lokasiKunjungan" class="form-label">Lokasi Kunjungan</label>
                                    <input type="text" id="lokasiKunjungan" name="lokasiKunjungan" class="form-control" placeholder="Contoh: SMP Harapan Bangsa"
                                        value="<?= $jadwal["lokasi_kunjungan"] ?>" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="p4km" class="form-label">Staf P4km Ditugaskan</label>
                                <select name="p4km_id" class="form-select" id="p4km">
                                    <option value="">Pilih Staf P4km</option>
                                    <?php foreach ($user_p4km as $p4km): ?>
                                        <option value="<?= $p4km["id"] ?>" <?= $jadwal["id_p4km_ditugaskan"] == $p4km["id"] ? "selected" : "" ?>>
                                            <?= $p4km["nama_lengkap"] ?>
                                        </option>
                                    <?php
                                    endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="agenda" class="form-label">Agenda Kunjungan</label>
                                <textarea name="agenda" class="form-control" rows="3" id="agenda"><?= $jadwal["agenda"] ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" class="form-select" id="status">
                                    <option value="">Pilih Status Jadwal</option>
                                    <option value="Terjadwal" <?= $jadwal["status"] == "Terjadwal" ? "selected" : "" ?>>Terjadwal</option>
                                    <option value="Selesai" <?= $jadwal["status"] == "Selesai" ? "selected" : "" ?>>Selesai</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary">Update Data</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php
    endforeach; ?>

    <!-- modal peringatan konfirmasi hapus data -->
    <?php foreach ($jadwalKunjungan as $jadwal): ?>
        <div class="modal fade" id="hapusJadwalKunjungan_<?= $jadwal["id"] ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Konfirmasi Hapus Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-triangle fa-2x text-danger me-3"></i>
                            <div>
                                <p class="mb-0">Apakah Anda yakin ingin menghapus data ini? <br>
                                    <strong>Data yang sudah dihapus tidak dapat dikembalikan.</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <form id="deleteForm" action="<?= base_url('jadwalkunjungan/' . $jadwal['id'])?>" method="POST" class="d-inline">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php
    endforeach; ?>



</div>

<?= $this->endSection() ?>


<?= $this->section("scripts") ?>

<?= $this->endSection() ?>