<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JadwalKunjunganModel;
use App\Models\LaporanPembinaanModel;
use CodeIgniter\HTTP\ResponseInterface;

class LaporanPembinaanController extends BaseController
{
    protected $laporanPembinaanModel;

    protected $jadwalKunjunganModel;

    public function __construct()
    {
        $this->laporanPembinaanModel = new LaporanPembinaanModel();
        $this->jadwalKunjunganModel = new JadwalKunjunganModel();
    }

    public function index()
    {
        if (session()->get("role") == "p4km") {
            $laporanPembinaan = $this->laporanPembinaanModel->getLaporanPembinaanByP4km(
                session()->get("username")
            );
        }

        if (session()->get("role") == "kabid") {
            $laporanPembinaan = $this->laporanPembinaanModel->getLaporanPembinaan();
        }

        return view("laporanpembinaan", compact("laporanPembinaan"));
    }

    public function update($id)
    {
        // 3. Ambil data laporan lama untuk referensi
        $laporanLama = $this->laporanPembinaanModel->find($id);
        if (!$laporanLama) {
            // Hentikan jika data dengan ID tersebut tidak ditemukan
            throw new \CodeIgniter\Exceptions\PageNotFoundException(
                "Data Laporan tidak ditemukan"
            );
        }

        // 4. Proses file HANYA jika file baru diunggah dan valid
        $fileDokumen = $this->request->getFile("dokumenPendukung");
        $namaFile = $laporanLama["dokumen"]; // Default ke nama file yang sudah ada

        if ($fileDokumen->isValid() && !$fileDokumen->hasMoved()) {
            // Jika ada file baru yang valid, proses file tersebut
            $namaFile = $fileDokumen->getRandomName(); // Buat nama acak untuk file baru
            $fileDokumen->move(FCPATH . "uploads", $namaFile); // Pindahkan file baru

            // Hapus file lama dari server untuk menghemat ruang
            if (
                !empty($laporanLama["dokumen"]) &&
                file_exists(FCPATH . "uploads/" . $laporanLama["dokumen"])
            ) {
                unlink(FCPATH . "uploads/" . $laporanLama["dokumen"]);
            }
        }

        // 5. Siapkan data untuk di-update ke database
        $data = [
            "tanggal_laporan" => date("Y-m-d"),
            "isi_laporan" => $this->request->getVar("isiLaporan"),
            "status_laporan" => "Menunggu Verifikasi",
            "dokumen" => $namaFile, // Simpan nama file (baru atau lama)
        ];

        // 6. Update data di database
        $this->laporanPembinaanModel->update($id, $data);
        $this->jadwalKunjunganModel->update($laporanLama["id_jadwal"], [
            "status" => "Selesai",
        ]);

        // 7. Redirect dengan pesan sukses
        return redirect()
            ->to("/laporanpembinaan")
            ->with("success", "Laporan pembinaan berhasil diupdate.");
    }
    public function delete($id)
    {
        $this->laporanPembinaanModel->delete($id);

        return redirect()
            ->to("/laporanpembinaan")
            ->with("success", "Laporan pembinaan berhasil dihapus");
    }
    public function approve($id)
    {
        $laporan = $this->laporanPembinaanModel->find($id);

        $data = [
            "status_laporan" => "Disetujui",
            "tanggal_validasi" => date("Y-m-d"),
        ];

        $this->laporanPembinaanModel->update($id, $data);

        $this->jadwalKunjunganModel->update($laporan["id_jadwal"], [
            "status" => "Selesai",
        ]);

        return redirect()
            ->to("/laporanpembinaan")
            ->with("success", "Laporan pembinaan berhasil disetujui");
    }
    public function reject($id)
    {
        $laporan = $this->laporanPembinaanModel->find($id);
        $alasanPenolakan = $this->request->getPost("alasan_penolakan");

        $data = [
            "status_laporan" => "Ditolak",
            "tanggal_validasi" => date("Y-m-d"),
            "alasan_penolakan" => $alasanPenolakan,
        ];

        $this->laporanPembinaanModel->update($id, $data);

        return redirect()
            ->to("/laporanpembinaan")
            ->with("success", "Laporan pembinaan berhasil ditolak");
    }
}
