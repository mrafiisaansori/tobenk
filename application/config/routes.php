<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['logout'] = 'login/logout';
$route['transaksi-full.html'] = 'kasir/transaksi_full';
$route['transaksi-mobile.html'] = 'kasir/transaksi_mobile';
$route['cetak/(:any)'] = 'welcome/cetak/$1';


//ADMIN
$route['admin/pengguna.html'] = 'admin/lihatPengguna';
$route['admin/identitas.html'] = 'admin/lihatIdentitas';
$route['admin/kategori.html'] = 'admin/lihatKategori';
$route['admin/produk.html'] = 'admin/lihatProduk';
$route['admin/supplier.html'] = 'admin/lihatSupplier';
$route['admin/jenis-bayar.html'] = 'admin/lihatJenisBayar';
$route['admin/pembelian.html'] = 'admin/lihatPembelian';
$route['admin/detail-pembelian-(:any).html'] = 'admin/detailPembelian/$1';
$route['admin/retur.html'] = 'admin/lihatRetur';
$route['admin/detail-retur-(:any).html'] = 'admin/detailRetur/$1';
$route['admin/ubah-password.html'] = 'admin/viewUbahPassword';
$route['admin/laporan-penjualan.html'] = 'admin/filterLaporanPenjualan';
$route['admin/cetak-struk-penjualan-(:any).html'] = 'admin/cetakStrukPenjualan/$1';
$route['admin/cetak-penjulan/(:any)/(:any)/(:any)/(:any)'] = 'admin/cetakLaporanPenjualan/$1/$2/$3/$4';
$route['admin/laporan-penyusutan.html'] = 'urgent/laporan_penyusutan';
$route['admin/laporan-pendapatan.html'] = 'urgent/laporan_pendapatan';
$route['admin/laporan-stok.html'] = 'urgent/laporan_stok';
$route['admin/transaksi-keuangan.html'] = 'admin/filterTransaksiKeuangan';
$route['admin/detail-transaksi-keuangan.html'] = 'admin/detailTransaksiKeuangan';
$route['admin/laporan-keuangan.html'] = 'admin/laporan_keuangan';
$route['admin/laporan-penjualan-hapus.html'] = 'admin/filterLaporanPenjualanHapus';
$route['admin/customer.html'] = 'admin/lihatCustomer';

