<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalKunjunganModel extends Model
{
    protected $table            = 'tabel_jadwalkunjungan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_p4km_ditugaskan', 'id_kabid_pembuat', 'tanggal_kunjungan', 'lokasi_kunjungan', 'agenda', ' status'];

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

    public function getJadwalKunjungan()
    {
        return $this->findAll();
    }
    public function createJadwalKunjungan(array $data)
    {
        return $this->insert($data);
    }
    public function updateJadwalKunjungan(int $id, array $data)
    {
        return $this->update($id, $data);
    }
    public function deleteJadwalKunjungan(int $id)
    {
        return $this->delete($id);
    }

}
