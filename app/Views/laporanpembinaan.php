<?= $this->extend("templates/layout") ?>

<?= $this->section("styles") ?>

<?= $this->endSection() ?>

<?= $this->section("content") ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span>Laporan Pembinaan</h4>


    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Data Laporan Pembinaan</h5>

        </div>

        <div class="card-body">
            <?php if (session()->getFlashdata("success")): ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <?= session()->getFlashdata("success") ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>


            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr class="text-nowrap">
                            <th>No</th>
                            <th>Lokasi Pembinaan</th>
                            <th>Tanggal</th>
                            <?php if (session()->get("role") == "kabid"): ?>
                                <th>Petugas Ditugaskan</th>
                            <?php endif; ?>
                            <th>Status</th>
                            <th>Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($laporanPembinaan as $laporan): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $laporan["lokasi_kunjungan"] ?></td>
                                <td><?= $laporan["tanggal_kunjungan"] ?></td>
                                <?php if (session()->get("role") == "kabid"): ?>
                                    <td><?= $laporan["nama_p4km"] ?></td>
                                <?php endif; ?>
                                <td>
                                    <span class="badge bg-info"><?= $laporan["status_laporan"] ?? "Terjadwal" ?></span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Tombol Aksi">
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailLaporanPembinaan_<?= $laporan["id"] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Detail">
                                            <i class="bx bx-detail"></i>
                                        </button>

                                        <?php if (
                                            session()->get("role") == "p4km"
                                        ): ?>


                                            <?php if (
                                                $laporan["status_laporan"] ==
                                                "Menunggu Verifikasi" ||
                                                $laporan["status_laporan"] ==
                                                "Ditolak"
                                            ): ?>

                                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#buatLaporanPembinaan_<?= $laporan["id"] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Laporan">
                                                    <i class="bx bx-edit"></i>
                                                </button>
                                            <?php endif; ?>


                                        <?php endif; ?>


                                        <?php if (
                                            session()->get("role") == "kabid"
                                        ): ?>

                                            <?php if (
                                                $laporan["status_laporan"] ==
                                                "Menunggu Verifikasi"
                                            ): ?>

                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#approveLaporanModal_<?= $laporan["id"] ?>">
                                                    <i class="bx bx-check-double"></i>
                                                </button>

                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectLaporanModal_<?= $laporan["id"] ?>">
                                                    <i class="bx bx-block"></i>
                                                </button>

                                            <?php endif; ?>

                                            <!-- hapus laporan -->
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusLaporanModal_<?= $laporan["id"] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Laporan">
                                                <i class="bx bx-trash"></i>
                                            </button>

                                        <?php endif; ?>
                                    </div>
                                </td>

                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <!-- Modal detail Laporan Pembinaan -->
    <?php foreach ($laporanPembinaan as $laporan): ?>

        <div class="modal fade" id="detailLaporanPembinaan_<?= $laporan["id"] ?>" tabindex="-1" aria-labelledby="detailLaporanLabel_<?= $laporan["id"] ?>" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailLaporanLabel_<?= $laporan["id"] ?>">
                            <i class="bx bx-detail me-2"></i>Detail Laporan Pembinaan
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <dl class="row">
                            <dt class="col-sm-4">Tanggal Laporan</dt>
                            <dd class="col-sm-8">: <?= !empty($laporan["tanggal_laporan"])
                                                        ? date(
                                                            "d F Y",
                                                            strtotime($laporan["tanggal_laporan"])
                                                        )
                                                        : "-" ?></dd>

                            <dt class="col-sm-4">Jadwal Kunjungan</dt>
                            <dd class="col-sm-8">: <?= !empty($laporan["tanggal_kunjungan"])
                                                        ? date(
                                                            "d F Y",
                                                            strtotime($laporan["tanggal_kunjungan"])
                                                        )
                                                        : "-" ?></dd>

                            <dt class="col-sm-4">Lokasi Kunjungan</dt>
                            <dd class="col-sm-8">: <?= esc(
                                                        $laporan["lokasi_kunjungan"] ?? "-"
                                                    ) ?></dd>

                            <dt class="col-sm-4">Agenda</dt>
                            <dd class="col-sm-8">: <?= esc(
                                                        $laporan["agenda"] ?? "-"
                                                    ) ?></dd>
                        </dl>

                        <hr>

                        <h6><i class="bx bx-file-blank me-1"></i>Isi Laporan</h6>
                        <div class="p-3 bg-light rounded" style="min-height: 100px;">
                            <p class="mb-0"><?= !empty($laporan["isi_laporan"])
                                                ? nl2br(esc($laporan["isi_laporan"]))
                                                : '<span class="text-muted">Laporan belum dibuat.</span>' ?></p>
                        </div>

                        <hr>

                        <dl class="row">
                            <dt class="col-sm-4">Status Laporan</dt>
                            <dd class="col-sm-8">:
                                <?php
                                $status =
                                    $laporan["status_laporan"] ?? "Belum Ada";
                                $badgeClass = "bg-secondary";
                                if ($status == "Menunggu Verifikasi") {
                                    $badgeClass = "bg-warning";
                                }
                                if ($status == "Disetujui") {
                                    $badgeClass = "bg-success";
                                }
                                if ($status == "Ditolak") {
                                    $badgeClass = "bg-danger";
                                }
                                ?>
                                <span class="badge <?= $badgeClass ?>"><?= esc(
                                                                            $status
                                                                        ) ?></span>
                            </dd>

                            <dt class="col-sm-4">Tanggal Validasi</dt>
                            <dd class="col-sm-8">: <?= !empty($laporan["tanggal_validasi"])
                                                        ? date(
                                                            "d F Y, H:i",
                                                            strtotime($laporan["tanggal_validasi"])
                                                        ) . " WIB"
                                                        : "-" ?></dd>

                            <dt class="col-sm-4">Dokumen Pendukung</dt>
                            <dd class="col-sm-8">
                                <?php if (!empty($laporan["dokumen"])): ?>
                                    : <a href="<?= base_url(
                                                    "uploads/" . $laporan["dokumen"]
                                                ) ?>" class="btn btn-primary btn-sm" target="_blank">
                                        <i class="bx bx-download me-1"></i> Lihat Dokumen
                                    </a>
                                <?php else: ?>
                                    : <span class="text-muted">Tidak ada dokumen.</span>
                                <?php endif; ?>
                            </dd>
                        </dl>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <?php if (session()->get("role") == "p4km"): ?>
        <!-- modal buat laporan pembinaan -->
        <?php foreach ($laporanPembinaan as $laporan): ?>

            <div class="modal fade" id="buatLaporanPembinaan_<?= $laporan["id"] ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="<?= base_url(
                                        "laporanpembinaan/" . $laporan["id"]
                                    ) ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <!-- method PUT -->
                        <input type="hidden" name="_method" value="PUT">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Buat Laporan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="tanggalLaporan" class="form-label">Tanggal Laporan</label>
                                        <input type="date" id="tanggalLaporan" name="tanggalLaporan" class="form-control"
                                            value="<?= date(
                                                        "Y-m-d"
                                                    ) ?>" disabled />
                                    </div>

                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="jadwalKunjungan" class="form-label">Jadwal Kunjungan</label>
                                        <input type="date" id="jadwalKunjungan" name="jadwalKunjungan" class="form-control"
                                            value="<?= $laporan["tanggal_kunjungan"] ?>" disabled />
                                    </div>

                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="isiLaporan" class="form-label">Isi Laporan</label>
                                        <textarea name="isiLaporan" class="form-control" rows="3" id="isiLaporan"><?= $laporan["isi_laporan"] ?? "" ?></textarea>
                                    </div>

                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="dokumenPendukung" class="form-label">Dokumen Pendukung</label>
                                        <div class="input-group">
                                            <input type="file" name="dokumenPendukung" class="form-control" id="dokumenPendukung" aria-describedby="button-lihat">

                                            <?php if (
                                                !empty($laporan["dokumen"])
                                            ): ?>
                                                <a href="<?= base_url(
                                                                "uploads/" .
                                                                    $laporan["dokumen"]
                                                            ) ?>" class="btn btn-info" target="_blank" id="button-lihat">
                                                    <i class="bx bx-show"></i>&nbsp;Lihat
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-text">Kosongkan jika tidak ingin mengubah dokumen.</div>
                                    </div>
                                </div>
                            </div>
                            <?php if (session()->get("role") == "p4km"): ?>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                    <button type="submit" class="btn btn-primary">Save Laporan</button>
                                </div>
                            <?php endif; ?>

                        </div>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>


    <!-- verifikasi laporan -->
    <?php if (session()->get("role") == "kabid"): ?>
        <?php foreach ($laporanPembinaan as $laporan): ?>
            <!-- modal konfirmasi verifikasi approve laporan -->
            <div class="modal fade" id="approveLaporanModal_<?= $laporan["id"] ?>" tabindex="-1" aria-labelledby="approveLaporanLabel_<?= $laporan["id"] ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title" id="approveLaporanLabel_<?= $laporan["id"] ?>">
                                <i class="bx bx-check-circle me-2"></i>Konfirmasi Persetujuan
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="<?= base_url(
                                            "laporan/approve/" . $laporan["id"]
                                        ) ?>" method="post">

                            <?= csrf_field() ?>

                            <div class="modal-body">
                                <p>Apakah Anda yakin ingin **MENYETUJUI** laporan ini?</p>
                                <p class="text-muted">Status laporan akan diubah menjadi "Disetujui" dan tindakan ini tidak dapat dibatalkan.</p>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Batal
                                </button>
                                <button type="submit" class="btn btn-success">
                                    <i class="bx bx-check"></i> Ya, Setujui
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- modal konfirmasi verifikasi reject laporan -->
            <div class="modal fade" id="rejectLaporanModal_<?= $laporan["id"] ?>" tabindex="-1" aria-labelledby="rejectLaporanLabel_<?= $laporan["id"] ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title" id="rejectLaporanLabel_<?= $laporan["id"] ?>">
                                <i class="bx bx-x-circle me-2"></i>Konfirmasi Penolakan
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="<?= base_url(
                                            "laporan/reject/" . $laporan["id"]
                                        ) ?>" method="post">
                            <?= csrf_field() ?>

                            <div class="modal-body">
                                <p>Anda akan **MENOLAK** laporan ini. Statusnya akan diubah menjadi "Ditolak".</p>

                                <div class="mb-3">
                                    <label for="alasan_penolakan_<?= $laporan["id"] ?>" class="form-label">
                                        <strong>Alasan Penolakan (Wajib diisi):</strong>
                                    </label>
                                    <textarea class="form-control" id="alasan_penolakan_<?= $laporan["id"] ?>" name="alasan_penolakan" rows="3" placeholder="Contoh: Dokumen pendukung tidak lengkap atau tidak sesuai." required></textarea>
                                </div>

                                <p class="text-muted">Pastikan alasan yang diberikan jelas. Tindakan ini tidak dapat dibatalkan.</p>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Batal
                                </button>
                                <button type="submit" class="btn btn-danger">
                                    <i class="bx bx-block"></i> Tolak Laporan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    <?php endif; ?>


    <!-- hapus data laporan -->
    <?php if (session()->get("role") == "kabid"): ?>
        <?php foreach ($laporanPembinaan as $laporan): ?>

            <div class="modal fade" id="hapusLaporanModal_<?= $laporan["id"] ?>" tabindex="-1" aria-labelledby="hapusLaporanLabel_<?= $laporan["id"] ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title" id="hapusLaporanLabel_<?= $laporan["id"] ?>">
                                <i class="bx bx-error-alt me-2"></i>Konfirmasi Penghapusan Data
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="<?= base_url(
                                            "laporanpembinaan/" . $laporan["id"]
                                        ) ?>" method="post">
                            <?= csrf_field() ?>

                            <input type="hidden" name="_method" value="DELETE">

                            <div class="modal-body">
                                <div class="text-center">
                                    <i class="bx bx-trash bx-lg text-danger mb-3" style="font-size: 4rem;"></i>
                                    <h4>Apakah Anda Yakin?</h4>

                                    <p class="fw-bold text-danger mt-3">
                                        Data yang sudah dihapus TIDAK DAPAT DIKEMBALIKAN LAGI!
                                    </p>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Batal
                                </button>
                                <button type="submit" class="btn btn-danger">
                                    Ya, Hapus Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

    <?php endif; ?>







</div>

<?= $this->endSection() ?>


<?= $this->section("scripts") ?>

<?= $this->endSection() ?>