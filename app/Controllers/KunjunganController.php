<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JadwalKunjunganModel;
use App\Models\UsersModel;
use CodeIgniter\HTTP\ResponseInterface;

class KunjunganController extends BaseController
{
    protected $usersModel;
    protected $jadwalKunjunganModel;
    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->jadwalKunjunganModel = new JadwalKunjunganModel();
    }
    public function index()
    {
        $user_p4km = $this->usersModel->where('role', 'p4km')->findAll();
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
        $this->jadwalKunjunganModel->createData($data);
        return redirect()->to('/jadwalkunjungan')->with('success', 'Jadwal kunjungan berhasil dibuat');
    }
    public function update($id)
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
        $this->jadwalKunjunganModel->updateData($id, $data);
        return redirect()->to('/jadwalkunjungan')->with('success', 'Jadwal kunjungan berhasil diupdate');
    }
    public function delete($id)
    {
        $this->jadwalKunjunganModel->delete($id);
        return redirect()->to('/jadwalkunjungan')->with('success', 'Jadwal kunjungan berhasil dihapus');
    }
}
