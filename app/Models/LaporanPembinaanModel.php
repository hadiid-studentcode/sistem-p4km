<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanPembinaanModel extends Model
{
    protected $table = "tabel_laporanpembinaan";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType = "array";
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        "id_jadwal",
        "tanggal_laporan",
        "isi_laporan",
        "catatan_revisi",
        "status_laporan",
        "tanggal_validasi",
        "dokumen",
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = "datetime";
    protected $createdField = "created_at";
    protected $updatedField = "updated_at";
    protected $deletedField = "deleted_at";

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    public function getLaporanPembinaanByP4km($username = null)
    {
        return $this->select(
            '
        tabel_laporanpembinaan.*,
        tabel_jadwalkunjungan.id_p4km_ditugaskan,
        tabel_jadwalkunjungan.id_kabid_pembuat,
        tabel_jadwalkunjungan.tanggal_kunjungan,
        tabel_jadwalkunjungan.lokasi_kunjungan,
        tabel_jadwalkunjungan.agenda,
        tabel_jadwalkunjungan.status,

        tb_users.nama_lengkap as nama_p4km,

        '
        )
            ->join(
                "tabel_jadwalkunjungan",
                "tabel_jadwalkunjungan.id = tabel_laporanpembinaan.id_jadwal"
            )
            ->join(
                "tb_users",
                "tabel_jadwalkunjungan.id_p4km_ditugaskan = tb_users.id"
            )
            ->where("tb_users.username", $username)
            ->findAll();
    }

    public function getLaporanPembinaan()
    {
        return $this->select(
            '
        tabel_laporanpembinaan.*,
        tabel_jadwalkunjungan.id_p4km_ditugaskan,
        tabel_jadwalkunjungan.id_kabid_pembuat,
        tabel_jadwalkunjungan.tanggal_kunjungan,
        tabel_jadwalkunjungan.lokasi_kunjungan,
        tabel_jadwalkunjungan.agenda,
        tabel_jadwalkunjungan.status,

        tb_users.nama_lengkap as nama_p4km,

        '
        )
            ->join(
                "tabel_jadwalkunjungan",
                "tabel_jadwalkunjungan.id = tabel_laporanpembinaan.id_jadwal"
            )
            ->join(
                "tb_users",
                "tabel_jadwalkunjungan.id_p4km_ditugaskan = tb_users.id"
            )

            ->findAll();
    }
}
