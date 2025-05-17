<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::login');
$routes->post('/loginSubmit', 'AuthController::loginSubmit');
$routes->get('/logout', 'User::logout');

$routes->get('/dashboard', 'Dashboard::index');

#===================Pengelolaan Pengguna==============================
$routes->group('', ['filter' => 'admin'], function ($routes) {
$routes->get('/pengguna', 'User::daftarPengguna');
$routes->get('/tambah-pengguna', 'User::tambahPengguna');
$routes->post('/tambah-pengguna', 'User::tambahPengguna');
$routes->get('/edit-pengguna/(:any)', 'User::tambahPengguna/$1');
$routes->post('/edit-pengguna/(:any)', 'User::tambahPengguna/$1');
$routes->get('/hapus-pengguna/(:any)', 'User::hapusPengguna/$1');
$routes->get('/pengguna/search', 'User::search');
});

#===================Pengelolaan Pelanggan==============================
$routes->get('/pelanggan', 'Pelanggan::index');
$routes->get('/tambah-pelanggan', 'Pelanggan::tambahPelanggan');
$routes->post('/tambah-pelanggan', 'Pelanggan::tambahPelanggan');
$routes->get('/edit-pelanggan/(:any)', 'Pelanggan::tambahPelanggan/$1');
$routes->post('/edit-pelanggan/(:any)', 'Pelanggan::tambahPelanggan/$1');
$routes->get('/hapus-pelanggan/(:any)', 'Pelanggan::hapusPelanggan/$1');
$routes->get('/pelanggan/search', 'Pelanggan::search');

#===================Pengelolaan Produk==============================
$routes->get('/produk', 'Produk::index');
$routes->get('/tambah-produk', 'Produk::tambahProduk');
$routes->post('/tambah-produk', 'Produk::tambahProduk');
$routes->get('/edit-produk/(:any)', 'Produk::tambahProduk/$1');
$routes->post('/edit-produk/(:any)', 'Produk::tambahProduk/$1');
$routes->get('/hapus-produk/(:any)', 'Produk::hapusProduk/$1');

$routes->group('', ['filter' => 'petugas'], function ($routes) {
$routes->get('/penjualan', 'Penjualan::index');
$routes->post('/penjualan', 'Penjualan::index');
$routes->get('/penjualan/(:num)', 'Penjualan::cekHarga/$1');
$routes->get('/bayar', 'Penjualan::formBayar');
$routes->get('/selesai-bayar', 'Penjualan::bayar');
$routes->post('pembayaran/prosesBayar', 'Pembayaran::prosesBayar');
});


$routes->get('/laporan-stok', 'Laporan::index');
$routes->group('', ['filter' => 'admin'], function ($routes) {
$routes->get('/laporan-pendapatan', 'Laporan::laporanPendapatan');
$routes->post('/laporan-pendapatan', 'Laporan::laporanPendapatan');
$routes->get('/download-pdf', 'Laporan::downloadPDF');
});

// $routes->get('dashboard)', 'User::welcome/$1');
// $routes->get('welcome/(:segment)', 'User::welcome/$1');

