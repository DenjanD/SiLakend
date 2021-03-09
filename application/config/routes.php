<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'login';
$route['admin/dashboard'] = 'admin/dashboard/index';

$route['admin/pengemudi'] = 'admin/pengemudi/index';
$route['admin/tambahpengemudi'] = 'admin/pengemudi/tambah';
$route['admin/editpengemudi'] = 'admin/pengemudi/edit';
$route['admin/hapuspengemudi/(:any)'] = 'admin/pengemudi/hapus';

$route['admin/mobil'] = 'admin/kendaraan/index';
$route['admin/tambahkendaraan'] = 'admin/kendaraan/tambah_kendaraan';
$route['admin/editkendaraan'] = 'admin/kendaraan/edit_kendaraan';
$route['admin/hapuskendaraan/(:any)'] = 'admin/kendaraan/hapus_kendaraan';

$route['admin'] = 'admin/overview';
$route['admin/tambahuser'] = 'admin/overview/tambah_user';
$route['admin/hapususer/(:any)'] = 'admin/overview/hapus_user';
$route['admin/edituser'] = 'admin/overview/edit_user';
$route['admin/gantipassuser'] = 'admin/overview/ganti_pass_user';
$route['admin/row/(:any)'] = 'admin/overview/index';
$route['admin/row'] = 'admin/overview/index';

$route['admin/order'] = 'admin/order/index';
$route['admin/tambahorder'] = 'admin/order/tambah';
$route['admin/hapusorder/(:any)'] = 'admin/order/hapus';
$route['admin/batalorder/(:any)'] = 'admin/order/batal';
$route['admin/rowo/(:any)'] = 'admin/order/index';
$route['admin/rowo'] = 'admin/order/index';

$route['admin/validasi'] = 'admin/validasi/index';
$route['admin/validorder'] = 'admin/validasi/valid1';
$route['admin/tolakorder/(:any)/(:any)'] = 'admin/validasi/tolak_order';

$route['admin/tugassupir'] = 'admin/tugass/index';
$route['admin/supirberangkat'] = 'admin/tugass/berangkat';
$route['admin/supirberangkat2/(:any)/(:any)'] = 'admin/tugass/berangkat2';

$route['admin/satpam'] = 'admin/satpam/index';
$route['admin/satpaminput'] = 'admin/satpam/inputkm';

$route['admin/riwayat'] = 'admin/riwayat/index';
$route['admin/rowr/(:any)'] = 'admin/riwayat/index';
$route['admin/rowr'] = 'admin/riwayat/index';

$route['admin/perbaikan'] = 'admin/perbaikan/index';
$route['admin/perbaikan/inputperbaikan'] = 'admin/perbaikan/inputperbaikan';
$route['admin/hapusperbaikan/(:any)'] = 'admin/perbaikan/hapus_perbaikan';
$route['admin/editperbaikan'] = 'admin/perbaikan/edit_perbaikan';

$route['login'] = 'login/aksi_login';
$route['logout'] = 'login/aksi_logout';
$route['awal'] = 'login';

$route['v_petunjukpeng/0'] = 'login/petunjukpeng0';
$route['v_petunjukpeng'] = 'login/petunjukpeng';
$route['v_petunjukpeng/1'] = 'login/petunjukpeng';
$route['v_petunjukpeng/2'] = 'login/petunjukpeng2';
$route['v_petunjukpeng/3'] = 'login/petunjukpeng3';
$route['v_petunjukpeng/4'] = 'login/petunjukpeng4';
$route['v_petunjukpeng/5'] = 'login/petunjukpeng5';
$route['v_petunjukpeng/6'] = 'login/petunjukpeng6';
$route['v_petunjukpeng/7'] = 'login/petunjukpeng7';
$route['v_petunjukpeng/8'] = 'login/petunjukpeng8';
$route['v_petunjukpeng/9'] = 'login/petunjukpeng9';
$route['v_petunjukpeng/10'] = 'login/petunjukpeng10';
