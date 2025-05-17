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
    $totalHarga = (int) $this->request->getPost('totalHarga');
    $uangBayar = $this->request->getPost('uangBayar');
    $uangBayar = (int) preg_replace('/\D/', '', $uangBayar);

    if ($uangBayar < $totalHarga) {
        return redirect()->back()->with('error', 'Not enough money to make payment');
    }

    return redirect()->to('/selesai-bayar');
}
}

?>