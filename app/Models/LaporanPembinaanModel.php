<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanPembinaanModel extends Model
{
    protected $table            = 'tabel_laporanpembinaan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_jadwal', 'tanggal_laporan', 'isi_laporan', 'catatan_revisi', 'status_laporan', 'tanggal_validasi'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getLaporanPembinaan()
    {
        return $this->findAll();
    }
    public function createLaporanPembinaan(array $data)
    {
        return $this->insert($data);
    }
    public function updateLaporanPembinaan(int $id, array $data)
    {
        return $this->update($id, $data);
    }
    public function deleteLaporanPembinaan(int $id)
    {
        return $this->delete($id);
    }
}
