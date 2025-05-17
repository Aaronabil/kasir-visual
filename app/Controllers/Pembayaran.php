<?php
namespace App\Controllers;

use App\Models\Mpenjualan;
use CodeIgniter\Controller;

class Pembayaran extends Controller
{
    public function index()
    {
        $penjualanModel = new Mpenjualan();
        $detailPenjualan = $penjualanModel->find(1); // Ganti dengan ID yang sesuai atau query yang Anda butuhkan
        return view('pembayaran', ['detailPenjualan' => $detailPenjualan]);
    }

    public function prosesBayar()
    {
        $totalHarga = $this->request->getPost('totalHarga');
        $uangBayar = str_replace('.', '', $this->request->getPost('uangBayar')); // Hapus titik agar dapat di-parse sebagai integer

        if ($uangBayar < $totalHarga) {
            return redirect()->back()->with('error', 'Uang tidak cukup untuk melakukan pembayaran');
        }
        return redirect()->to('/selesai-bayar');
    }
}

?>