<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JadwalKunjunganModel;
use App\Models\LaporanPembinaanModel;
use App\Models\UsersModel;
use CodeIgniter\HTTP\ResponseInterface;

class KunjunganController extends BaseController
{
    protected $usersModel;
    protected $jadwalKunjunganModel;
    protected $laporanPembinaanModel;
    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->jadwalKunjunganModel = new JadwalKunjunganModel();
        $this->laporanPembinaanModel = new LaporanPembinaanModel();
    }
    public function index()
    {
        $user_p4km = $this->usersModel->getUserByRoleP4KM();

        $jadwalKunjungan = $this->jadwalKunjunganModel->getJadwalKunjunganJoinIdP4kmDitugaskan();


        return view('jadwalkunjungan', compact('user_p4km', 'jadwalKunjungan'));
    }

    public function store()
    {
        $tanggalKunjungan = $this->request->getPost('tanggalKunjungan');
        $lokasiKunjungan = $this->request->getPost('lokasiKunjungan');
        $p4km_id = $this->request->getPost('p4km_id');
        $agenda = $this->request->getPost('agenda');

        $data = [
            'tanggal_kunjungan' => $tanggalKunjungan,
            'lokasi_kunjungan' => $lokasiKunjungan,
            'id_p4km_ditugaskan' => $p4km_id,
            'id_kabid_pembuat' => session()->get('user_id'),
            'agenda' => $agenda,
            'status' => 'Terjadwal'
        ];
        $jadwalKunjungan = $this->jadwalKunjunganModel->insert($data);

        // buat laporan pembinaan
        $this->laporanPembinaanModel->insert([
            'id_jadwal' => $jadwalKunjungan,
        ]);


        return redirect()->to('/jadwalkunjungan')->with('success', 'Jadwal kunjungan berhasil dibuat');
    }
    public function update($id)
    {
        $tanggalKunjungan = $this->request->getPost('tanggalKunjungan');
        $lokasiKunjungan = $this->request->getPost('lokasiKunjungan');
        $p4km_id = $this->request->getPost('p4km_id');
        $agenda = $this->request->getPost('agenda');
        $status = $this->request->getPost('status');

        $data = [
            'tanggal_kunjungan' => $tanggalKunjungan,
            'lokasi_kunjungan' => $lokasiKunjungan,
            'id_p4km_ditugaskan' => $p4km_id,
            'id_kabid_pembuat' => session()->get('user_id'),
            'agenda' => $agenda,
            'status' => $status,
        ];
        $this->jadwalKunjunganModel->updateData($id, $data);
        return redirect()->to('/jadwalkunjungan')->with('success', 'Jadwal kunjungan berhasil diupdate');
    }
    public function delete($id)
    {
        $this->jadwalKunjunganModel->delete($id);
        return redirect()->to('/jadwalkunjungan')->with('success', 'Jadwal kunjungan berhasil dihapus');
    }
}
