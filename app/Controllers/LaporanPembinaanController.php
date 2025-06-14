<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LaporanPembinaanModel;
use CodeIgniter\HTTP\ResponseInterface;

class LaporanPembinaanController extends BaseController
{
    protected $laporanPembinaanModel;

    public function __construct()
    {
        $this->laporanPembinaanModel = new LaporanPembinaanModel();
    }

    public function index()
    {
        $laporanPembinaanByP4km = $this->laporanPembinaanModel->getLaporanPembinaanByP4km();

        return view('laporanpembinaan', compact('laporanPembinaanByP4km'));
    }
}
